<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_controller extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model("Login_model"); 
		$this->load->library("session");
	}

	public function index()
	{
		$this->load->view('header/header');
		$this->load->view('jsView/usuarios/custom');
		$this->load->view('Login/Login');
	}

	public function Acreditar()
    {
        $this->form_validation->set_rules('username', 'nombre', 'required');
        $this->form_validation->set_rules('pwd', 'pass', 'required');

        if ($this->form_validation->run() == FALSE) {
            redirect('?error=1');
        }
        else {
            $name = $this->input->get_post('username');
            $pass = md5($this->input->get_post('pwd'));
            $data['user'] = $this->Login_model->login($name, $pass);

            if ($data['user'] == 0) {
                $this->Login_model->insertLog(
                         $this->session->userdata('id'),
                         "Iniciar Sesion",
                         "Credenciales incorrectas al iniciar sesion el usuario ".$name." o Password no existen en la base de datos",
                         "sin referencia",
                         "sin referencia",
                          0
                    );

                redirect('?error=2');
            }
            else {
                $sessiondata = array(
                    'id' => $data['user'][0]['IdUsuario'],
					'User' => $data['user'][0]['Nombre_Usuario'],
					'Name' => $data['user'][0]['Nombre'],
					'Apelli' => $data['user'][0]['Apellidos'],
                    'Sexo' => $data['user'][0]['Sexo'],
					'Rol' => $data['user'][0]['Rol'],
					'IdRol' => $data['user'][0]['IdRol'],
					'Estado' => $data["user"][0]["Estado"],
					'Tel' => $data["user"][0]["Telefono1"],
                    'Tel2' => $data["user"][0]["Telefono2"],
					'mail' => $data["user"][0]["Correo"],
					'Dir' => $data["user"][0]["Direccion"],
					'IdRuta' => $data["user"][0]["IdRuta"],
                    'Ruta' => $data["user"][0]["Ruta"],
                    'logged' => 1
                );
                $this->session->set_userdata($sessiondata);

                if ($this->session->userdata) {
                    $this->Login_model->insertLog(
                         $this->session->userdata('id'),
                         "Iniciar Sesion",
                         "El usuario ".$this->session->userdata("User")." inicio sesion",
                         "sin referencia",
                         "sin referencia",
                          1
                    );
                    redirect('Perfil'); //por el momento
                }
            }
        }
	}
	
	public function Salir()
    {
        $this->Login_model->insertLog(
             $this->session->userdata('id'),
             "Cerrar Sesion",
             "El usuario ".$this->session->userdata("User")." cerro sesion",
             "sin referencia",
             "sin referencia",
              1
        );
        $this->session->sess_destroy();
        $sessiondata = array('logged' => 0);
        redirect(base_url() . 'index.php', 'refresh');
	}
}
