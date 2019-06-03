<?php
date_default_timezone_set("America/Managua");
class Usuarios_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('session');
    } 

    /* #region Roles*/
    public function guardarRoles($rol,$descripcion)
    {
        date_default_timezone_set("America/Managua");
        $data = array(
            "Nombre_Rol" => $rol,
            "Descripcion" => $descripcion,
            "Fecha_Creacion" => gmdate(date("Y-m-d")),
            "Estado" => 1
        );
        $this->db->insert("Roles", $data);
    }

    public function mostrarDatosRol()
    {
        $query = '';
        if ($this->session->userdata("IdRol") != 1) {
            $this->db->where("IdRol <>","1");
        }
            $query = $this->db->get("Roles");
        
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return 0;
    }

    public function actualizarEstado($id,$estado)
    {
        $this->db->where("IdRol", $id);
        $data = array(
            "Estado" => $estado
        );
        $this->db->update("Roles", $data);
    }

    public function actualizarRol($id,$rol,$descripcion)
    {
        $this->db->where("IdRol", $id);
        $data = array(
            "Nombre_Rol" => $rol,
            "Descripcion" => $descripcion
        );
        $this->db->update("Roles", $data);
    }
    /* #endregion Roles*/

    /* #region Usuarios */
    public function guardarUsuario($username,$nombre,$apellido,$sexo,$pass,$rol,$tel1,$tel2,$mail,$dir,$idruta,$ruta,$reimprime)
    {
        $data = array(
            "Nombre_Usuario" => $username,
            "Nombre" => $nombre,
            "Apellidos" => $apellido,
            "Sexo" => $sexo,
            "Password" => md5($pass),
            "IdRol" => $rol,
            "Fecha_Registro" => gmdate(date("Y-m-d")),
            "Estado" => 1,
            "Telefono1" => $tel1,
            "Telefono2" => $tel2,
            "Correo" => $mail,
            "Direccion" => $dir,
            "IdRuta" => $idruta,
            "Ruta" => $ruta,
			"Reimprime" => $reimprime
        );
        if ($this->Duplicados($idruta,1)) {
            return $this->db->insert("Usuarios",$data);
        }
        return "-1";
    }

    public function getUsuario()
    {
        $query = $this->db->get("usuarios_rol");
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return 0;
    }

	public function getPerfilUsuario()
	{
		$this->db->where("IdUsuario", $this->session->userdata('id'));
		$query = $this->db->get("usuarios_rol");
		if ($query->num_rows() > 0) {
			return $query->result_array();
		}
		return 0;
	}

    public function actualizarEstadoUser($id,$estado,$idruta)
    {
        $this->db->where("IdUsuario", $id);
        $data = array(
            "Estado" => $estado
        );
        $this->db->update("Usuarios", $data);
    }

    public function actualizarUsuario($id, $username, $nombre, $apellido, $sexo, $rol, $tel1, $tel2, $mail, $dir, $idruta, $ruta, $reimprime)
    {
        $this->db->where("IdUsuario",$id);
        $data = array(
            "Nombre_Usuario" => $username,
            "Nombre" => $nombre,
            "Apellidos" => $apellido,
            "Sexo"=> $sexo,
            "IdRol" => $rol,
            "Telefono1" => $tel1,
            "Telefono2" => $tel2,
            "Correo" => $mail,
            "Direccion" => $dir,
            "IdRuta" => $idruta,
            "Ruta" => $ruta,
			"Reimprime" => $reimprime
        );
        $this->db->update("Usuarios",$data);
    }

    public function Duplicados($idruta,$estado) //Validacion que permite saber si una ruta ya esta asignada a un vendedor
    {
        $query = $this->db->query("SELECT COUNT(*) AS Data FROM Usuarios WHERE Estado = '".$estado."' AND IdRol = '4' 
            AND IdRuta = '".$idruta."' ");
        if($query->result_array()[0]["Data"] >= 1)
        {
           return false;
        }
        return true;
    }
    /* #endregion Usuarios */

    /* #region Logs */
    public function showLogs()
    {
        $i=0;
        $json=array();
        $query = $this->db->get("Logs");
        foreach ($query->result_array() as $key) {
            $json["data"][$i]["Id_Usuario"] = $key["Id_Usuario"];
            $json["data"][$i]["Modulo"] = $key["Modulo"];
            $json["data"][$i]["Descripcion"] = $key["Descripcion"];
            $json["data"][$i]["Fecha"] = $key["Fecha"];
            $json["data"][$i]["Ref1"] = $key["Ref1"];
            $json["data"][$i]["Ref2"] = $key["Ref2"];
            switch ($key["Tipo"]) {
                case 0:
                     $json["data"][$i]["Tipo"] = '<i class="fa fa-times-circle fa-fw text-danger text-md va-middle"></i> Error';
                    break;
                
                case 1:
                    $json["data"][$i]["Tipo"] = '<i class="fa fa-info-circle fa-fw text-success text-md va-middle"></i> Exito';
                    break;
                case 2:
                     $json["data"][$i]["Tipo"] = '<i class="fa fa-warning fa-fw text-warning text-md va-middle"></i> Advertencia';
                    break;
                case 3:
                     $json["data"][$i]["Tipo"] = '<i class="fa fa-bug fa-fw  text-md va-middle"></i> Debug';
                    break;
                default:
                    $json["data"][$i]["Tipo"] = '<i class="fa fa-ban fa-fw  text-md va-middle"></i> Fatal';
                    break;
            }
            $i++;
        }
        echo json_encode($json);
    }
    /* #endregion Logs */

    //ACTUALIZAR DATOS DEL PERFIL
    public function actualizarPerfil($id,$username,$nombre,$apellido,$sexo,$tel1,$tel2,$mail,$dir)
    {
        $this->db->where("IdUsuario",$id);
        $data = array(
            "Nombre_Usuario" => $username,
            "Nombre" => $nombre,
            "Apellidos" => $apellido,
            "Sexo"=> $sexo,
            "Telefono1" => $tel1,
            "Telefono2" => $tel2,
            "Correo" => $mail,
            "Direccion" => $dir
        );
        $this->db->update("Usuarios",$data);
    }

    public function cambiarPassword($id, $oldpass,$newpass){
        $query = $this->db->select("Password")
                 ->where("IdUsuario", $id)
                 ->where("Password", md5($oldpass))
                 ->get("Usuarios");
        if ($query->num_rows() > 0) {
            $this->db->where("IdUsuario",$id);
            $data = array(
                "Password" => md5($newpass)
            );
            $this->db->update("Usuarios",$data);
            echo "TRUE";
        } else {
            echo "FALSE";
        }
    }

    //funcion para mostrar vendedores asignados en el perfil
    public function showVendAsig($idsupervisor){
        $this->db->order_by("IdRuta","asc");
        $this->db->where("IdSupervisor", $idsupervisor);
        $query = $this->db->get("cm_Rutas_Asignadas");
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return 0;
    }

	//region Guardar en tabla Consecutivos
	public function guardarConsecutivos($ruta){
    	date_default_timezone_set("America/Managua");
		$query = $this->db->where("IdRuta", $ruta)
				 ->get("Consecutivos");
		if($query->num_rows() == 0){
			$insert = array(
				"IdRuta" => $ruta,
				"Siglas" => "APP".$ruta,
				"Consecutivo" => 0,
				"Estado" => 1,
				"Fecha" => gmdate(date("Y-m-d H:i:s"))
			);
			$this->db->insert("Consecutivos",$insert);
		}
	}
	//endregion
}
?>
