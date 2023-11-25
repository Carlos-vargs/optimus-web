<?php

namespace App\Controllers;

use App\Models\Falla;
use CodeIgniter\RESTful\ResourceController;
use Exception;

class FallasController extends ResourceController
{
  protected $modelName = 'App\Models\Falla';
  protected $format    = 'json';

  public function index()
  {
    $fallaModel = new Falla();
    $fallas = $fallaModel->findAll();
    return $this->respond($fallas);
  }

  public function show($id = null)
  {
    $fallaModel = new Falla();
    $falla = $fallaModel->find($id);
    if (!$falla) {
      return $this->failNotFound('Falla no encontrada con ID: ' . $id);
    }

    $falla['mantenimientos'] = $fallaModel->getMantenimientos($id);
    return $this->respond($falla);
  }

  public function create()
  {
    $rules = [
      'descripcion' => 'required|string|max_length[255]'
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
      'descripcion' => 'required|string|max_length[255]'
    ];

    $json = $this->request->getJSON(true);

    if (!$this->model->find($id)) {
      return $this->failNotFound('Falla no encontrada con ID: ' . $id);
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
        return $this->respondDeleted(['id' => $id, 'message' => 'Falla eliminada']);
      } else {
        return $this->failNotFound('Falla no encontrada');
      }
    } catch (Exception $e) {
      return $this->failServerError($e->getMessage());
    }
  }
}
