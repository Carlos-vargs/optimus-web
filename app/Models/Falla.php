<?php

namespace App\Models;

use CodeIgniter\Model;

class Falla extends Model
{
  protected $table = 'falla';
  protected $primaryKey = 'id';

  protected $useAutoIncrement = true;
  protected $allowedFields = ['descripcion'];

  protected $useTimestamps = true;
  protected $createdField  = 'created_at';
  protected $updatedField  = 'updated_at';

  public function getMantenimientos($idFalla)
  {
    $builder = $this->db->table('mantenimiento_falla');
    $builder->join('mantenimientos', 'mantenimientos.id = mantenimiento_falla.idMantenimiento');
    $builder->where('mantenimiento_falla.idFalla', $idFalla);
    $query = $builder->get();

    return $query->getResultArray();
  }
}
