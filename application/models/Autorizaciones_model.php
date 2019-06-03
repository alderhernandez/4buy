<?php
date_default_timezone_set("America/Managua");
defined('BASEPATH') OR exit('No direct script access allowed');

class Autorizaciones_model extends CI_Model {

	function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->model("Login_model");
	}

	public function getAutorizaciones(){
		$query = $this->db->get('cm_AuthCategoria');
		if ($query->num_rows() > 0) {
			return $query->result_array();
		}
		return 0;
	}

	public function crearPermiso($desc,$modulo,$cat){
		$data = array(
			"Descripcion" => $desc,
			"Modulo" => $modulo,
			"Id_Autorizacion_Categoria" => $cat,
			"Estado" => 1,
			"Fecha_Crea" => gmdate(date("Y-m-d h:i:s"))
		);
		$this->db->insert('Autorizaciones', $data);
	}

	public function darBaja($id,$estado){
		$this->db->where("Id_Autorizacion",$id);
		$data = array(
			"Estado" => $estado,
			"Fecha_Baja" => gmdate(date("Y-m-d h:i:s"))
		);
		$this->db->update("Autorizaciones",$data);
	}

	public function actualizarPermiso($id,$desc,$modulo,$cat){
		$this->db->where("Id_Autorizacion",$id);
		$data = array(
			"Descripcion" => $desc,
			"Modulo" => $modulo,
			"Id_Autorizacion_Categoria" => $cat,
			"Fecha_Actualiza" => gmdate(date("Y-m-d h:i:s"))
		);
		$this->db->update('Autorizaciones', $data);
	}

	public function getAuthCat(){
		$query = $this->db->get("AutorizacionesCategoria");
		if ($query->num_rows() > 0) {
			return $query->result_array();
		}
		return 0;
	}

	public function getAuthAJAX(){
		$this->db->where("Estado",1);
		$this->db->order_by("Id_Autorizacion_Categoria");
		$query = $this->db->get("cm_AuthCategoria");
		if ($query->num_rows() > 0) {
			return $query->result_array();
		}
		return 0;
	}
	/*********************************************************************************************/

	public function asignarPermiso($asig){
		$json = array();
		$this->db->trans_begin();
		for ($i=0; $i < count($asig); $i++) { 
			$array = explode(",", $asig[$i]);
			$insert = array(
				"IdUsuario" => $array[0],
				"IdAutorizacion" => $array[1]
			);
			$query = $this->db->query(
				"	DECLARE	@return_value int,
					@MENSAJE nvarchar(150),
					@RETORNO int

			EXEC	@return_value = [dbo].[SP_AUTORIZACIONES]
					@IN_IDUSUARIO = ".$array[0].",
					@IN_IDPERMISO = ".$array[1].",
					@IN_IDPROCESO = 1,
					@MENSAJE = @MENSAJE OUTPUT,
					@RETORNO = @RETORNO OUTPUT

			SELECT	@MENSAJE as 'MENSAJE',
					@RETORNO as 'RETORNO'");

			$this->Login_model->insertLog(
	               $this->session->userdata('id'),
	               "Asignar Permisos",
	               "".$this->session->userdata('User')." asigno el permiso ".$array[1]." al usuario con id ".$array[0]." ",
	               "sin referencia",
	               "sin referencia",
	               1
	            );
		}
		echo json_encode($query->result_array());

		if ($this->db->trans_status() === FALSE)
		{
		        $this->db->trans_rollback();
		}
		else
		{
		        $this->db->trans_commit();
		}
	}

	public function getAuthAsig($idUsuario){
		$i = 0;
		$json = array();
		$query = $this->db->select("IdAutorizacion")
		       ->where("IdUsuario", $idUsuario)
		       ->get("AutorizacionesUsuario");
		if ($query->num_rows() > 0 ) {
			foreach ($query->result_array() as $key) {
		      $json[$i]["IdAutorizacion"] = $key["IdAutorizacion"];
		      $i++;  
		    }      
		} 
			echo json_encode($json);
	}	

	public function quitarPermiso($asig){
		$json = array();
		$this->db->trans_begin();
		for ($i=0; $i < count($asig); $i++) { 
			$array = explode(",", $asig[$i]);
			$insert = array(
				"IdUsuario" => $array[0],
				"IdAutorizacion" => $array[1]
			);
			$query = $this->db->query(
				"	DECLARE	@return_value int,
					@MENSAJE nvarchar(150),
					@RETORNO int

			EXEC	@return_value = [dbo].[SP_AUTORIZACIONES]
					@IN_IDUSUARIO = ".$array[0].",
					@IN_IDPERMISO = ".$array[1].",
					@IN_IDPROCESO = 2,
					@MENSAJE = @MENSAJE OUTPUT,
					@RETORNO = @RETORNO OUTPUT

			SELECT	@MENSAJE as 'MENSAJE',
					@RETORNO as 'RETORNO'");

			$this->Login_model->insertLog(
	               $this->session->userdata('id'),
	               "Asignar Permisos",
	               "".$this->session->userdata('User')." quito el permiso ".$array[1]." al usuario con id ".$array[0]." ",
	               "sin referencia",
	               "sin referencia",
	               1
	            );
		}
		echo json_encode($query->result_array());

		if ($this->db->trans_status() === FALSE)
		{
		        $this->db->trans_rollback();
		}
		else
		{
		        $this->db->trans_commit();
		}
	}

	/*********************************************************************************************/

    /*
		funcion que permite determinar si un usuario x posee x permiso
    */
	public function validarPermiso($idUsuario, $idPermiso){
		$query = $this->db->select("IdAutorizacion")
		       ->where("IdUsuario", $idUsuario)
		       ->where("IdAutorizacion", $idPermiso)
		       ->get("AutorizacionesUsuario");
		if($query->num_rows() > 0){
			return $query->result_array();
		}       
		return 0;
	}
}

/* End of file Autorizaciones_model.php */
/* Location: ./application/models/Autorizaciones_model.php */
