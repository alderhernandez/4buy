<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Usuarios_controller extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->model('Usuarios_model');
		$this->load->model("Facturas_model");
        $this->load->library("session");
       if ($this->session->userdata("logged") != 1) {
            redirect(base_url() . 'index.php', 'refresh');
        } 
    }

	public function index()
	{
        $permiso = $this->Autorizaciones_model->validarPermiso($this->session->userdata("id"), "10");
        if ($permiso) {
            $data["roles"] = $this->Usuarios_model->mostrarDatosRol();
            $data["users"] = $this->Usuarios_model->getUsuario();
            $data["rutas"] = $this->Hana_model->getRutas();
            $this->load->view('header/header');
            $this->load->view('header/menu');
            $this->load->view('usuarios/usuarios',$data);
            $this->load->view('footer/footer');
            $this->load->view('jsView/usuarios/jsUsuarios');   
        } else {
             redirect('Error_403','refresh');
        }
    }
    
    public function Roles()
	{
        $permiso = $this->Autorizaciones_model->validarPermiso($this->session->userdata("id"), "11");
        if ($permiso) {
            $data["roles"] = $this->Usuarios_model->mostrarDatosRol();
            $this->load->view('header/header');
            $this->load->view('header/menu');
            $this->load->view('usuarios/roles',$data);
            $this->load->view('footer/footer');
            $this->load->view('jsView/usuarios/jsRoles');
         }else{
             redirect('Error_403','refresh');
         }
    }
    
    public function guardarRoles()
    {
        $permiso = $this->Autorizaciones_model->validarPermiso($this->session->userdata("id"), "15");
        if ($permiso) {
            $rol = $this->input->get_post("Rol");
            $descripcion = $this->input->get_post("tadescripcion");
            $this->Usuarios_model->guardarRoles($rol,$descripcion);
             $this->Login_model->insertLog(
                $this->session->userdata('id'),
                "Usuarios/Crear Rol",
                "El usuario ".$this->session->userdata("User")." creo el Rol ".$rol."",
                "sin referencia",
                "sin referencia",
                1
            );
             echo "TRUE";
        }else{
            echo "FALSE";
        }
    }   

    public function actualizarEstado($id,$estado)
    {
        $permiso = $this->Autorizaciones_model->validarPermiso($this->session->userdata("id"), "17");
        if ($permiso) {
                if ($estado == 1) {
                $estado = 0;
                 $this->Login_model->insertLog(
                $this->session->userdata('id'),
                "Usuarios/Dar baja",
                "El usuario ".$this->session->userdata("User")." dio de baja al usuario ".$nombre." ".$apellido."",
                "sin referencia",
                "sin referencia",
                1
              );
            } else {
                $estado = 1;
                 $this->Login_model->insertLog(
                $this->session->userdata('id'),
                "Usuarios/Restaurar",
                "El usuario ".$this->session->userdata("User")." restauro al usuario ".$nombre." ".$apellido."",
                "sin referencia",
                "sin referencia",
                1
               );
            }
           $this->Usuarios_model->actualizarEstado($id,$estado);
           echo "TRUE";
        }else{
            echo "FALSE";
        }
    }

    public function actualizarRol( $id)
    {
        $permiso = $this->Autorizaciones_model->validarPermiso($this->session->userdata("id"), "16");
        if ($permiso) {
            $rol = $this->input->get_post("Roledit");
            $descripcion = $this->input->get_post("tadescripcionedit");
            $this->Usuarios_model->actualizarRol($id,$rol,$descripcion);
             $this->Login_model->insertLog(
                $this->session->userdata('id'),
                "Usuarios/Actualizar Rol",
                "El usuario ".$this->session->userdata("User")." actualizo el Rol ".$rol."",
                "sin referencia",
                "sin referencia",
                1
            );
             echo "TRUE";
        }else{
            echo "FALSE";
        }
    }

