<?php

namespace App\Models;

use CodeIgniter\Model;

class Equipo extends Model
{
  protected $table = 'equipo';
  protected $primaryKey = 'id';

  protected $useAutoIncrement = true;
  protected $allowedFields = [
    'idTipoEquipo', 'idMarca', 'idEstado', 'fechaDeAdquisicion',
    'ultimoMantenimiento', 'proximoMantenimiento', 'codigoInventario'
  ];

  protected $useTimestamps = true;
  protected $createdField  = 'created_at';
  protected $updatedField  = 'updated_at';

  public function getComponentes($idEquipo)
  {
    $builder = $this->db->table('Equipo_Componente');
    $builder->join('Componentes', 'Componentes.id = Equipo_Componente.idComponente');
    $builder->where('Equipo_Componente.idEquipo', $idEquipo);
    $query = $builder->get();

    return $query->getResultArray();
  }
}
