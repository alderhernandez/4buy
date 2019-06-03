<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Autorizaciones_controller extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('Autorizaciones_model');
		$this->load->model('Usuarios_model');
		$this->load->library('session');
		if ($this->session->userdata("logged") != 1) {
            redirect(base_url() . 'index.php', 'refresh');
        }   
        if ($this->session->userdata("IdRol") != 1) {
            redirect('Error_403','refresh');
        }
	}

	public function index()
	{
		$data['autlist'] = $this->Autorizaciones_model->getAutorizaciones();
		$data["autcat"] = $this->Autorizaciones_model->getAuthCat();
		$this->load->view('header/header');
        $this->load->view('header/menu');
		$this->load->view('autorizaciones/autorizaciones',$data);
		$this->load->view('footer/footer');
        $this->load->view('jsView/autorizaciones/jsautorizaciones');
	}

	public function crearPermiso(){
		$desc = $this->input->get_post("descripcion");
		$modulo = $this->input->get_post("modulo");
		$categoria = $this->input->get_post("categoria");
		$this->Autorizaciones_model->crearPermiso($desc,$modulo,$categoria);
	}

	public function darBaja($id,$estado){
		if ($estado == 1) {
			$estado = 0;
		} else {
			$estado = 1;
		}
		
		$this->Autorizaciones_model->darBaja($id,$estado);
	}

	public function actualizarPermiso(){
		$id = $this->input->get_post("idaut");
		$desc = $this->input->get_post("descripcion");
		$modulo = $this->input->get_post("modulo");
		$categoria = $this->input->get_post("categoria");
		$this->Autorizaciones_model->actualizarPermiso($id,$desc,$modulo,$categoria);
	}


	/*********************************************ASIGNACION DE AUTORIZACIONES*****************************************************/
	public function asignar_aut(){
		$data['list'] = $this->Autorizaciones_model->getAuthAJAX();
		$data["users"] = $this->Usuarios_model->getUsuario();
		$this->load->view('header/header');
        $this->load->view('header/menu');
		$this->load->view('autorizaciones/asignar_aut',$data);
		$this->load->view('footer/footer');
        $this->load->view('jsView/autorizaciones/jsasignar_aut');
	}

	public function asignarPermiso(){
		$data = $this->input->get_post("datos");
	    $this->Autorizaciones_model->asignarPermiso($data);
	}

	public function quitarPermiso(){
		$data = $this->input->get_post("datos");
	    $this->Autorizaciones_model->quitarPermiso($data);
	}

	public function getAuthAsig($idUsuario){
		$this->Autorizaciones_model->getAuthAsig($idUsuario);
	}

	/*********************************************ASIGNACION DE AUTORIZACIONES*****************************************************/
}

/* End of file Autorizaciones_controller.php */
/* Location: ./application/controllers/Autorizaciones_controller.php */