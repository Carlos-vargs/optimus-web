<?php

namespace App\Controllers;

use App\Models\Componente;
use CodeIgniter\RESTful\ResourceController;
use Exception;

class ComponentesController extends ResourceController
{
  protected $modelName = 'App\Models\Componente';
  protected $format    = 'json';

  public function index()
  {
    $componenteModel = new Componente();
    $componentes = $componenteModel->findAll();
    return $this->respond($componentes);
  }

  public function show($id = null)
  {
    $componenteModel = new Componente();
    $componente = $componenteModel->find($id);
    if (!$componente) {
      return $this->failNotFound('Componente no encontrado con ID: ' . $id);
    }

    $componente['tipoComponente'] = $componenteModel->getTipoComponente($componente['idTipoComponente']);
    $componente['marca'] = $componenteModel->getMarca($componente['idMarca']);
    $componente['equipos'] = $componenteModel->getEquipos($id);
    return $this->respond($componente);
  }

  public function create()
  {
    $rules = [
      'idTipoComponente' => 'required|integer',
      'idMarca' => 'required|integer',
      'codigoInventario' => 'required|alpha_numeric_space|max_length[50]|is_unique[componentes.codigoInventario]',
      'fechaDeAdquisicion' => 'required|valid_date'
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
      'idTipoComponente' => 'required|integer',
      'idMarca' => 'required|integer',
      'codigoInventario' => "required|alpha_numeric_space|max_length[50]|is_unique[componentes.codigoInventario,id,{$id}]",
      'fechaDeAdquisicion' => 'required|valid_date'
    ];

    $json = $this->request->getJSON(true);

    if (!$this->model->find($id)) {
      return $this->failNotFound('Componente no encontrado con ID: ' . $id);
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
        return $this->respondDeleted(['id' => $id, 'message' => 'Componente eliminado']);
      } else {
        return $this->failNotFound('Componente no encontrado');
      }
    } catch (Exception $e) {
      return $this->failServerError($e->getMessage());
    }
  }
}
