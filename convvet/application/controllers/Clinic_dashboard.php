<?php
// application/controllers/Clinic_dashboard.php
class Clinic_dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('user_id')) {
            redirect('auth/login');
        }
    }

    // Função para exibir o painel da clínica
    public function index() {
        $this->load->view('clinic/dashboard');
    }
}

?>