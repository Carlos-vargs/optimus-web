<?php

namespace App\Models;

use CodeIgniter\Model;

class TipoEquipo extends Model
{
  protected $table = 'tipo_equipos';
  protected $primaryKey = 'id';

  protected $useAutoIncrement = true;
  protected $insertID = 0;
  protected $returnType = 'array';

  protected $allowedFields = ['nombre'];

  protected $useTimestamps = true;
  protected $createdField  = 'created_at';
  protected $updatedField  = 'updated_at';
}
