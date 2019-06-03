<?php
class Error_controller extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->library("session");
	}

	public function Forbidden()
	{
		$this->load->view('header/header');
        $this->load->view('errores/AccesoDenegado');
        $this->load->view('footer/footer');
	}

	public function FechaRemCaduca()
	{
		$this->load->view('header/header');
		$this->load->view('errores/EditRemDenegado');
		$this->load->view('footer/footer');
	}
}
?>
