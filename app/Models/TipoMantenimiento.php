<?php

namespace App\Models;

use CodeIgniter\Model;

class TipoMantenimiento extends Model
{
  protected $table = 'tipo_mantenimientos';
  protected $primaryKey = 'id';

  protected $useAutoIncrement = true;
  protected $allowedFields = ['nombre'];

  protected $useTimestamps = true;
  protected $createdField  = 'created_at';
  protected $updatedField  = 'updated_at';
}
