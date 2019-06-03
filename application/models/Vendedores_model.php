<?php
/**
 * 
 */
date_default_timezone_set("America/Managua");
class Vendedores_model extends CI_Model
{
	
	function __construct()
	{
		$this->load->database();
		$this->load->model("Login_model");		
	}

	public function mostrarSupervisor()
	{
		$this->db->order_by("Estado",TRUE);
		$query = $this->db->get_where("Usuarios", array("IdRol" => 3, "Estado" => 1));
		if($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		return 0;
	}

	public function rutasAsignadas($IdSupervisor)
	{
		$i = 0;
		$json = array();
		$this->db->where('IdSupervisor', $IdSupervisor);
		$query = $this->db->get('cm_Rutas_Asignadas');
		foreach ($query->result_array() as $key) {
			$json[$i]["IdUsuario"] = $key["IdUsuario"];
			$json[$i]["Id_Asing"] = $key["Id_Asing"];
			$json[$i]["IdSupervisor"] = $key["IdSupervisor"];
			$json[$i]["IdVendedor"] = $key["IdVendedor"];
			$json[$i]["IdRuta"] = $key["IdRuta"];
			$json[$i]["Ruta"] = $key["Ruta"];
			$json[$i]["Nombre"] = $key["Nombre"]." ". $key["Apellidos"];
			$json[$i]["Telefono1"] = $key["Telefono1"];
			$json[$i]["Telefono2"] = $key["Telefono2"];
			$json[$i]["Direccion"] = $key["Direccion"];
			$json[$i]["Correo"] = $key["Correo"];
			$i++;				
		}	
		echo json_encode($json);
	}

	public function rutasNoAsignadas(/*$IdSupervisor*/)
	{
		$i = 0;
		$json = array();
		$this->db->order_by('IdRuta', "ASC");
		$query = $this->db->get('cm_Rutas_SinAsignar');
		foreach ($query->result_array() as $key) {
			$json[$i]["IdUsuario"] = $key["IdUsuario"];
			//$json[$i]["Id_Asing"] = $key["Id_Asing"];
			$json[$i]["IdSupervisor"] = $key["IdSupervisor"];
			$json[$i]["IdVendedor"] = $key["IdVendedor"];
			$json[$i]["IdRuta"] = $key["IdRuta"];
			$json[$i]["Ruta"] = $key["Ruta"];
			$json[$i]["Nombre"] = $key["Nombre"]." ". $key["Apellidos"];
			$json[$i]["Telefono1"] = $key["Telefono1"];
			$json[$i]["Telefono2"] = $key["Telefono2"];
			$json[$i]["Direccion"] = $key["Direccion"];
			$json[$i]["Correo"] = $key["Correo"];
			$i++;				
		}	
		echo json_encode($json);
	}


	public function asignarVendedor($asig){
		$json = array();
		$this->db->trans_begin();
		for ($i=0; $i < count($asig); $i++) { 
            $array = explode(",",$asig[$i]);
            $insertAsign = array(
            	"IdSupervisor" => $array[0],
            	"IdVendedor" => $array[1]
            );
           //$this->db->query('EXEC SP_ASIGNACIONES '.$array[0].','.$array[1].',1,@MENSAJE,@RETORNO '); 
            $query = $this->db->query("DECLARE
									@MENSAJE nvarchar(150),
									@RETORNO int

							EXEC [dbo].[SP_ASIGNACIONES]
									  ".$array[0].",
									  ".$array[1].",
									  1,
									@MENSAJE = @MENSAJE OUTPUT,
									@RETORNO = @RETORNO OUTPUT

							SELECT	@MENSAJE as 'MENSAJE',
									@RETORNO as 'RETORNO'");

	           $this->Login_model->insertLog(
	               $this->session->userdata('id'),
	               "Asignar Rutas",
	               "el usuario ".$this->session->userdata('User')." asigno una ruta al supervisor con id ".$array[0]." ",
	               "id vendedor ".$array[1]."",
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

	public function quitarVendedor($asig){
		$json = array();
		$this->db->trans_begin();
		for ($i=0; $i < count($asig); $i++) { 
            $array = explode(",",$asig[$i]);
            $insertAsign = array(
            	"IdSupervisor" => $array[0],
            	"IdVendedor" => $array[1]
            );
           //$this->db->query('EXEC SP_ASIGNACIONES '.$array[0].','.$array[1].',1,@MENSAJE,@RETORNO '); 
            $query = $this->db->query("DECLARE
									@MENSAJE nvarchar(150),
									@RETORNO int

							EXEC [dbo].[SP_ASIGNACIONES]
									  ".$array[0].",
									  ".$array[1].",
									  2,
									@MENSAJE = @MENSAJE OUTPUT,
									@RETORNO = @RETORNO OUTPUT

							SELECT	@MENSAJE as 'MENSAJE',
									@RETORNO as 'RETORNO'");
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
}
?>
