<?php
// application/controllers/Admin_dashboard.php
class Admin_dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('user_id')) {
            redirect('auth/login');
        }
    }

    // Função para exibir o painel do admin
    public function index() {
        $this->load->view('admin/dashboard');
    }
}

?>