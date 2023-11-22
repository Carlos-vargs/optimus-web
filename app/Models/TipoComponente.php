<?php

namespace App\Models;

use CodeIgniter\Model;

class TipoComponente extends Model
{
  protected $table = 'tipo_componentes';
  protected $primaryKey = 'id';

  protected $useAutoIncrement = true;
  protected $allowedFields = ['nombre'];

  protected $useTimestamps = true;
  protected $createdField  = 'created_at';
  protected $updatedField  = 'updated_at';
}
