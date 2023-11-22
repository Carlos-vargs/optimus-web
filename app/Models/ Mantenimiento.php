<?php

namespace App\Models;

use CodeIgniter\Model;

class Mantenimiento extends Model
{
  protected $table = 'mantenimientos';
  protected $primaryKey = 'id';

  protected $useAutoIncrement = true;
  protected $allowedFields = ['idEquipo', 'idTipoDeMantenimiento', 'descripcion', 'solucionesImplementadas'];

  protected $useTimestamps = true;
  protected $createdField  = 'created_at';
  protected $updatedField  = 'updated_at';

  // Antes de insertar, generar el ticket.
  protected function beforeInsert(array $data)
  {
    $data = $this->generateTicket($data);
    return $data;
  }

  // Antes de actualizar, generar el ticket.
  protected function beforeUpdate(array $data)
  {
    $data = $this->generateTicket($data);
    return $data;
  }

  // Función privada para generar el ticket
  private function generateTicket($data)
  {
    if (isset($data['data']['idEquipo'])) {
      $fecha = date('Ymd'); // Obtiene la fecha actual con el formato deseado.
      $idEquipoFormateado = str_pad($data['data']['idEquipo'], 3, '0', STR_PAD_LEFT); // Asegura que el ID del equipo tenga 3 dígitos.
      $data['data']['ticket'] = $fecha . '-' . $idEquipoFormateado; // Combina los componentes para formar el ticket.
    }
    return $data;
  }

  public function getFallas($idMantenimiento)
  {
    $builder = $this->db->table('mantenimiento_falla');
    $builder->join('fallas', 'fallas.id = mantenimiento_falla.idFalla');
    $builder->where('mantenimiento_falla.idMantenimiento', $idMantenimiento);
    $query = $builder->get();

    return $query->getResultArray();
  }
}
