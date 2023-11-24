<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// ...

/*
 * Rutas para el controlador EquiposController
 */
$routes->group('equipos', function ($routes) {
  $routes->get('/', 'EquiposController::index'); // Lista todos los equipos
  $routes->post('create', 'EquiposController::create'); // Crea un nuevo equipo
  $routes->get('(:num)', 'EquiposController::show/$1'); // Muestra un equipo específico por id
  $routes->put('update/(:num)', 'EquiposController::update/$1'); // Actualiza un equipo específico por id
  $routes->delete('delete/(:num)', 'EquiposController::delete/$1'); // Elimina un equipo específico por id
});
