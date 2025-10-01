<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('AuthPeserta');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override(function () {
    throw new \CodeIgniter\Exceptions\PageNotFoundException();
});
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/auth', 'Auth\AuthPeserta::index');

$routes->get('/auth/staf', 'Auth\AuthStaf::index');
$routes->get('/auth/administrator', 'Auth\AuthAdministrator::index');

$routes->post('/auth/staf/login', 'Auth\AuthStaf::login');
$routes->post('/auth/login', 'Auth\AuthPeserta::login');
$routes->post('/auth/administrator/login', 'Auth\AuthAdministrator::login');




/*
 * --------------------------------------------------------------------
 * Route Tambahan
 * --------------------------------------------------------------------
 */

/* 
 * ++++++++++++++++++++++++ Route Peserta ++++++++++++++++++++++++
 */
$routes->get('/peserta', 'Peserta\Dashboard::index');
$routes->get('/peserta/logout', 'Peserta\Dashboard::logout');

$routes->get('/peserta/waktu-habis', 'Peserta\Soal::waktuhabis');
$routes->get('/peserta/selesai-ujian', 'Peserta\Soal::selesaiujian');
$routes->get('/peserta/soal/(:num)', 'Peserta\Soal::index/$1');
$routes->get('/peserta/selesai', 'Peserta\Selesai::index');
$routes->get('/peserta/selesai/(:segment)', 'Peserta\Selesai::index/$1');

$routes->get('/skor', 'Peserta\Skor::index');
$routes->get('/skor/load-data', 'Peserta\Skor::load');


/* 
 * ++++++++++++++++++++++++ Route Staf ++++++++++++++++++++++++
 */
$routes->get('/staf', 'Staf\Dashboard::index');
$routes->get('/staf/logout', 'Staf\Dashboard::logout');

$routes->get('/staf/ruangan-sesi', 'Staf\RuanganSesi::index');
$routes->get('/staf/ruangan-sesi/detail-ruangan-sesi/(:segment)', 'Staf\RuanganSesi::detailruangansesi/$1');
$routes->get('/staf/ruangan-sesi/berita-acara/(:segment)', 'Staf\RuanganSesi::beritaacara/$1');
$routes->get('/staf/keamanan', 'Staf\Keamanan::index');

$routes->post('/staf/keamanan/update', 'Staf\Keamanan::update');
$routes->post('/staf/ruangan-sesi/insert', 'Staf\RuanganSesi::insert');
$routes->post('/staf/ruangan-sesi/update', 'Staf\RuanganSesi::update');
$routes->post('/staf/ruangan-sesi/read', 'Staf\RuanganSesi::read');
$routes->post('/staf/ruangan-sesi/access', 'Staf\RuanganSesi::access');

/* 
 * ++++++++++++++++++++++++ Route Administrator ++++++++++++++++++++++++
 */


/* Administrator */
$routes->get('/administrator', 'Administrator\Dashboard::index');
$routes->get('/administrator/logout', 'Administrator\Dashboard::logout');

$routes->get('/administrator/administrator', 'Administrator\Administrator::index');
$routes->get('/administrator/administrator/form-administrator', 'Administrator\Administrator::formadministrator');
$routes->get('/administrator/administrator/form-administrator/(:segment)', 'Administrator\Administrator::formadministrator/$1');
$routes->get('/administrator/administrator/form-keamanan/(:segment)', 'Administrator\Administrator::formkeamanan/$1');

$routes->post('/administrator/administrator/insert', 'Administrator\Administrator::insert');
$routes->post('/administrator/administrator/update', 'Administrator\Administrator::update');
$routes->post('/administrator/administrator/delete', 'Administrator\Administrator::delete');
$routes->post('/administrator/administrator/access', 'Administrator\Administrator::access');

/* Pengawas */
$routes->get('/administrator/pengawas', 'Administrator\Pengawas::index');
$routes->get('/administrator/pengawas/form-pengawas', 'Administrator\Pengawas::formpengawas');
$routes->get('/administrator/pengawas/form-pengawas/(:segment)', 'Administrator\Pengawas::formpengawas/$1');
$routes->get('/administrator/pengawas/form-keamanan/(:segment)', 'Administrator\Pengawas::formkeamanan/$1');

