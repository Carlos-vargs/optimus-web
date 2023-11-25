<?php

namespace App\Controllers;

use App\Models\TipoEquipo;
use CodeIgniter\RESTful\ResourceController;
use Exception;

class TipoEquiposController extends ResourceController
{
  protected $modelName = 'App\Models\TipoEquipo';
  protected $format    = 'json';

  public function index()
  {
    $tipoEquipoModel = new TipoEquipo();
    $tipoEquipos = $tipoEquipoModel->findAll();
    return $this->respond($tipoEquipos);
  }

  public function show($id = null)
  {
    $tipoEquipoModel = new TipoEquipo();
    $tipoEquipo = $tipoEquipoModel->find($id);
    if (!$tipoEquipo) {
      return $this->failNotFound('Tipo de equipo no encontrado con ID: ' . $id);
    }
    return $this->respond($tipoEquipo);
  }

  public function create()
  {
    $rules = [
      'nombre' => 'required|alpha_space|max_length[50]'
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
      'nombre' => 'required|alpha_space|max_length[50]'
    ];

    $json = $this->request->getJSON(true);

    if (!$this->model->find($id)) {
      return $this->failNotFound('Tipo de equipo no encontrado con ID: ' . $id);
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
        return $this->respondDeleted(['id' => $id, 'message' => 'Tipo de equipo eliminado']);
      } else {
        return $this->failNotFound('Tipo de equipo no encontrado');
      }
    } catch (Exception $e) {
      return $this->failServerError($e->getMessage());
    }
  }
}
