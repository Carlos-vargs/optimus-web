<?php

namespace App\Controllers;

use App\Models\Equipo;
use CodeIgniter\RESTful\ResourceController;

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
}
