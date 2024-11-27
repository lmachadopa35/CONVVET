<?php
class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('User_model');
    }

    // Cadastro de cliente
    public function register_client() {
        $this->load->view('client/register'); // Carrega o formulário de cadastro
    }

    // Ação de cadastro do cliente
    public function do_register_client() {
        $data = array(
            'name' => $this->input->post('name'),
            'email' => $this->input->post('email'),
            'password' => $this->input->post('password'),  // Senha sem hash
            'cpf' => $this->input->post('cpf'),   // Campo CPF
            'phone' => $this->input->post('phone'),
            'address' => $this->input->post('address'),
            'plan' => $this->input->post('plan'),  // Captura o plano selecionado
            'role' => 'client'  // Definindo o papel como 'client'
        );
    
        // Tenta inserir o usuário no banco de dados
        $result = $this->User_model->insert_user($data);
    
        if ($result) {
            $this->session->set_flashdata('success', 'Cadastro realizado com sucesso!');
            redirect('auth/login');
        } else {
            $this->session->set_flashdata('error', 'Erro ao cadastrar. Tente novamente.');
            redirect('auth/register_client');
        }
    }

    // Cadastro de clínica
    public function register_clinic() {
        $this->load->view('clinic/register'); // Formulário de cadastro para clínicas
    }

    // Ação de cadastro da clínica
    public function do_register_clinic() {
        $data = array(
            'name' => $this->input->post('name'),
            'email' => $this->input->post('email'),
            'password' => $this->input->post('password'),
            'cnpj' => $this->input->post('cnpj'),  // Campo CNPJ
            'phone' => $this->input->post('phone'),
            'address' => $this->input->post('address'),
            'role' => 'clinic'  // Definindo o papel como 'clinic'
        );

        $result = $this->User_model->insert_user($data);

        if ($result) {
            $this->session->set_flashdata('success', 'Cadastro realizado com sucesso!');
            redirect('auth/login');
        } else {
            $this->session->set_flashdata('error', 'Erro ao cadastrar. Tente novamente.');
            redirect('auth/register_clinic');
        }
    }

    // Login
    public function login() {
        if ($this->session->userdata('logged_in')) {
            
            redirect('client/dashboard');
        }
        $this->load->view('auth/login');
    }

    // Processar login
    public function do_login() {
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $role = $this->input->post('role');  // Captura o role escolhido
        log_message('debug', "Email: $email, Role: $role");
        $user = $this->User_model->authenticate($email, $password, $role);  // Passando email, senha e role
        if ($user) {
            $this->session->set_userdata('user_id', $user->id);
            $this->session->set_userdata('role', $user->role);
        
            // Redireciona para o dashboard dependendo do papel
            if ($user->role == 'client') {
                redirect('client_dashboard');
            } elseif ($user->role == 'clinic') {
                redirect('clinic_dashboard');
            } else {
                redirect('admin_dashboard');
            }
        } else {
            $this->session->set_flashdata('error', 'Credenciais inválidas');
            redirect('auth/login');
        }
    }
    

    // Logout
    public function logout() {
        $this->session->sess_destroy();
        redirect('auth/login');
    }
}
?>
