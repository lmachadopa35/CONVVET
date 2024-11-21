<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// application/config/routes.php
$route['default_controller'] = 'auth/login';
$route['auth/login'] = 'auth/login';
$route['auth/do_login'] = 'auth/do_login';
$route['auth/logout'] = 'auth/logout';
$route['admin/dashboard'] = 'admin_dashboard/index';
$route['client/dashboard'] = 'client_dashboard/index';
$route['clinic/dashboard'] = 'clinic_dashboard/index';
// application/config/routes.php
$route['auth/register_client'] = 'auth/register_client';
$route['auth/register_clinic'] = 'auth/register_clinic';
$route['auth/do_register_client'] = 'auth/do_register_client';
$route['auth/do_register_clinic'] = 'auth/do_register_clinic';
$route['client/dashboard'] = 'client_dashboard/index';  // Defina a URL para o painel do cliente
$route['client/create_pet'] = 'client_dashboard/create_pet';
$route['client/dashboard/store_pet'] = 'client_dashboard/store_pet';
$route['client/dashboard'] = 'Client_dashboard/index'; // Exibe todos os pets do cliente
$route['client/dashboard/create_pet'] = 'Client_dashboard/create_pet'; // Exibe o formulário de criação de pet
$route['client/dashboard/store_pet'] = 'Client_dashboard/store_pet'; // Salva um novo pet no banco
$route['client/dashboard/edit_pet/(:num)'] = 'Client_dashboard/edit_pet/$1'; // Exibe o formulário de edição de pet
$route['client/dashboard/update_pet/(:num)'] = 'Client_dashboard/update_pet/$1'; // Atualiza as informações do pet
$route['client/dashboard/delete_pet/(:num)'] = 'Client_dashboard/delete_pet/$1'; // Exclui um pet
