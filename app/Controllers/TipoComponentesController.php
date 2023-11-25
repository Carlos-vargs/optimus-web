<?php

namespace App\Controllers;

use App\Models\TipoComponente;
use CodeIgniter\RESTful\ResourceController;
use Exception;

class TipoComponentesController extends ResourceController
{
  protected $modelName = 'App\Models\TipoComponente';
  protected $format    = 'json';

  public function index()
  {
    $tipoComponenteModel = new TipoComponente();
    $tipoComponentes = $tipoComponenteModel->findAll();
    return $this->respond($tipoComponentes);
  }

  public function show($id = null)
  {
    $tipoComponenteModel = new TipoComponente();
    $tipoComponente = $tipoComponenteModel->find($id);
    if (!$tipoComponente) {
      return $this->failNotFound('Tipo de componente no encontrado con ID: ' . $id);
    }
    return $this->respond($tipoComponente);
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
      return $this->failNotFound('Tipo de componente no encontrado con ID: ' . $id);
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
        return $this->respondDeleted(['id' => $id, 'message' => 'Tipo de componente eliminado']);
      } else {
        return $this->failNotFound('Tipo de componente no encontrado');
      }
    } catch (Exception $e) {
      return $this->failServerError($e->getMessage());
    }
  }
}
