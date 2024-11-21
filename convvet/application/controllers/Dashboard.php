<?php
// application/controllers/Dashboard.php
class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();

        // Verifica se o usuário está logado
        if (!$this->session->userdata('logged_in')) {
            redirect('auth/login');
        }
    }

    public function index() {
        $role = $this->session->userdata('role');
        if ($role == 'admin') {
            redirect('admin_dashboard');
        } elseif ($role == 'client') {
            redirect('client_dashboard');
        } elseif ($role == 'clinic') {
            redirect('clinic_dashboard');
        }
    }
}
?>