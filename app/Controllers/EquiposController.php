<?php

namespace App\Controllers;

use App\Models\Equipo;
use CodeIgniter\RESTful\ResourceController;
use Exception;

class EquiposController extends ResourceController
{
    protected $modelName = 'App\Models\Equipo';
    protected $format    = 'json';

    public function index()
    {
        $equipoModel = new Equipo();
        $equipos = $equipoModel->findAll();

        // Agregar los componentes a cada equipo
        foreach ($equipos as $key => $equipo) {
            $equipos[$key]['componentes'] = $equipoModel->getComponentes($equipo['id']);
        }

        return $this->respond($equipos);
    }

    public function create()
    {
        $rules = [
            'idTipoEquipo' => 'required|integer',
            'idMarca' => 'required|integer',
            'idEstado' => 'required|integer',
            'fechaDeAdquisicion' => 'required|valid_date',
            'ultimoMantenimiento' => 'permit_empty|valid_date',
            'proximoMantenimiento' => 'permit_empty|valid_date',
            'codigoInventario' => 'required|alpha_numeric_space|max_length[50]|is_unique[equipos.codigoInventario]',
        ];

        $data = $this->request->getPost();

        if (!$this->validate($rules)) {
            return $this->fail($this->validator->getErrors());
        }

        try {
            $this->model->insert($data);
            $id = $this->model->getInsertID();
            return $this->respondCreated($this->model->find($id));
        } catch (Exception $e) {
            return $this->failServerError($e->getMessage());
        }
    }

    public function update($id = null)
    {
        $rules = [
            'idTipoEquipo' => 'required|integer',
            'idMarca' => 'required|integer',
            'idEstado' => 'required|integer',
            'fechaDeAdquisicion' => 'required|valid_date',
            'ultimoMantenimiento' => 'permit_empty|valid_date',
            'proximoMantenimiento' => 'permit_empty|valid_date',
            'codigoInventario' => 'required|alpha_numeric_space|max_length[50]|is_unique[equipos.codigoInventario,id,{id}]',
        ];

        $data = $this->request->getRawInput();

        if (!$this->model->find($id)) {
            return $this->failNotFound('Equipo no encontrado');
        }

        if (!$this->validate($rules)) {
            return $this->fail($this->validator->getErrors());
        }

        try {
            $this->model->update($id, $data);
            return $this->respond($this->model->find($id));
        } catch (Exception $e) {
            return $this->failServerError($e->getMessage());
        }
    }

    public function delete($id = null)
    {
        try {
            if ($this->model->delete($id)) {
                return $this->respondDeleted(['id' => $id, 'message' => 'Equipo eliminado']);
            } else {
                return $this->failNotFound('Equipo no encontrado');
            }
        } catch (Exception $e) {
            return $this->failServerError($e->getMessage());
        }
    }
}
