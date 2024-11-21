<?php
class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');  // Carrega o helper de URL
        $this->load->library('session');
        $this->load->model('User_model');
    }

    public function register_client() {
        $this->load->view('client/register'); // Carrega o formulário de cadastro
    }

    public function do_register_client() {
        // Pega os dados do formulário
        $data = array(
            'name' => $this->input->post('name'),
            'email' => $this->input->post('email'),
            'password' => $this->input->post('password'),  // Senha sem hash
            'cpf' => $this->input->post('cpf'),
            'phone' => $this->input->post('phone'),
            'address' => $this->input->post('address'),
            'role' => 'client'  // Definindo o papel como 'client'
        );
    
        // Tenta inserir o usuário no banco de dados
        $result = $this->User_model->insert_user($data);
    
        if ($result) {
            // Se o cadastro for bem-sucedido, redireciona para a página de login
            $this->session->set_flashdata('success', 'Cadastro realizado com sucesso!');
            redirect('auth/login');
        } else {
            // Se falhar (provavelmente se o email já existir), exibe uma mensagem de erro
            $this->session->set_flashdata('error', 'Erro ao cadastrar. Tente novamente.');
            redirect('auth/register_client');
        }
    }
    
    
    public function login() {
        // Verifica se o usuário já está logado
        if ($this->session->userdata('logged_in')) {
            // Redireciona para o dashboard se já estiver logado
            redirect('client/dashboard');
        }
        $this->load->view('auth/login');
    }
    public function do_login() {
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        
        // Chama o método do modelo para autenticar o usuário
        $user = $this->User_model->authenticate($email, $password);  // Passando email e senha
        
        if ($user) {
            // Se a autenticação for bem-sucedida, armazene os dados na sessão
            $this->session->set_userdata('user_id', $user->id);
            $this->session->set_userdata('role', $user->role);
        
            // Redireciona para o dashboard do cliente ou outra página
            if ($user->role == 'client') {
                redirect('client_dashboard');
            } else {
                redirect('admin_dashboard');
            }
        } else {
            // Se as credenciais forem inválidas, exibe erro
            $this->session->set_flashdata('error', 'Credenciais inválidas');
            redirect('auth/login');
        }
    }
    
    // Função de logout
    public function logout() {
        $this->session->sess_destroy();
        redirect('auth/login');
    }
}
?>
