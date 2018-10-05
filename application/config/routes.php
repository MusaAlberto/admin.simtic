<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'user';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['simulasi/tambah'] = 'simulasi/tambah';
$route['user/profile/(:any)'] = 'user/profile/$1';