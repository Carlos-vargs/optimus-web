<?php

namespace App\Controllers;

use App\Models\Estado;
use CodeIgniter\RESTful\ResourceController;
use Exception;

class EstadosController extends ResourceController
{
  protected $modelName = 'App\Models\Estado';
  protected $format    = 'json';

  public function index()
  {
    $estadoModel = new Estado();
    $estados = $estadoModel->findAll();
    return $this->respond($estados);
  }

  public function show($id = null)
  {
    $estadoModel = new Estado();
    $estado = $estadoModel->find($id);
    if (!$estado) {
      return $this->failNotFound('Estado no encontrado con ID: ' . $id);
    }
    return $this->respond($estado);
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
      return $this->failNotFound('Estado no encontrado con ID: ' . $id);
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
        return $this->respondDeleted(['id' => $id, 'message' => 'Estado eliminado']);
      } else {
        return $this->failNotFound('Estado no encontrado');
      }
    } catch (Exception $e) {
      return $this->failServerError($e->getMessage());
    }
  }
}
