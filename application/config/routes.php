<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'homepage';
$route['login']              = 'homepage/login';
$route['logout']             = 'homepage/logout';
$route['setting']            = 'homepage/setting';
$route['count_down']         = 'homepage/count_down';
$route['calendar']           = 'homepage/calendar';
$route['no-allow']           = 'error_page/no_allow';

$route['custom/(:any)'] = 'homepage/custom/$1';

//$route['admin'] = 'admin/users/index';

$route['admin']              = 'admin/admin_page';
$route['admin/(:any)']       = 'admin/admin_page/$1';
$route['blog']               = 'blog/blog_controller/index';
$route['blog/create']        = 'blog/blog_controller/input';
$route['blog/(:any)']        = 'blog/blog_controller/$1';
$route['blog/(:any)/(:any)'] = 'blog/blog_controller/$1/$2';

$route['404_override']         = 'homepage/error404';
$route['translate_uri_dashes'] = false;

$route['ajax_up_files']         = 'admin/files_controller/ajax_up_files';
$route['ajax_up_files/background']         = 'admin/files_controller/ajax_up_files/background';

