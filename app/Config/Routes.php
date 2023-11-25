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

/*
 * Rutas para el controlador EstadosController
 */
$routes->group('estados', function ($routes) {
  $routes->get('/', 'EstadosController::index'); // Lista todos los estados
  $routes->post('create', 'EstadosController::create'); // Crea un nuevo estado
  $routes->get('(:num)', 'EstadosController::show/$1'); // Muestra un estado específico por id
  $routes->put('update/(:num)', 'EstadosController::update/$1'); // Actualiza un estado específico por id
  $routes->delete('delete/(:num)', 'EstadosController::delete/$1'); // Elimina un estado específico por id
});

/*
 * Rutas para el controlador MarcasController
 */
$routes->group('marcas', function ($routes) {
  $routes->get('/', 'MarcasController::index'); // Lista todas las marcas
  $routes->post('create', 'MarcasController::create'); // Crea una nueva marca
  $routes->get('(:num)', 'MarcasController::show/$1'); // Muestra una marca específica por id
  $routes->put('update/(:num)', 'MarcasController::update/$1'); // Actualiza una marca específica por id
  $routes->delete('delete/(:num)', 'MarcasController::delete/$1'); // Elimina una marca específica por id
});

/*
 * Rutas para el controlador FallasController
 */
$routes->group('fallas', function ($routes) {
  $routes->get('/', 'FallasController::index'); // Lista todas las fallas
  $routes->post('create', 'FallasController::create'); // Crea una nueva falla
  $routes->get('(:num)', 'FallasController::show/$1'); // Muestra una falla específica por id
  $routes->put('update/(:num)', 'FallasController::update/$1'); // Actualiza una falla específica por id
  $routes->delete('delete/(:num)', 'FallasController::delete/$1'); // Elimina una falla específica por id
});

/*
 * Rutas para el controlador ComponentesController
 */
$routes->group('componentes', function ($routes) {
  $routes->get('/', 'ComponentesController::index'); // Lista todos los componentes
  $routes->post('create', 'ComponentesController::create'); // Crea un nuevo componente
  $routes->get('(:num)', 'ComponentesController::show/$1'); // Muestra un componente específico por id
  $routes->put('update/(:num)', 'ComponentesController::update/$1'); // Actualiza un componente específico por id
  $routes->delete('delete/(:num)', 'ComponentesController::delete/$1'); // Elimina un componente específico por id
});

/*
 * Rutas para el controlador TipoComponentesController
 */
$routes->group('tipo-componentes', function ($routes) {
  $routes->get('/', 'TipoComponentesController::index'); // Lista todos los tipos de componentes
  $routes->post('create', 'TipoComponentesController::create'); // Crea un nuevo tipo de componente
  $routes->get('(:num)', 'TipoComponentesController::show/$1'); // Muestra un tipo de componente específico por id
  $routes->put('update/(:num)', 'TipoComponentesController::update/$1'); // Actualiza un tipo de componente específico por id
  $routes->delete('delete/(:num)', 'TipoComponentesController::delete/$1'); // Elimina un tipo de componente específico por id
});

/*
 * Rutas para el controlador TipoEquiposController
 */
$routes->group('tipo-equipos', function ($routes) {
  $routes->get('/', 'TipoEquiposController::index'); // Lista todos los tipos de equipos
  $routes->post('create', 'TipoEquiposController::create'); // Crea un nuevo tipo de equipo
  $routes->get('(:num)', 'TipoEquiposController::show/$1'); // Muestra un tipo de equipo específico por id
  $routes->put('update/(:num)', 'TipoEquiposController::update/$1'); // Actualiza un tipo de equipo específico por id
  $routes->delete('delete/(:num)', 'TipoEquiposController::delete/$1'); // Elimina un tipo de equipo específico por id
});

/*
 * Rutas para el controlador TipoMantenimientosController
 */
$routes->group('tipo-mantenimientos', function ($routes) {
  $routes->get('/', 'TipoMantenimientosController::index'); // Lista todos los tipos de mantenimientos
  $routes->post('create', 'TipoMantenimientosController::create'); // Crea un nuevo tipo de mantenimiento
  $routes->get('(:num)', 'TipoMantenimientosController::show/$1'); // Muestra un tipo de mantenimiento específico por id
  $routes->put('update/(:num)', 'TipoMantenimientosController::update/$1'); // Actualiza un tipo de mantenimiento específico por id
  $routes->delete('delete/(:num)', 'TipoMantenimientosController::delete/$1'); // Elimina un tipo de mantenimiento específico por id
});

/*
 * Rutas para el controlador MantenimientosController
 */
$routes->group('mantenimientos', function ($routes) {
  $routes->get('/', 'MantenimientosController::index'); // Lista todos los mantenimientos
  $routes->post('create', 'MantenimientosController::create'); // Crea un nuevo mantenimiento
  $routes->get('(:num)', 'MantenimientosController::show/$1'); // Muestra un mantenimiento específico por id
  $routes->put('update/(:num)', 'MantenimientosController::update/$1'); // Actualiza un mantenimiento específico por id
  $routes->delete('delete/(:num)', 'MantenimientosController::delete/$1'); // Elimina un mantenimiento específico por id
});
