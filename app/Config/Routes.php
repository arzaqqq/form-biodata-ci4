<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Biodata::index');


$routes->post('Biodata/simpan', 'Biodata::simpan');

$routes->get('biodata/edit/(:num)', 'Biodata::edit/$1');

$routes->get('biodata/hapusData/(:num)', 'Biodata::hapusData/$1');




//$routes->add('biodata/update/(:num)', 'Biodata::update/$1');