/* #region Usuarios */
    public function guardarUsuario()
    {
        //transaccion
        $permiso = $this->Autorizaciones_model->validarPermiso($this->session->userdata("id"), "12");
        if ($permiso) {
            $username = $this->input->get_post("username");
            $nombre = $this->input->get_post("nombre");
            $apellido = $this->input->get_post("apellido");
            $sexo = $this->input->get_post("genero");
            $pass = $this->input->get_post("pass");
            $rol = $this->input->get_post("idRol");
            $tel1 = $this->input->get_post("tel1");
            $tel2 = $this->input->get_post("tel2");
            $mail = $this->input->get_post("mail");
            $dir = $this->input->get_post("direccion");
            $idruta = $this->input->get_post("IdRutas");
            $ruta = $this->input->get_post("Rutas");
			$reimprime = $this->input->get_post("reimprime");
            $this->Usuarios_model->guardarUsuario($username,$nombre,$apellido,$sexo,$pass,$rol,$tel1,$tel2,$mail,$dir,$idruta,$ruta,$reimprime);
             $this->Login_model->insertLog(
                $this->session->userdata('id'),
                "Usuarios/Actualizar Usuario",
                "El usuario ".$this->session->userdata("User")." creo un nuevo usuario ".$username." ",
                "sin referencia",
                "sin referencia",
                1
            );
             echo "TRUE";
        }else{
            echo "FALSE";
        }
    }

    public function actualizarEstadoUser($id,$estado,$idruta)
    {
        $permiso = $this->Autorizaciones_model->validarPermiso($this->session->userdata("id"), "14");
        if ($permiso) {
            if ($estado == 1) {
                $estado = 0;
            } else {
                $estado = 1;
            }
            if ($this->Usuarios_model->Duplicados($idruta,1)) {
                $this->Usuarios_model->actualizarEstadoUser($id,$estado,$idruta);
                    $this->Login_model->insertLog(
                        $this->session->userdata('id'),
                        $this->uri->segment(1),
                        "El usuario ".$this->session->userdata("User")." modifico el estado del usuario con id ".$id." ",
                        "sin referencia",
                        "sin referencia",
                        1
                    );
                echo "1";
            }else{
                echo "-1";
                $this->Login_model->insertLog(
                        $this->session->userdata('id'),
                        $this->uri->segment(1),
                        "El usuario ".$this->session->userdata("User")." intento modificar el estado del usuario con id ".$id." ",
                        "sin referencia",
                        "sin referencia",
                        0
                    );
            }
            echo "TRUE";
        }else{
            echo "FALSE";
        }
    }

    public function actualizarUsuario()
    {
        $permiso = $this->Autorizaciones_model->validarPermiso($this->session->userdata("id"), "13");
        if ($permiso) {
            $id = $this->input->get_post("iduser");
            $username = $this->input->get_post("username");
            $nombre = $this->input->get_post("nombre");
            $apellido = $this->input->get_post("apellido");
            $sexo = $this->input->get_post("genero");
            $rol = $this->input->get_post("idRol");
            $tel1 = $this->input->get_post("tel1");
            $tel2 = $this->input->get_post("tel2");
            $mail = $this->input->get_post("mail");
            $dir = $this->input->get_post("direccion");
            $idruta = $this->input->get_post("IdRutas");
            $ruta = $this->input->get_post("Rutas");
			$reimprime = $this->input->get_post("reimprime");
            $this->Usuarios_model->actualizarUsuario($id,$username,$nombre,$apellido,$sexo,$rol,$tel1,$tel2,$mail,$dir,$idruta,$ruta,$reimprime);
            $this->Login_model->insertLog(
                $this->session->userdata('id'),
                "Usuarios/Actualizar Usuario",
                "El usuario ".$this->session->userdata("User")." actualizo los datos del usuario ".$nombre." ".$apellido."",
                "sin referencia",
                "sin referencia",
                1
            );
            echo "TRUE";
        }else{
            echo "FALSE";
        }
    }
/* #endregion Usuarios */

/* #region Logs */
    public function LogsView()
    {
        $permiso = $this->Autorizaciones_model->validarPermiso($this->session->userdata("id"), "18");
        if ($permiso) {
            $this->load->view('header/header');
            $this->load->view('header/menu');
            $this->load->view('usuarios/logView');
            $this->load->view('footer/footer');
            $this->load->view('jsView/usuarios/jsLogs');
        }else{
            redirect('Error_403','refresh');
        }
    }

    public function ShowLogs()
    {
        $this->Usuarios_model->showLogs();   
    }
/* #endregion Logs */

/* #region Perfil */
    public function Perfil()
  {
    $data["datos"] = $this->Usuarios_model->showVendAsig($this->session->userdata('id'));
    $data["users"] = $this->Usuarios_model->getPerfilUsuario();
    $data["facts"] = $this->Facturas_model->facturasMesActual($this->session->userdata('IdRuta'));
    $this->load->view('header/header');
    $this->load->view('header/menu');
    if ($this->session->userdata('IdRol') == 3) {
        $this->load->view('usuarios/Perfil_Usuario',$data);
    }elseif($this->session->userdata('IdRol') == 4){
		$this->load->view('usuarios/Perfil_Usuario',$data);
	}
    else{
        $this->load->view('usuarios/Perfil_Usuario',$data);
    }
    $this->load->view('footer/footer');
    $this->load->view('jsView/usuarios/jsPerfil');
  }
/* #endregion Perfil */

    public function actualizarPerfil()
    {
        $id = $this->input->get_post("iduser");
        $username = $this->input->get_post("username");
        $nombre = $this->input->get_post("nombre");
        $apellido = $this->input->get_post("apellido");
        $sexo = $this->input->get_post("genero");
        $tel1 = $this->input->get_post("tel1");
        $tel2 = $this->input->get_post("tel2");
        $mail = $this->input->get_post("mail");
        $dir = $this->input->get_post("direccion");
        $this->Usuarios_model->actualizarPerfil($id,$username,$nombre,$apellido,$sexo,$tel1,$tel2,$mail,$dir);
        $this->Login_model->insertLog(
        $this->session->userdata('id'),
            "Usuarios/Perfil/Actualizar Perfil",
            "El usuario ".$this->session->userdata("User")." actualizo los datos de su perfil de usuario",
            "sin referencia",
            "sin referencia",
            1
        );
    }

    public function cambiarPassword(){
        $id = $this->input->get_post("profileId");
        $oldpass = $this->input->get_post("oldPass");
        $newpass = $this->input->get_post("NewPass");
        $this->Usuarios_model->cambiarPassword($id,$oldpass,$newpass);
      $this->Login_model->insertLog(
        $this->session->userdata('id'),
            "Usuarios/Perfil/Actualizar Password",
            "El usuario ".$this->session->userdata("User")." actualizo su password",
            "sin referencia",
            "sin referencia",
            1
        );
    }

   	public function guardarConsecutivos($ruta){
		$this->Usuarios_model->guardarConsecutivos($ruta);
	}

}
