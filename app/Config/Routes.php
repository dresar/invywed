<?php namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes(true);

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */

$routes->setDefaultNamespace('App\Controllers\base');
$routes->setDefaultController('Beranda');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->setAutoRoute(false);

// 404 Override - Menampilkan error 404 jika route tidak ditemukan
$routes->set404Override(function() {
	throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Route tidak ditemukan');
});

/**
 * --------------------------------------------------------------------
 * Route Definitions - Halaman Depan & User Dashboard
 * --------------------------------------------------------------------
 */

//TUTORIAL
$routes->add('youtube', 'Beranda::youtube');
$routes->add('maps', 'Beranda::maps');
$routes->add('import_tamu', 'Beranda::import_tamu');

//TEMA
$routes->add('tema', 'Beranda::themes');
$routes->add('tema_video', 'Beranda::themes_video');
$routes->add('kirim_undangan', 'Beranda::kirim_undangan');
$routes->add('notifikasi', 'Beranda::notification');
$routes->add('callback_tripay', 'Beranda::callback_tripay');
$routes->add('kirim_pemberitahuan', 'Beranda::kirim_pemberitahuan');

//DEMO
$routes->add('demo/(:any)', 'Beranda::demo');

$routes->add('qrcode', 'Beranda::qrcode');
$routes->add('virtual', 'Beranda::virtual');

//ORDER
$routes->add('order', 'Order');
$routes->add('order/1', 'Order');
$routes->add('order/2', 'Order::mempelai');
$routes->add('order/3', 'Order::acara');
$routes->add('order/4', 'Order::cerita');
$routes->add('order/5', 'Order::gallery');
$routes->add('order/del', 'Order::del');
$routes->add('order/upload', 'Order::fileUpload');
$routes->add('order/imgupload', 'Order::imgupload');
$routes->add('order/save', 'Order::saveData');
$routes->add('order/finish', 'Order::finish');
$routes->add('order/success/(:any)', 'Order::success');
$routes->add('order/any', 'Order::any');
$routes->add('order/(:any)', 'Order');

//AUTH - Login untuk User
$routes->get('login', 'Auth::login');
$routes->post('do_auth', 'Auth::do_auth');
$routes->get('logout', 'Auth::logout');

//DASHBOARD USER
$routes->get('notification', 'Dashboard::showSweetAlertMessages');
$routes->get('user/dashboard', 'Dashboard::index');
$routes->get('user/riwayat', 'Dashboard::riwayat');
$routes->get('user/ucapan', 'Dashboard::ucapan');
$routes->get('user/tampilan', 'Dashboard::tampilan');
$routes->get('user/pengaturan', 'Dashboard::pengaturan');
$routes->get('user/mempelai', 'Dashboard::mempelai');
$routes->get('user/acara', 'Dashboard::acara');
$routes->get('user/album', 'Dashboard::gallery');
$routes->get('user/cerita', 'Dashboard::cerita');
$routes->get('user/rekening', 'Dashboard::rekening');
$routes->get('user/invoice', 'Dashboard::invoice');
$routes->get('user/profil', 'Dashboard::profil');
$routes->get('user/logout', 'Auth::logout');
$routes->get('user/testimoni', 'Dashboard::testimoni');
$routes->get('user/tamu', 'Dashboard::tamu');
$routes->get('user/setting_bukutamu', 'Dashboard::setting_bukutamu');
$routes->get('user/data_hadir', 'Dashboard::data_hadir');
$routes->get('user/autofill', 'Dashboard::autofill');

$routes->get('user/token', 'Dashboard::token');
$routes->post('user/finish', 'Dashboard::attemptOrder');
$routes->post('user/pembayaran_tripay', 'Dashboard::pembayaran_tripay');

$routes->add('user/save_tamu', 'Dashboard::do_save_tamu');
$routes->add('user/prosesExcel', 'Dashboard::prosesExcel');
$routes->post('user/hapus_riwayat', 'Dashboard::do_hapus_riwayat');
$routes->post('user/hapusbanyakriwayat', 'Dashboard::hapusbanyakriwayat');
$routes->post('user/hapus_komentar', 'Dashboard::do_hapus_komentar');
$routes->post('user/ganti_tema', 'Dashboard::do_ganti_tema');
$routes->post('user/update_fitur', 'Dashboard::do_update_fitur');
$routes->post('user/update_domain', 'Dashboard::do_update_domain');
$routes->post('user/update_posisi_mempelai', 'Dashboard::do_update_posisi_mempelai');
$routes->post('user/update_wa', 'Dashboard::do_update_token');
$routes->post('user/update_quote', 'Dashboard::do_update_quote');
$routes->post('user/update_foto_mempelai', 'Dashboard::do_update_foto_mempelai');
$routes->post('user/update_mempelai', 'Dashboard::do_update_mempelai');
$routes->post('user/update_acara', 'Dashboard::do_update_acara');
$routes->post('user/act_quote', 'Dashboard::do_act_quote');
$routes->post('user/set_countdown', 'Dashboard::do_set_countdown');
$routes->post('user/update_maps', 'Dashboard::do_update_maps');
$routes->post('user/update_gallery', 'Dashboard::do_update_gallery');
$routes->post('user/del_gallery', 'Dashboard::do_del_gallery');
$routes->post('user/del_slider_bukutamu', 'Dashboard::do_del_slider_bukutamu');
$routes->post('user/update_cerita', 'Dashboard::do_update_cerita');
$routes->post('user/update_rekening', 'Dashboard::do_update_rekening');
$routes->post('user/update_user', 'Dashboard::do_update_user');
$routes->post('user/update_musik', 'Dashboard::do_update_musik');
$routes->post('user/update_video', 'Dashboard::do_update_video');
$routes->post('user/konfirmasi', 'Dashboard::do_konfirmasi');
$routes->post('user/update_salam', 'Dashboard::do_update_salam');
$routes->post('user/update_testi', 'Dashboard::do_update_testi');
$routes->post('user/kirim_undangan', 'Dashboard::kirim_undangan');
$routes->post('user/hapus_tamu', 'Dashboard::do_hapus_tamu');
$routes->post('user/hapusbanyaktamu', 'Dashboard::hapusbanyaktamu');
$routes->post('user/update_tamu', 'Dashboard::do_update_tamu');
$routes->post('user/update_hadir', 'Dashboard::do_update_hadir');
$routes->add('user/kirim_undangan', 'Dashboard::kirim_undangan');
$routes->post('user/hapus_hadir', 'Dashboard::do_hapus_hadir');
$routes->post('user/refresh_invoice', 'Dashboard::refresh_invoice');
$routes->add('user/re_order', 'Dashboard::re_order');
$routes->post('user/update_paket', 'Dashboard::update_paket');
$routes->post('user/update_slider_bukutamu', 'Dashboard::do_update_slider_bukutamu');
$routes->post('user/update_background_bukutamu', 'Dashboard::do_update_background_bukutamu');

//Lupa Password
$routes->get('lupa_password', 'Lupa_password::index');
$routes->post('do_kirim', 'Lupa_password::do_kirim');
$routes->get('ganti_password/(:any)', 'Lupa_password::ganti_password');
$routes->post('update_password', 'Lupa_password::update_password');

// Catch-all route untuk halaman lainnya
$routes->add('(:any)', 'Beranda');

/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need to it be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
