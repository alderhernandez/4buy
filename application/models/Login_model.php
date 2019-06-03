<?php
class Login_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function login($name,$pass)
    {
        if ($name != FALSE && $pass != FALSE) {
            $this->db->where('Nombre_Usuario', $name);
            $this->db->where('Password', $pass);
            
            $this->db->where("Estado",1);
            $query = $this->db->get('usuarios_rol');

            if ($query->num_rows() == 1) {
                return $query->result_array();
            }
            return 0;
        }
    }

    public function insertLog($idUser,$modulo,$desc,$ref1,$ref2,$tipo)
    {
        date_default_timezone_set("America/Managua");
        $data = array(
            "Id_Usuario" => $idUser,
            "Modulo" => $modulo,
            "Descripcion" => $desc,
            "Fecha" => gmdate(date("Y-m-d h:i:s")),
            "Ref1" => $ref1,
            "Ref2" => $ref2,
            "Tipo" => $tipo
        );
        $this->db->insert("Logs", $data);
    }
}
?>