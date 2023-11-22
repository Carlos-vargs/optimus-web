<?php

namespace App\Models;

use CodeIgniter\Model;

class Componente extends Model
{
  protected $table = 'componentes';
  protected $primaryKey = 'id';

  protected $useAutoIncrement = true;
  protected $allowedFields = ['idTipoComponente', 'idMarca', 'codigoInventario', 'fechaDeAdquisicion'];

  protected $useTimestamps = true;
  protected $createdField  = 'created_at';
  protected $updatedField  = 'updated_at';

  // Método para obtener el TipoComponente asociado a un componente
  public function getTipoComponente($idTipoComponente)
  {
    $tipoComponenteModel = new TipoComponente();
    return $tipoComponenteModel->find($idTipoComponente);
  }

  // Método para obtener la Marca asociada a un componente
  public function getMarca($idMarca)
  {
    $marcaModel = new Marca();
    return $marcaModel->find($idMarca);
  }

  public function getEquipos($idComponente)
  {
    $builder = $this->db->table('Equipo_Componente');
    $builder->join('Equipos', 'Equipos.id = Equipo_Componente.idEquipo');
    $builder->where('Equipo_Componente.idComponente', $idComponente);
    $query = $builder->get();

    return $query->getResultArray();
  }
}
