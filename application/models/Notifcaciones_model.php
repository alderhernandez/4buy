<?php
/**
 * Created by PhpStorm.
 * User: Sistemas
 * Date: 7/1/2019
 * Time: 16:55
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Notifcaciones_model extends CI_Model
{

	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

//region Description
	// TODO: mostrar aqui todas la notificaciones, no solo de facturas no integradas
	public function mostrarNotificaciones()
	{
		$numFact = $this->notifFactPendientes();
		$anular = $this->notifiAnularFactura();
		$notificaciones = array(
			"numFacturas" => $numFact,
			"anularFacturas" => $anular
		);
		return $notificaciones;
	}
	//endregion

	public function notifFactPendientes(){
		$permiso = $this->Autorizaciones_model->validarPermiso($this->session->userdata("id"), "1021");
		if($permiso){
			$numFact = $this->db->query("select COUNT(*) 'cantidad' from Facturas where ESTADOAPP = '1'");
			if($numFact->num_rows() > 0){
				$numFact = $numFact->result_array()[0]["cantidad"];
			}

			return $numFact;
		}
	}

	public function notifiAnularFactura(){
		// TODO: validar por permiso, crear autorizacion
		$permiso = $this->Autorizaciones_model->validarPermiso($this->session->userdata("id"), "1022");
		if($permiso){
			$anular = $this->db->get("cm_solicitud_anular_fact");
			$array = array();
			$i = 0;
			if($anular->num_rows() > 0){
				foreach ($anular->result_array() as $item){
					$array[$i]["CANTIDAD"] = $item["CANTIDAD"];
					$array[$i]["IDENCABEZADO"] = $item["IDENCABEZADO"];
					$array[$i]["IDFACTURA"] = $item["IDFACTURA"];
					$array[$i]["COMENTARIO"] = $item["COMENTARIO"];
					$array[$i]["FECHASOLICITUD"] = $item["FECHASOLICITUD"];
					$array[$i]["NOMBREUSUARIOSOLICITA"] = $item["NOMBREUSUARIOSOLICITA"];
					$i++;
				}
			}
			return $array;
		}
	}
}

/* End of file .php */
