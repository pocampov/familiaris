<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Config;
use Familiaris\Actividad;
use Familiaris\Proyecto;
use Familiaris\Unidad;
use Familiaris\Roll;
use Familiaris\User;
use Familiaris\Lampara;
use Familiaris\UsuarioRollProyecto;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Illuminate\Container\Container;

class familiar extends Controller
{
	
// Metodo temporal para probar Google Home	
public function lampara(Request $request)
	{
		$on = $request->input('on',0);
		$lampara = new Lampara();
		$lampara->on = $on;
		$lampara->save();
	return;
	}	
	
public function estado_lampara()
	{
		$ultimo = Lampara::max('id');
		echo Lampara::find($ultimo)->on;
	return;
	}	
	
// Fin metodo temporal

	
	public function tokensignin(Request $request)
	{

		//Recibe token dado por la autenticación de google
		$logueado ="no";
		// Consulta con Google datos del usuario
		$client = new Client();
		$res = $client->request('GET', 'https://www.googleapis.com/oauth2/v3/tokeninfo?id_token='.$request->idtoken);
		$response = $res->getBody()->getContents();
		if (Auth::check()) {
			$logueado="si";
		}
		echo $logueado;
		$datos=json_decode($response, true);
		if ($datos['aud']==$_ENV['GOOGLE_CLIENT_ID']) {
			$usuario = User::where('email', $datos['email'])->first();
			Auth::loginUsingId($usuario['id'], true);
		}
		return;
	}
    
    // Funciones para Idiomas

    public function idioma($lan)
    {   
        //Session::put('language', $lan);
		//session(['language' => $lan]);
		App::setLocale($lan);
		//Session::put('locale', $lan);
        //Session::save();
        return back();
    }
    
	// Funcion temporal para hacer pruebitas
	public function prueba()
	{
		return view('prueba_acceso');
	}
	
    // Lista todos los proyectos
	public function index()
	{
	$user = Auth::user();
	if ($user == null) {
	    return redirect('/login');
	}
	$proyectos = $user->proyectos();
	$unidades = Unidad::all();
	return view('proyecto.proyectos', ['proyectos' => $proyectos,'unidades'=>$unidades,'email_usuario'=>$user->email]);
	}
	
	public function create()
	{
    return view('proyecto.formproyecto');
	}
	
	//Graba la informacion de un proyecto
	public function store(Request $request)
	{
	$user = Auth::user();
    $this->validate($request, [
        'nombre' => 'required|min:5',
        'objetivo' => 'required|min:8',
		'user_id' => 'required',
        'fecha_inicio'=>'required',
        'costo_mano_de_obra' => 'required',
		'costo_materiales' => 'required',
		'costo_servicios' => 'required',
		'costo_imprevistos' => 'required',
		'tiempo_previsto' => 'required',
		'unidad_id' => 'required'
    ]);

    $nuevo_proyecto = Proyecto::create($request->all());
// Crea registro en usuario_roll_proyectos 
	$user = Auth::user();
	$tipo_rol = "Creador";
	$urp = new UsuarioRollProyecto;
	$urp->proyecto_id = $nuevo_proyecto->id;
	$urp->email_invitado = $user->email;
	$urp->email_usuario = $user->email;
	$urp->tipo_rol = $tipo_rol;
	$urp->rol_id = 1;
	$urp->save();
    return redirect('/ver_proyectos');
	}

	public function ver_unidades()
	{
    $unidades = Unidad::all();
    return view('administrar.ver_unidades', ['unidades' => $unidades->toArray()]);
	}

	public function crear_unidades()
	{
    return view('administrar.formunidades');
	}	
	public function guardar_unidades(Request $request)
	{
	$this->validate($request, [
        'nombre' => 'required'
		]);
	Unidad::create($request->all());
    return redirect('administrar/ver_unidades');
	}
	
	public function crear_roles()
	{
    return view('administrar.formroles');
	}	
	public function guardar_roles(Request $request)
	{
	$this->validate($request, [
        'tipo' => 'required'
		]);
	Roll::create($request->all());
    return redirect('administrar/ver_roles');
	}	
	public function ver_roles()
	{
    $roles = Roll::all();
    return view('administrar.ver_roles', ['roles' => $roles->toArray()]);
	}