$routes->post('/administrator/pengawas/insert', 'Administrator\Pengawas::insert');
$routes->post('/administrator/pengawas/update', 'Administrator\Pengawas::update');
$routes->post('/administrator/pengawas/delete', 'Administrator\Pengawas::delete');
$routes->post('/administrator/pengawas/access', 'Administrator\Pengawas::access');

/* Teknisi */
$routes->get('/administrator/teknisi', 'Administrator\Teknisi::index');
$routes->get('/administrator/teknisi/form-teknisi', 'Administrator\Teknisi::formteknisi');
$routes->get('/administrator/teknisi/form-teknisi/(:segment)', 'Administrator\Teknisi::formteknisi/$1');

$routes->post('/administrator/teknisi/insert', 'Administrator\Teknisi::insert');
$routes->post('/administrator/teknisi/update', 'Administrator\Teknisi::update');
$routes->post('/administrator/teknisi/delete', 'Administrator\Teknisi::delete');

/* Ruangan 
$routes->get('/administrator/ruangan', 'Administrator\Ruangan::index');
$routes->get('/administrator/ruangan/(:segment)', 'Administrator\Ruangan::index/$1');

$routes->post('/administrator/ruangan/insert', 'Administrator\Ruangan::insert');
$routes->post('/administrator/ruangan/update', 'Administrator\Ruangan::update');
$routes->post('/administrator/ruangan/delete', 'Administrator\Ruangan::delete');
*/

/* Komponen */
$routes->get('/administrator/komponen/umum', 'Administrator\Komponen::index');
$routes->post('/administrator/komponen/umum/update', 'Administrator\Komponen::update');

$routes->get('/administrator/komponen/lainnya', 'Administrator\Komponen::lainnya');
$routes->get('/administrator/komponen/lainnya/(:segment)', 'Administrator\Komponen::lainnya/$1');

$routes->post('/administrator/komponen/lainnya/insert', 'Administrator\Komponen::insert');
$routes->post('/administrator/komponen/lainnya/update', 'Administrator\Komponen::update');
$routes->post('/administrator/komponen/lainnya/delete', 'Administrator\Komponen::delete');

$routes->get('/administrator/komponen/soal', 'Administrator\Komponen::soal');
$routes->get('/administrator/komponen/soal/(:segment)', 'Administrator\Komponen::soal/$1');

$routes->post('/administrator/komponen/soal/insert', 'Administrator\Komponen::insert');
$routes->post('/administrator/komponen/soal/update', 'Administrator\Komponen::update');
$routes->post('/administrator/komponen/soal/delete', 'Administrator\Komponen::delete');

/* Sesi */
$routes->get('/administrator/sesi', 'Administrator\Sesi::index');
$routes->get('/administrator/sesi/(:segment)', 'Administrator\Sesi::index/$1');

$routes->post('/administrator/sesi/insert', 'Administrator\Sesi::insert');
$routes->post('/administrator/sesi/update', 'Administrator\Sesi::update');
$routes->post('/administrator/sesi/delete', 'Administrator\Sesi::delete');

/* Jadwal */
$routes->get('/administrator/jadwal', 'Administrator\Jadwal::index');
$routes->get('/administrator/jadwal/(:segment)', 'Administrator\Jadwal::index/$1');

$routes->post('/administrator/jadwal/insert', 'Administrator\Jadwal::insert');
$routes->post('/administrator/jadwal/update', 'Administrator\Jadwal::update');
$routes->post('/administrator/jadwal/delete', 'Administrator\Jadwal::delete');

