<?php
namespace App\Models;
use CodeIgniter\Model;
class Sesion_model extends Model
{
	protected $table = 'sesiones'; // Nombre de la tabla
    protected $primaryKey = 'id_sesion'; // Clave primaria
    protected $allowedFields = ['id_usuario', 'inicio_sesion', 'fin_sesion', 'estado']; // Campos que se pueden insertar
    /**
     * Obtener sesiones con datos del usuario.
     */
    public function getSesionesConUsuarios()
    {
        return $this->db->table('sesiones')
            ->select('sesiones.id_sesion, sesiones.inicio_sesion, sesiones.fin_sesion, sesiones.estado, usuarios.nombre, usuarios.email')
            ->join('usuarios', 'usuarios.id = sesiones.id_usuario')
            ->get()
            ->getResult();
    }
    public function getSesion($id){

    	return $this->where('id_sesion',$id)->first($id);
    }

    public function actualizar_sesion($id_sesion, $data) {
        return $this->db->table('sesiones') // Indicar la tabla
        ->where('id_sesion', $id_sesion) // Condición si son iguales actualiza
        ->update($data); // Actualización
    }
}
