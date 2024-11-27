<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SACController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database(); // Carrega o banco de dados
        $this->load->helper(array('form', 'url')); // Carrega os helpers necessários
        $this->load->library(['form_validation', 'session']); // Biblioteca de validação e sessão
    }

    // Página de SAC (acessível apenas para clientes)
    public function index() {
        if ($this->session->userdata('role') !== 'client') {
            // Redireciona para uma página de erro ou outra página apropriada
            redirect('/client/dashboard/');
        } 

        $this->load->view('sac_view'); // Carrega a view
    }

    // Submissão de mensagens
    public function submit() {
        if ($this->session->userdata('role') !== 'client') {
            redirect('/client/dashboard/');
        }

        // Define as regras de validação
        $this->form_validation->set_rules('nome', 'Nome', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('assunto', 'Assunto', 'required');
        $this->form_validation->set_rules('mensagem', 'Mensagem', 'required|max_length[250]');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('sac_view');
        } else {
            $data = array(
                'nome' => $this->input->post('nome'),
                'email' => $this->input->post('email'),
                'assunto' => $this->input->post('assunto'),
                'mensagem' => $this->input->post('mensagem')
            );

            $this->db->insert('sac', $data);

            $this->session->set_flashdata('success', 'Sua mensagem foi enviada com sucesso!');
            redirect('SACController');
        }
    }

    // Página de listagem de mensagens (acessível apenas para clínicas)
    public function list() {
        if ($this->session->userdata('role') !== 'clinic') {
            redirect('/client/dashboard');
        } 

        $data['mensagens'] = $this->db->get('sac')->result();
        $this->load->view('sac_list', $data);
    }
}