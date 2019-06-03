<?php
/**
 * Created by PhpStorm.
 * User: Sistemas
 * Date: 12/1/2019
 * Time: 10:45
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Integracion_controller extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->model('Integracion_model');
		if ($this->session->userdata("logged") != 1) {
			redirect(base_url() . 'index.php', 'refresh');
		}

		//Do your magic here
	}

	public function index()
	{
		$permiso = $this->Autorizaciones_model->validarPermiso($this->session->userdata("id"), "1020");
		if ($permiso) {
			$data["rutas"] = $this->Hana_model->getRutas();
			$this->load->view('header/header');
			$this->load->view('header/menu');
			$this->load->view('integracion/integracion',$data);
			$this->load->view('footer/footer');
			$this->load->view('jsView/integracion/jsintegracion');
		}else{
			redirect("Error_403", "refresh");
		}

	}

	public function getFacturasPendientes($ruta, $fechaInicio, $fechaFin){
		$this->Integracion_model->getFacturasPendientes($ruta, $fechaInicio, $fechaFin);
	}

	public function detallesFacturas($idencabezado){
		$this->Integracion_model->detallesFacturas($idencabezado);
	}

	public function IntegrarFacturas(){
		$ruta = $this->input->get_post("ruta");
        $fechaInicio = $this->input->get_post("fechaInicio");
	    $fechaFin = $this->input->get_post("fechaFin");
	    $fechaInt = $this->input->get_post("fechaInt");
		/*$ruta = 13;
		$fechaInicio = '2019-02-21';
		$fechaFin = '2019-02-21';
		$fechaInt  = '2019-02-28';*/
		$this->Integracion_model->IntegrarFacturas($ruta, $fechaInicio, $fechaFin,$fechaInt);
	}

}

/* End of file Integracion_controller.php */
