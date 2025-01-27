<?php

use CodeIgniter\Router\RouteCollection;
use Kint\Zval\Value;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');


// $routes->get('/dashboard/dashboard_admin', 'Dashboard::admin', ['filter' => 'role:admin']);
// $routes->get('/dashboard/dashboard_kajur', 'Dashboard::kajur', ['filter' => 'role:kajur']);


// router admin 
$routes->get('/admin', 'AdminController::index', ['filter' => 'role:admin']);
$routes->get('akun', 'AdminController::akun', ['filter' => 'role:admin']);
$routes->get('rps', 'AdminController::rps', ['filter' => 'role:admin']);

$routes->get('tambah', 'AdminController::tambah', ['filter' => 'role:admin']);
$routes->post('tambah/adduser', 'AdminController::adduser', ['filter' => 'role:admin']);

// $routes->get('edit', 'Admin::edit');
$routes->get('edit/(:num)', 'AdminController::edit/$1', ['filter' => 'role:admin']);
$routes->post('edit/edituser/(:num)', 'AdminController::updateuser/$1', ['filter' => 'role:admin']);
$routes->post('deleteuser/(:num)', 'AdminController::deleteuser/$1', ['filter' => 'role:admin']);

$routes->get('tambahrp', 'AdminController::tambahrp', ['filter' => 'role:admin']);
$routes->post('tambahrp/addrp', 'AdminController::addrp', ['filter' => 'role:admin']);

// $routes->get('editrp', 'Admin::editrp');
$routes->get('editrp/(:num)', 'AdminController::editrp/$1', ['filter' => 'role:admin']);
$routes->post('editrp/updaterp/(:num)', 'AdminController::updaterp/$1', ['filter' => 'role:admin']);
$routes->post('editrp/deleterp/(:num)', 'AdminController::deleterp/$1', ['filter' => 'role:admin']);

$routes->get('profil', 'AdminController::profil', ['filter' => 'role:admin']);
$routes->get('notif', 'AdminController::notif', ['filter' => 'role:admin']);
// $routes->get('/dosen', 'dosen::index');
// $routes->get('/gpm', 'gpm::index');
// route admin selesai

// route dosen
$routes->get('/dosen', 'dosenController::dosen', ['filter' => 'role:dosen']);
$routes->get('dosen/unggah-rps', 'dosenController::unggah_rps', ['filter' => 'role:dosen']);
$routes->get('dosen/linkRPS', 'dosenController::link_rps', ['filter' => 'role:dosen']);
$routes->post('dosen/simpan_rps', 'UnggahRpsController::simpan_rps', ['filter' => 'role:dosen']);
$routes->get('dosen/daftar_upload', 'dosenController::daftar_upload', ['filter' => 'role:dosen']);
$routes->get('dosen/isi_bap', 'dosenController::bap', ['filter' => 'role:dosen']);
$routes->get('dosen/daftar_bap', 'dosenController::daftar_bap', ['filter' => 'role:dosen']);
$routes->get('dosen/feedback', 'dosenController::feedback', ['filter' => 'role:dosen']);
$routes->get('dosen/getMataKuliahByJurusan/(:num)', 'dosenController::getMataKuliahByJurusan/$1', ['filter' => 'role:dosen']);
$routes->delete('dosen/hapus_rps/(:num)', 'dosenController::hapus_rps/$1', ['filter' => 'role:dosen']);
$routes->get('dosen/get_rps/(:num)', 'dosenController::get_rps/$1', ['filter' => 'role:dosen']);
$routes->post('dosen/update_rps/(:num)', 'dosenController::update_rps/$1', ['filter' => 'role:dosen']);
$routes->post('dosen/simpan_bap', 'dosenController::simpan_bap', ['filter' => 'role:dosen']);
$routes->get('dosen/get-bap-details/(:num)', 'dosenController::getBapDetails/$1', ['filter' => 'role:dosen']);
$routes->post('/dosen/update-bap', 'dosenController::updateBap', ['filter' => 'role:dosen']);
$routes->get('/dosen/download-bap/(:num)', 'dosenController::downloadBap/$1', ['filter' => 'role:dosen']);
$routes->delete('/dosen/delete-bap/(:num)', 'dosenController::deleteBap/$1', ['filter' => 'role:dosen']);
$routes->get('dosen/profile', 'dosenController::profile_dosen', ['filter' => 'role:dosen']);
$routes->get('dosen/notifikasi_rps', 'dosenController::notifikasi_rps', ['filter' => 'role:dosen']);



// route gpm dan kajur

$routes->get('/kajur', 'GpmController::dashboard_kajur', ['filter' => 'role:gpm,kajur']);
$routes->get('/gpm', 'GpmController::dashboard_gpm', ['filter' => 'role:gpm,kajur']);
$routes->get('/dashboard/gpm_rps', 'GpmController::gpm_rps', ['filter' => 'role:gpm,kajur']);
$routes->get('gpm/download/(:num)', 'GpmController::download/$1', ['filter' => 'role:gpm,kajur']);
$routes->post('gpm/save-review', 'GpmController::saveReview', ['filter' => 'role:gpm,kajur']);
$routes->get('gpm/bap', 'GpmController::bap', ['filter' => 'role:gpm,kajur']);
$routes->get('gpm/bap/(:num)', 'GpmController::bap_detail/$1', ['filter' => 'role:gpm,kajur']);
$routes->get('gpm/get-bap-details/(:num)', 'GpmController::getBapDetails/$1', ['filter' => 'role:gpm,kajur']);
$routes->get('gpm/profile', 'GpmController::profile', ['filter' => 'role:gpm,kajur']);
$routes->get('gpm/notifikasi', 'GpmController::notifikasi', ['filter' => 'role:gpm,kajur']);
