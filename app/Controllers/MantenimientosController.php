<?php

namespace App\Controllers;

use App\Models\Mantenimiento;
use CodeIgniter\RESTful\ResourceController;
use Exception;

class MantenimientosController extends ResourceController
{
  protected $modelName = 'App\Models\Mantenimiento';
  protected $format    = 'json';

  public function index()
  {
    $mantenimientoModel = new Mantenimiento();
    $mantenimientos = $mantenimientoModel->findAll();
    return $this->respond($mantenimientos);
  }

  public function show($id = null)
  {
    $mantenimientoModel = new Mantenimiento();
    $mantenimiento = $mantenimientoModel->find($id);
    if (!$mantenimiento) {
      return $this->failNotFound('Mantenimiento no encontrado con ID: ' . $id);
    }

    $mantenimiento['fallas'] = $mantenimientoModel->getFallas($id);
    return $this->respond($mantenimiento);
  }

  public function create()
  {
    $rules = [
      'idEquipo' => 'required|integer',
      'idTipoDeMantenimiento' => 'required|integer',
      'descripcion' => 'required|string|max_length[255]',
      'solucionesImplementadas' => 'required|string|max_length[255]'
    ];

    $json = $this->request->getJSON(true);
    if (!$this->validate($rules, $json)) {
      return $this->fail($this->validator->getErrors());
    }

    try {
      $this->model->insert($json);
      $id = $this->model->getInsertID();
      return $this->respondCreated($this->model->find($id));
    } catch (Exception $e) {
      return $this->failServerError($e->getMessage());
    }
  }

  public function update($id = null)
  {
    $rules = [
      'idEquipo' => 'required|integer',
      'idTipoDeMantenimiento' => 'required|integer',
      'descripcion' => 'required|string|max_length[255]',
      'solucionesImplementadas' => 'required|string|max_length[255]'
    ];

    $json = $this->request->getJSON(true);

    if (!$this->model->find($id)) {
      return $this->failNotFound('Mantenimiento no encontrado con ID: ' . $id);
    }

    if (!$this->validate($rules, $json)) {
      return $this->fail($this->validator->getErrors());
    }

    try {
      $this->model->update($id, $json);
      return $this->respond($this->model->find($id));
    } catch (Exception $e) {
      return $this->failServerError($e->getMessage());
    }
  }

  public function delete($id = null)
  {
    try {
      if ($this->model->delete($id)) {
        return $this->respondDeleted(['id' => $id, 'message' => 'Mantenimiento eliminado']);
      } else {
        return $this->failNotFound('Mantenimiento no encontrado');
      }
    } catch (Exception $e) {
      return $this->failServerError($e->getMessage());
    }
  }
}
