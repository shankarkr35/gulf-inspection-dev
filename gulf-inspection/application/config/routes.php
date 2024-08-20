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
|	https://codeigniter.com/userguide3/general/routing.html
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
$route['default_controller'] = 'Home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
/*Admin Section*/
$route['admin-login'] = 'admin/Adminlogin/index';
$route['admin-sign-signout'] = 'admin/Adminlogin/logout';
$route['admin-login-auth'] = 'admin/Adminlogin/admin_login_check';
$route['admin-dashboard'] = 'admin/admin/index';

/*Services in Admin*/
$route['admin-salon-services/(:any)'] = 'admin/admin/salonServiceList/$1';
$route['view-salon-services/(:any)'] = 'admin/admin/viewSalonServices/$1';

/*-- URL ------*/
$route['create-new-url'] = 'admin/admin/create_new_url';
$route['get-single-url'] = 'admin/admin/get_url';
$route['update-new-url'] = 'admin/admin/update_new_url';

/*Pages-------*/
$route['pages-list'] = 'admin/admin/pages';
$route['add-new-page'] = 'admin/admin/add_new_page';
$route['create-new-page'] = 'admin/admin/create_new_page';
$route['edit-page/(:any)'] = 'admin/admin/edit_page/$1';
$route['update-page'] = 'admin/admin/update_page';


/*Delete & Status*/
$route['delete-record-from'] = 'admin/admin/deleteFromany';
$route['status-management'] = 'admin/admin/status_mange';

/*Customers*/
$route['customers-list'] = 'admin/admin/customersList';
$route['add-new-user'] = 'admin/admin/add_new_user';
$route['create-new-user'] = 'admin/admin/create_new_user';
$route['edit-user/(:any)'] = 'admin/admin/edit_user/$1';
$route['update-user'] = 'admin/admin/update_user';

/*--- Client ---*/
$route['contact-person'] = 'admin/admin/clientList';
$route['add-new-contact-person'] = 'admin/admin/add_new_client';
$route['create-new-contact-person'] = 'admin/admin/create_new_client';
$route['edit-contact-person/(:any)'] = 'admin/admin/edit_client/$1';
$route['update-contact-person-record'] = 'admin/admin/update_client_record';

/*Categoreis*/
$route['governorate-list'] = 'admin/admin/governorates';
$route['add-new-governorate'] = 'admin/admin/addGovernorate';
$route['create-new-governorate'] = 'admin/admin/createGovernorate';
$route['edit-governorate/(:any)'] = 'admin/admin/editGovernorate/$1';
$route['update-governorate'] = 'admin/admin/updateGovernorate';

/*Sub Categories*/
$route['city-list'] = 'admin/admin/cities';
$route['add-new-city'] = 'admin/admin/addCities';
$route['create-new-city'] = 'admin/admin/createCities';
$route['edit-city/(:any)'] = 'admin/admin/editCities/$1';
$route['update-city'] = 'admin/admin/updateCities';

/*Departments*/
$route['departments'] = 'admin/admin/departments';
$route['add-new-departments'] = 'admin/admin/addDepartments';
$route['create-new-departments'] = 'admin/admin/createDepartments';
$route['edit-departments/(:any)'] = 'admin/admin/editDepartments/$1';
$route['update-departments'] = 'admin/admin/updateDepartments';

/*Company*/
$route['companies'] = 'admin/admin/companies';
$route['add-new-company'] = 'admin/admin/addCompany';
$route['create-new-company'] = 'admin/admin/createCompany';
$route['edit-company/(:any)'] = 'admin/admin/editCompany/$1';
$route['update-company'] = 'admin/admin/updateCompany';

/*Reports*/
$route['reports'] = 'admin/admin/reports';
$route['add-new-reports'] = 'admin/admin/addReport';
$route['create-new-reports'] = 'admin/admin/createReport';
$route['edit-reports/(:any)'] = 'admin/admin/editReport/$1';
$route['update-reports'] = 'admin/admin/updateReport';
$route['report-details/(:any)'] = 'admin/admin/viewReport/$1';
$route['report-history/(:any)'] = 'admin/admin/reportHistory/$1';
 
/*Users*/
$route['user-list'] = 'admin/admin/userList';
$route['add-new-user'] = 'admin/admin/add_new_user';
$route['create-new-user'] = 'admin/admin/create_new_user';
$route['edit-user/(:any)'] = 'admin/admin/edit_user/$1';
$route['update-user'] = 'admin/admin/update_user';

/*---- Client ----*/
$route['client-login'] = 'ClientLogin/index';
$route['client-sign-signout'] = 'ClientLogin/logout';
$route['client-login-auth'] = 'ClientLogin/client_login_check';
$route['client-dashboard'] = 'Home/index';

$route['update-client'] = 'Home/update_client';
$route['client-reports'] = 'Home/reports';
$route['view-report-details/(:any)'] = 'Home/viewReport/$1';
$route['client-report-history/(:any)'] = 'Home/reportHistory/$1';

$route['update-client-feedback'] = 'Home/update_client_feedback';

