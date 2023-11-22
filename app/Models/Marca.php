<?php

namespace App\Models;

use CodeIgniter\Model;

class Marca extends Model
{
  protected $table = 'marcas';
  protected $primaryKey = 'id';

  protected $useAutoIncrement = true;
  protected $allowedFields = ['nombre'];

  protected $useTimestamps = true;
  protected $createdField  = 'created_at';
  protected $updatedField  = 'updated_at';
}
