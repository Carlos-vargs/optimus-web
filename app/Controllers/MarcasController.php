<?php

namespace App\Controllers;

use App\Models\Marca;
use CodeIgniter\RESTful\ResourceController;
use Exception;

class MarcasController extends ResourceController
{
  protected $modelName = 'App\Models\Marca';
  protected $format    = 'json';

  public function index()
  {
    $marcaModel = new Marca();
    $marcas = $marcaModel->findAll();
    return $this->respond($marcas);
  }

  public function show($id = null)
  {
    $marcaModel = new Marca();
    $marca = $marcaModel->find($id);
    if (!$marca) {
      return $this->failNotFound('Marca no encontrada con ID: ' . $id);
    }
    return $this->respond($marca);
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
      return $this->failNotFound('Marca no encontrada con ID: ' . $id);
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
        return $this->respondDeleted(['id' => $id, 'message' => 'Marca eliminada']);
      } else {
        return $this->failNotFound('Marca no encontrada');
      }
    } catch (Exception $e) {
      return $this->failServerError($e->getMessage());
    }
  }
}