	public function envia_correo(Request $request)
	{
	    Mail::send('correoinvita1', ['datos'=>$request], function($message) use($request)
	    {
	        $usuario = Auth::user();
	        $message->from("ProyectosFamiliaris@familiaris.pasioncreadora.info", $usuario->name);
	        $message->bcc($usuario->email, $usuario->name);
	        $message->to($request->input('email_usuario'), $request->input('nombre'))->subject('TRABAJEMOS JUNTOS EN ESTE PROYECTO '.$request->input("proyecto_id") );
	    });
	    /* crea objeto en UsusarioRollProyecto */
		$resultado = UsuarioRollProyecto::where('email_usuario','=',$request->input('email_usuario'))->where('proyecto_id','=',$request->input('proyecto_id') )->get();
		$resultado1 = UsuarioRollProyecto::where('email_usuario','=','remiso@familiaris.fam')->where('proyecto_id','=',$request->input('proyecto_id') )->get();
		if ($resultado->isEmpty()) {     //No existe como usuario registrado asociado a ese proyecto
			if ($resultado1->isEmpty()) {     //No existe como usuario invitado asociado a ese proyecto
				$usrp = new UsuarioRollProyecto;
				$usrp->email_usuario = "remiso@familiaris.fam"; /*hasta que el usuario se registre y acepte ser parte del proyecto es un invitado con este correo generico */
				$usrp->email_invitado = $request->input('email_usuario'); 
				$usrp->tipo_rol = "Invitado" ;
				$usrp->proyecto_id = $request->input('proyecto_id') ;
				$usrp->rol_id = 4;
				$usrp->save();
			}	
		}
	    return redirect()->route('ver_proyectos');
	}
    public function crea_correo($id)
    {
      return view('proyecto.invitarsocio', ['proyecto' => Proyecto::find($id)]);
    }
    
    public function recibe_invitacion(Request $request)
    {
        $proyecto = Proyecto::find($request->input('proyecto_id'));
        return view('auth.register', $proyecto);
    }
    // Actividades
//    public function crear_actividades()
//    {
//        $actividades = new Actividades();
//        return view('proyecto.formeditaactividades',['actividades'=>$actividades]);
//    }

//    public function inserta_actividad($proyecto_id)
//    {
//        $nombre_proyecto = Proyecto::find($proyecto_id)->nombre;
//        $actividades = new Actividad;
//        $destino ='proyecto.formactividades';
//        $unidades = Unidad::all();
//        return view($destino, ['unidades' => $unidades, 'actividades' => $actividades,'proyecto_id'=>$proyecto_id, 'nombre_proyecto'=>$nombre_proyecto]);
//    }
    
    public function editar_actividad($actividad_id, $proyecto_id)
    {
        if ($actividad_id != 0) {
            $actividad = Actividad::where(['id'=>$actividad_id,'proyecto_id'=>$proyecto_id])->first();
        } else
        {
            $actividad = new Actividad();
            $actividad->proyecto_id = $proyecto_id;
            $actividad->id_actividad =  $actividad->contar_actividades($proyecto_id)+1;
        }
        $unidades = Unidad::all();
        return view('proyecto.formeditaactividades',['actividad'=>$actividad,'unidades'=>$unidades]);
    }
    
    //Graba la informacion de la actividad
    public function guardar_actividades(Request $request)
    {
   //     $user = Auth::user();
        $this->validate($request, [
            'nombre' => 'required|min:5',
            'tiempo' => 'required',
            'unidad_id' => 'required',
            'costo_estimado'=>'required',
            'costo_real' => 'required',
            'porcentaje_avance' => 'required',
            'entregable' => 'required',
            'fecha_inicio' => 'required',
            'proyecto_id' => 'required',
            'id_actividad' => 'required',
            'email_responsable' => 'required',
        ]);

        if ($request->id != 0) {
            
            Actividad::where('id', $request->id)->update($request->except(['_token']));
        } else
			$nueva_actividad = Actividad::create($request->all());
        return redirect()->route('ver_actividades', ['id' => $request->proyecto_id]);
    }
    public function ver_actividades($proyecto_id)
    {
        $nombre_proyecto = Proyecto::find($proyecto_id)->nombre;
        $actividad = Actividad::where('proyecto_id','=',$proyecto_id)->get();
        if (!$actividad->isEmpty())
        {
            $destino ='proyecto.actividades';
        } else 
        {
            $actividad = new Actividad;
            $actividad->proyecto_id = $proyecto_id;
            $actividad->id_actividad =  $actividad->contar_actividades($proyecto_id)+1;
            $actividad->id = Actividad::all()->count();
            $destino ='proyecto.formeditaactividades';
        }
        $unidades = Unidad::all();
        return view($destino, ['unidades' => $unidades, 'actividad' => $actividad,'proyecto_id'=>$proyecto_id, 'nombre_proyecto'=>$nombre_proyecto]);
    }
    	
    // Acepta la invitacion
    public function acepta_invitacion($proyecto_id)
    {
        $user = Auth::user();
        $usrp = UsuarioRollProyecto::where('proyecto_id','=',$proyecto_id)->where('email_invitado','=',$user->email)->where('tipo_rol','=','Invitado')->get()->first();
        $usrp->email_usuario = $user->email;
        $usrp->tipo_rol = 'Socio';
        $usrp->rol_id = 2;
        $usrp->save();
        return redirect()->route('ver_proyectos');
    }
    
    
}