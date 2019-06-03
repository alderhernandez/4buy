<?php
class Vendedores_controller extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model("Vendedores_model");
		$this->load->library('session');
		if ($this->session->userdata("logged") != 1) {
            redirect(base_url() . 'index.php', 'refresh');
        }
	}

	public function index()
	{
		$permiso = $this->Autorizaciones_model->validarPermiso($this->session->userdata("id"), "1003");
		if($permiso){
			$data["sup"] = $this->Vendedores_model->mostrarSupervisor();
			$this->load->view('header/header');
			$this->load->view('header/menu');
			$this->load->view('vendedores/vendedores',$data);
			$this->load->view('footer/footer');
			$this->load->view('jsView/vendedores/asignacionesjs');
		} else {
			redirect('Error_403','refresh');
		}
	}

	public function rutasAsignadas($IdSupervisor)
	{
		$this->Vendedores_model->rutasAsignadas($IdSupervisor);
	}

	public function rutasNoAsignadas(/*$IdSupervisor*/)
	{
		$this->Vendedores_model->rutasNoAsignadas(/*$IdSupervisor*/);
	}

	public function asignarVendedor(){
		$permiso = $this->Autorizaciones_model->validarPermiso($this->session->userdata("id"), "1004");
		if($permiso){
			$Asignaciones = $this->input->get_post("asignar");
			$this->Vendedores_model->asignarVendedor($Asignaciones);
			echo "TRUE";
		}else{
			echo "FALSE";
		}
	}

	public function quitarVendedor()
	{
		$permiso = $this->Autorizaciones_model->validarPermiso($this->session->userdata("id"), "1005");
		if($permiso){
			$Asignaciones = $this->input->get_post("quitar");
			$this->Vendedores_model->quitarVendedor($Asignaciones);
		}else{
			echo "FALSE";
		}

	}

}
?>