/* Ruang Sesi */
$routes->get('/administrator/ruangan-sesi', 'Administrator\RuanganSesi::index');
$routes->get('/administrator/ruangan-sesi/form-ruangan-sesi', 'Administrator\RuanganSesi::formruangansesi');
$routes->get('/administrator/ruangan-sesi/form-ruangan-sesi/(:segment)', 'Administrator\RuanganSesi::formruangansesi/$1');
$routes->get('/administrator/ruangan-sesi/detail-ruangan-sesi/(:segment)', 'Administrator\RuanganSesi::detailruangansesi/$1');
$routes->get('/administrator/ruangan-sesi/detail-peserta/(:segment)', 'Administrator\RuanganSesi::detailpeserta/$1');

$routes->post('/administrator/ruangan-sesi/insert', 'Administrator\RuanganSesi::insert');
$routes->post('/administrator/ruangan-sesi/update', 'Administrator\RuanganSesi::update');
$routes->post('/administrator/ruangan-sesi/delete', 'Administrator\RuanganSesi::delete');
$routes->post('/administrator/ruangan-sesi/status', 'Administrator\RuanganSesi::status');
$routes->post('/administrator/ruangan-sesi/kick', 'Administrator\RuanganSesi::kick');
$routes->post('/administrator/ruangan-sesi/reset', 'Administrator\RuanganSesi::reset');
$routes->post('/administrator/ruangan-sesi/restore', 'Administrator\RuanganSesi::restore');
$routes->post('/administrator/ruangan-sesi/lock', 'Administrator\RuanganSesi::lock');
$routes->post('/administrator/ruangan-sesi/unlock', 'Administrator\RuanganSesi::unlock');

/* Soal */
$routes->get('/administrator/soal', 'Administrator\Soal::index');
$routes->get('/administrator/soal/form-soal', 'Administrator\Soal::formsoal');
$routes->get('/administrator/soal/form-soal/(:segment)', 'Administrator\Soal::formsoal/$1');
$routes->get('/administrator/soal/detail-soal/(:segment)', 'Administrator\Soal::detailsoal/$1');

$routes->post('/administrator/soal/insert', 'Administrator\Soal::insert');
$routes->post('/administrator/soal/update', 'Administrator\Soal::update');
$routes->post('/administrator/soal/delete', 'Administrator\Soal::delete');
$routes->post('/administrator/soal/set-question', 'Administrator\Soal::setquestion');

/* Peserta */
$routes->get('/administrator/peserta', 'Administrator\Peserta::index');

$routes->get('/administrator/peserta/form-peserta', 'Administrator\Peserta::formpeserta');
$routes->get('/administrator/peserta/form-peserta/(:segment)', 'Administrator\Peserta::formpeserta/$1');
$routes->get('/administrator/peserta/import-ulang', 'Administrator\Peserta::importulang');

$routes->post('/administrator/peserta/insert', 'Administrator\Peserta::insert');
$routes->post('/administrator/peserta/update', 'Administrator\Peserta::update');
$routes->post('/administrator/peserta/delete', 'Administrator\Peserta::delete');

/* Rekapan */
$routes->get('/administrator/rekapan-peserta', 'Administrator\Rekapan::index');
$routes->get('/administrator/rekapan-peserta/(:segment)', 'Administrator\Rekapan::index/$1');
$routes->get('/administrator/rekapan-peserta/(:segment)/(:segment)', 'Administrator\Rekapan::index/$1/$2');

$routes->get('/administrator/export-excel', 'Administrator\Rekapan::exportexcel');
$routes->get('/administrator/export-excel/(:segment)', 'Administrator\Rekapan::exportexcel/$1');
$routes->get('/administrator/export-excel/(:segment)/(:segment)', 'Administrator\Rekapan::exportexcel/$1/$2');

$routes->post('/administrator/rekapan-peserta/filter', 'Administrator\Rekapan::filter');


$routes->get('/rekapan-peserta', 'Administrator\Rekapan::index');
$routes->get('/rekapan-peserta/(:segment)', 'Administrator\Rekapan::index/$1');
$routes->get('/rekapan-peserta/(:segment)/(:segment)', 'Administrator\Rekapan::index/$1/$2');
$routes->post('/rekapan-peserta/filter', 'Administrator\Rekapan::filter');
/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */

if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
