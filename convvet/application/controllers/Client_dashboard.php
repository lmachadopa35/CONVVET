<?php
class Client_dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');  // Carregar a biblioteca de validação
        $this->load->model('Pet_model');           // Carregar o modelo Pet_model
        $this->load->helper('url');                // Carregar o helper de URL para usar a função redirect
    }

    public function index() {
        // Pega o ID do usuário logado
        $user_id = $this->session->userdata('user_id');

        // Verifica se o usuário está logado
        if (!$user_id) {
            redirect('auth/login'); // Redireciona se o usuário não estiver logado
        }

        // Pega os pets do usuário logado
        $data['pets'] = $this->Pet_model->get_pets_by_user($user_id);

        // Carrega a visão com os dados dos pets
        $this->load->view('client/dashboard', $data);
    }
    public function create_pet() {
        $this->load->view('client/create_pet');
    }
    
    // public function create_pet() {
    //     if ($this->input->post()) {
    //         $data = [
    //             'type' => $this->input->post('type'),
    //             'name' => $this->input->post('name'),
    //             'breed' => $this->input->post('breed'),
    //             'age' => $this->input->post('age'),
    //             'user_id' => $this->session->userdata('user_id'), // ID do cliente logado
    //         ];

    //         if ($this->Pet_model->insert_pet($data)) {
    //             $this->session->set_flashdata('success', 'Pet cadastrado com sucesso!');
    //         } else {
    //             $this->session->set_flashdata('error', 'Erro ao cadastrar o pet.');
    //         }

    //         redirect('client/dashboard/create_pet');
    //     } else {
    //         $this->load->view('client/create_pet');
    //     }
    // }

    public function store_pet() {
        // Definir regras de validação para o formulário
        $this->form_validation->set_rules('type', 'Tipo de Animal', 'required');
        $this->form_validation->set_rules('name', 'Nome do Pet', 'required');
        $this->form_validation->set_rules('breed', 'Raça', 'required');
        $this->form_validation->set_rules('age', 'Idade', 'required|numeric');

        // Verificar se a validação foi bem-sucedida
        if ($this->form_validation->run() == FALSE) {
            // Se a validação falhar, recarregar a página de criação do pet com erros
            $this->load->view('client/create_pet');
        } else {
            // Se a validação passar, coleta os dados do formulário
            $pet_data = array(
                'type' => $this->input->post('type'),
                'name' => $this->input->post('name'),
                'breed' => $this->input->post('breed'),
                'age' => $this->input->post('age'),
                'user_id' => $this->session->userdata('user_id') // Associar o pet ao usuário logado
            );

            // Salvar o pet no banco de dados
            $this->Pet_model->insert_pet($pet_data);

            // Definir mensagem de sucesso
            $this->session->set_flashdata('success', 'Pet cadastrado com sucesso!');
            
            // Redirecionar de volta para o dashboard do cliente
            redirect('client/dashboard');
        }
    }
  // Método para editar um pet
  public function edit_pet($pet_id) {
    $pet = $this->Pet_model->get_pet_by_id($pet_id);

    if (!$pet) {
        show_404();
    }

    $data['pet'] = $pet;
    $this->load->view('client/edit_pet', $data);
}

// Método para atualizar os dados de um pet
public function update_pet($pet_id) {
    $this->form_validation->set_rules('type', 'Tipo de Animal', 'required');
    $this->form_validation->set_rules('name', 'Nome', 'required');
    $this->form_validation->set_rules('breed', 'Raça', 'required');
    $this->form_validation->set_rules('age', 'Idade', 'required|numeric');

    if ($this->form_validation->run() == FALSE) {
        $this->edit_pet($pet_id);
    } else {
        $data = [
            'type' => $this->input->post('type'),
            'name' => $this->input->post('name'),
            'breed' => $this->input->post('breed'),
            'age' => $this->input->post('age')
        ];
        $this->Pet_model->update_pet($pet_id, $data);
        $this->session->set_flashdata('success', 'Pet atualizado com sucesso!');
        redirect('client/dashboard');
    }
}

// Método para deletar um pet
public function delete_pet($pet_id) {
    $this->Pet_model->delete_pet($pet_id);
    $this->session->set_flashdata('success', 'Pet deletado com sucesso!');
    redirect('client/dashboard');
}
    
}
