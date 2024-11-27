<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// application/config/routes.php

// Rota padrão
$route['default_controller'] = 'home';

// -------------------- AUTH --------------------
$route['auth/login'] = 'auth/login';
$route['auth/do_login'] = 'auth/do_login';
$route['auth/logout'] = 'auth/logout';
$route['auth/register_client'] = 'auth/register_client';
$route['auth/register_clinic'] = 'auth/register_clinic';
$route['auth/do_register_client'] = 'auth/do_register_client';
$route['auth/do_register_clinic'] = 'auth/do_register_clinic';

// -------------------- ADMIN --------------------
$route['admin/dashboard'] = 'admin_dashboard/index';

// -------------------- CLIENT --------------------
$route['client/dashboard'] = 'client_dashboard/index';
$route['client/create_pet'] = 'client_dashboard/create_pet';
$route['client/dashboard/store_pet'] = 'client_dashboard/store_pet';
$route['client/dashboard/edit_pet/(:num)'] = 'client_dashboard/edit_pet/$1';
$route['client/dashboard/update_pet/(:num)'] = 'client_dashboard/update_pet/$1';
$route['client/dashboard/delete_pet/(:num)'] = 'client_dashboard/delete_pet/$1';
$route['client/profile'] = 'client_dashboard/profile';
$route['client/upload_foto'] = 'client_dashboard/upload_foto';
$route['client_dashboard/ver_pets'] = 'client_dashboard/ver_pets';
$route['client/pets'] = 'client_dashboard/ver_pets';  // Isso conecta a URL /client/pets ao método ver_pets


// -------------------- CLINIC --------------------
$route['clinic/dashboard'] = 'clinic_dashboard/index';
$route['clinic/profile'] = 'clinic_dashboard/profile';
$route['clinic/edit_profile'] = 'clinic_dashboard/edit_profile';
$route['clinic/update_profile'] = 'clinic_dashboard/update_profile';
$route['clinic_dashboard/upload_foto'] = 'clinic_dashboard/upload_foto';
$route['clinic/view_pets'] = 'clinic_dashboard/view_pets';
