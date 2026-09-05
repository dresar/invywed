<?php namespace App\Controllers\base;

use CodeIgniter\Controller;
use App\Models\base\DashboardModel;

class Auth extends Controller
{
    protected $session;
    protected $DashboardModel;
    protected $request;
    
    public function __construct() {
        $this->session = \Config\Services::session();
        $this->DashboardModel = new DashboardModel();
        $this->request = \Config\Services::request();
    }

    public function login()
    {
        // Jika sudah login sebagai user, redirect ke dashboard
        if(session()->has('masukUser')) {
            return redirect()->to(base_url('user/dashboard'));
        }
        
        $data['title'] = 'Selamat Datang!';
        $data['view'] = 'base/dashboard/auth/login';
        return view('base/dashboard/auth/layout', $data);
    }

    public function do_auth()
    {
        $email = $this->request->getPost('email');
        $password = md5($this->request->getPost('password'));
        
        // Login sebagai user
        $data['email'] = $email;
        $data['password'] = $password;
        $hasil = $this->DashboardModel->get_user($data);
        $setting = $this->DashboardModel->get_setting();
        
        if(count($hasil) > 0) {
            $sess_data = array(
                'masukUser' => TRUE, 
                'uname' => $hasil[0]->username, 
                'id' => $hasil[0]->id, 
                'no_wa' => $setting[0]->no_wa,
                'role' => 'user'
            );
            $fitur = $this->DashboardModel->get_paket_by_login($hasil[0]->id);
            $sess_fitur = array(
                'kirim_hadiah' => $fitur[0]->kirim_hadiah, 
                'buku_tamu' => $fitur[0]->buku_tamu
            );
            $this->session->set($sess_data);
            $this->session->set($sess_fitur);
            
            log_message('info', "User login successful - ID: {$hasil[0]->id}, Email: $email");
            return redirect()->to(base_url('user/dashboard'));
        }
        
        // Login gagal
        $this->session->setFlashdata('errors', ['Email atau Password Salah']);
        log_message('warning', "Login failed - Email: $email");
        
        return redirect()->to(base_url('/login'));
    }

    public function logout()
    {
        $this->session->destroy();
        return redirect()->to(base_url('/login'));
    }
}

