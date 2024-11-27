<?php
class Client_dashboard extends CI_Controller {

public function __construct() {
    parent::__construct();
    $this->load->model('User_model');
    $this->load->model('Pet_model');
    $this->load->model('Appointment_model');
    $this->load->model('Emergency_model');
    $this->load->library('form_validation');
    $this->load->library('upload');
    $this->load->library('session');
    $this->load->helper('url');
    
    
    // Check session once during class initialization
    $this->verifySession();
}

private function verifySession() {
// Verifica se a sessão foi carregada e recupera o user_id
if ($this->session->userdata('user_id')) {
    $user_id = $this->session->userdata('user_id');
} else {
    // Se não houver 'user_id' na sessão, redireciona para o login
    redirect('auth/login');
}

}


public function create_appointment() {
    // Verificar se o usuário está logado
    $this->verifySession();
    
    // Obter o ID do usuário logado
    $user_id = $this->session->userdata('user_id');

    // Buscar os pets do usuário
    $pets = $this->Pet_model->get_pets_by_user($user_id);

    // Buscar as clínicas
    $clinics = $this->User_model->get_clinics();

    // Passar os dados para a view
    $data = [
        'pets' => $pets,
        'clinics' => $clinics
    ];

    $this->load->view('client/create_appointment', $data);
}


public function submit_appointment() {
    // Verificar se o usuário está logado
    $this->verifySession();
    
    // Recupera o ID do usuário a partir da sessão
    $user_id = $this->session->userdata('user_id');
    
    // Coleta os dados do formulário
    $clinic_id = $this->input->post('clinic_id');
    $pet_id = $this->input->post('pet_id');
    $description = $this->input->post('description');

    // Dados do novo agendamento
    $data = [
        'user_id' => $user_id,
        'clinic_id' => $clinic_id,
        'pet_id' => $pet_id,
        'description' => $description,
        'status' => 'pendente'  // Status inicial
    ];

    // Chama o modelo para inserir o agendamento
    if ($this->Appointment_model->insert_appointment($data)) {
        // Redireciona para a lista de agendamentos
        $this->session->set_flashdata('success', 'Agendamento realizado com sucesso!');
        redirect('client_dashboard/appointments');
    } else {
        // Em caso de erro
        $this->session->set_flashdata('error', 'Erro ao realizar agendamento. Tente novamente.');
        redirect('client_dashboard/create_appointment');
    }
}

public function create_emergency() {
    // Carregar o modelo necessário
    $this->load->model('User_model');
    $this->load->model('Pet_model');
    
    // Obter as clínicas (usuarios com role 'clinic')
    $data['clinics'] = $this->User_model->get_clinics();
    $data['pets'] = $this->Pet_model->get_pets_by_user($this->session->userdata('user_id')); // Supondo que o ID do usuário seja armazenado na sessão

    // Exibir a página
    $this->load->view('client/create_emergency', $data);
    
}

public function submit_emergency() {
    // Carregar a biblioteca de validação de formulários
    $this->load->library('form_validation');
    $this->load->model('Emergency_model'); // Carregar o modelo Emergency_model

    // Definir as regras de validação
    $this->form_validation->set_rules('clinic_id', 'Clínica', 'required');
    $this->form_validation->set_rules('pet_id', 'Pet', 'required');
    $this->form_validation->set_rules('description', 'Descrição', 'required');

    // Verificar se o formulário foi enviado e validado corretamente
    if ($this->form_validation->run() === FALSE) {
        // Caso falhe na validação, redireciona de volta ao formulário
        $this->create_emergency();
        
    } else {
        // Se a validação for bem-sucedida, processar os dados
        $emergency_data = array(
            'clinic_id' => $this->input->post('clinic_id'),
            'pet_id' => $this->input->post('pet_id'),
            'description' => $this->input->post('description')
        );

        // Inserir os dados na tabela de emergências
        $this->Emergency_model->insert_emergency($emergency_data);

        // Redirecionar após o sucesso
        $this->session->set_flashdata('success', 'Emergência registrada com sucesso!');
        redirect('client_dashboard');
    }
}



    public function LoadAll(){
        $user_id = $this->session->userdata('user_id');
        
        // Verificar se o usuário está logado
        if (!$user_id) {
            redirect('auth/login'); // Redirecionar para o login se o usuário não estiver logado
        }
    }

    public function index() {
        $user_id = $this->session->userdata('user_id');
        $user = $this->User_model->get_user_by_id($user_id);
        // Verifica se o usuário está logado
        if ($user && $user->role !== 'client') {
            redirect('auth/logout'); // Redireciona se o usuário não estiver logado
        }
        // Pega os pets do usuário logado
        $data['pets'] = $this->Pet_model->get_pets_by_user($user_id);

        // Carrega a visão com os dados dos pets
        $this->load->view('client/dashboard', $data);
    }
    public function pets() {
        $this->load->model('Pet_model');
        $data['pets'] = $this->Pet_model->get_pets_by_user($user_id);  // Supondo que você tenha o método get_pets_by_user

        $this->load->view('client/pets', $data);
    }

    public function ver_pets() {
        $user_id = $this->session->userdata('user_id');
        
        // Verificar se o usuário está logado
        if (!$user_id) {
            redirect('auth/login'); // Redirecionar para o login se o usuário não estiver logado
        }
    
        // Pega os pets do cliente logado
        $data['pets'] = $this->Pet_model->get_pets_by_user($user_id);
        
        // Verifica se o método get_pets_by_user retornou dados
        if (empty($data['pets'])) {
            $data['message'] = 'Você não tem nenhum pet cadastrado.';
        }
    
        // Depuração: Verifique o conteúdo de $data['pets']
        // Isso ajudará a identificar se a propriedade 'nome' está presente em cada pet

    
        $this->load->view('client/pets', $data); // Passando para a view
    }
        
    

    public function create_pet() {
        $this->load->view('client/create_pet');
        $this->verifySession();

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
            redirect('client_dashboard/');
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

public function list_clinics() {
    // Exemplo de consulta para buscar todos os usuários com a role 'clinic'
    $this->db->select('*');
    $this->db->from('users');
    $this->db->where('role', 'clinic');
    $query = $this->db->get();
    $clinics = $query->result(); // Isso retorna um array de objetos (clinicas)

    // Passar os dados das clínicas para a visualização
    $data['clinics'] = $clinics;

    // Carregar a visualização e passar os dados
    $this->load->view('client/clinics_list', $data);
}


public function profile() {
    $user_id = $this->session->userdata('user_id'); // Obtém o ID do usuário da sessão

    if (!$user_id) {
        redirect('auth/login'); // Redireciona para o login se não autenticado
    }

    // Busca as informações do cliente no banco de dados
    $user = $this->User_model->get_user_by_id($user_id);

    if ($user && $user->role === 'client') {
        $data['user'] = $user;
        $this->load->view('client/profile', $data); // Carrega a view do perfil do cliente
    } else {
        redirect('client_dashboard'); // Redireciona se não for cliente
    }
}

public function edit_profile() {
    // Verificar se o usuário está logado
    $this->verifySession();

    $user_id = $this->session->userdata('user_id');
    $user = $this->User_model->get_user_by_id($user_id);

    if ($user && $user->role === 'client') {
        $data['user'] = $user;
        $this->load->view('client/edit_profile', $data); // Carrega a view 'client/edit_profile'
    } else {
        redirect('client_dashboard');
    }
}
public function update_profile() {
    // Verificar se o usuário está logado
    if (!$this->session->userdata('user_id')) {
        redirect('login');
    }

    // Receber os dados do formulário
    $data = array(
        'name' => $this->input->post('name'),
        'email' => $this->input->post('email'),
        'phone' => $this->input->post('phone'),
        'address' => $this->input->post('address')
    );

    // Verificar se os campos obrigatórios estão preenchidos
    if (empty($data['name']) || empty($data['email'])) {
        // Definir a mensagem de erro se algum campo obrigatório estiver vazio
        $this->session->set_flashdata('error', 'Os campos Nome e E-mail são obrigatórios.');
        redirect('client/update_profile');  // Redirecionar para a página de atualização
    }

    // Carregar o modelo
    $this->load->model('User_model');

    // Atualizar o usuário no banco de dados
    $result = $this->User_model->update_user($this->session->userdata('user_id'), $data);

    if ($result) {
        // Definir a mensagem de sucesso
        $this->session->set_flashdata('success', 'Perfil atualizado com sucesso!');
        redirect('client/profile'); // Redireciona para a página de perfil
    } else {
        // Definir mensagem de erro em caso de falha
        $this->session->set_flashdata('error', 'Ocorreu um erro ao atualizar o perfil.');
        redirect('client/update_profile'); // Redireciona de volta para a página de atualização
    }
}




public function upload_foto() {
    // Verificar se o usuário está logado
    $this->verifySession();

    $user_id = $this->session->userdata('user_id');
    
    if (!$user_id) {
        redirect('auth/login');
    }

    // Configuração de upload
    $config['upload_path'] = './uploads/profile_pictures/';
    $config['allowed_types'] = 'gif|jpg|jpeg|png';
    $config['max_size'] = 1024; // Tamanho máximo em KB

    $this->upload->initialize($config);

    if ($this->upload->do_upload('profile_picture')) {
        $upload_data = $this->upload->data();
        $profile_picture = $upload_data['file_name'];

        // Atualiza o banco de dados com a nova foto
        $data = [
            'profile_picture' => $profile_picture,
        ];

        $result = $this->User_model->update_user($user_id, $data);

        if ($result) {
            $this->session->set_flashdata('success', 'Foto de perfil atualizada com sucesso!');
            redirect('client_dashboard/profile');
        } else {
            $this->session->set_flashdata('error', 'Erro ao atualizar foto de perfil.');
            redirect('client_dashboard/edit_profile');
        }
    } else {
        // Caso ocorra erro no upload
        $error = $this->upload->display_errors();
        $this->session->set_flashdata('error', $error);
        redirect('client_dashboard/edit_profile');
    }
}


// Função para editar um agendamento
// public function edit_appointment($appointment_id) {
//     $this->verifySession();
//     $user_id = $this->session->userdata('user_id');

//     // Obter o agendamento pelo ID
//     $appointment = $this->Appointment_model->get_appointment_by_id($appointment_id);

//     if (!$appointment) {
//         show_404();
//     }

//     // Verificar se o agendamento pertence ao usuário logado
//     if ($appointment->user_id != $user_id) {
//         redirect('client/appointments');
//     }

//     // Carregar os modelos necessários para editar os dados
//     $this->load->model('Pet_model');
//     $this->load->model('User_model');

//     // Obter lista de clínicas e pets
//     $clinics = $this->User_model->get_users_by_role('clinic');
//     $pets = $this->Pet_model->get_pets_by_user($user_id);

//     $data['appointment'] = $appointment;
//     $data['clinics'] = $clinics;
//     $data['pets'] = $pets;

//     // Carregar a visão de edição
//     $this->load->view('client/edit_appointment', $data);
// }

public function update_status($appointment_id, $new_status) {
    // Valida se o status é permitido
    $valid_statuses = ['atendido', 'rejeitado', 'cancelado'];
    if (in_array($new_status, $valid_statuses)) {
        // Chama o método do modelo para editar o agendamento
        $description = "Status alterado para " . $new_status; // Você pode ajustar a descrição aqui
        $result = $this->Appointment_model->edit_appointment($appointment_id, $description, $new_status);
        
        if ($result) {
            // Redireciona para a página de agendamentos pendentes com sucesso
            $this->session->set_flashdata('success', 'Status atualizado com sucesso!');
            redirect('clinic/pending_appointments');
        } else {
            // Se houver erro na atualização, redireciona com mensagem de erro
            $this->session->set_flashdata('error', 'Erro ao atualizar o status.');
            redirect('clinic/pending_appointments');
        }
    } else {
        // Se o status não for válido, exibe mensagem de erro
        $this->session->set_flashdata('error', 'Status inválido.');
        redirect('clinic/pending_appointments');
    }
}
public function cancel_appointment($appointment_id) {
    // Carregar os modelos necessários
    $this->load->model('Appointment_model');
    
    // Obter o agendamento original
    $appointment = $this->Appointment_model->get_appointment($appointment_id);

    // Verifique se o agendamento existe
    if ($appointment) {
        // Insira o agendamento na tabela de agendamentos arquivados
        $this->db->insert('archived_appointments', $appointment);
        
        // Excluir o agendamento da tabela de agendamentos
        $this->db->delete('appointments', ['id' => $appointment_id]);
        
        // Redirecionar ou exibir uma mensagem de sucesso
        redirect('client_dashboard/appointments');
    } else {
        // Tratar erro se o agendamento não existir
        show_error('Agendamento não encontrado');
    }
}

// Função para exibir os agendamentos do usuário
public function appointments() {
    $this->verifySession();

    // Obter o ID do usuário logado
    $user_id = $this->session->userdata('user_id');
    
    // Buscar os agendamentos do usuário
    $appointments = $this->Appointment_model->get_appointments_by_user($user_id);

    if (!$appointments) {
        $appointments = [];
    }

    $this->load->model('Pet_model');
    
    foreach ($appointments as &$appointment) {
        $pet = $this->Pet_model->get_pet_by_id($appointment->pet_id);
        $appointment->pet_name = $pet ? $pet->name : 'Desconhecido';
        
        $clinic = $this->User_model->get_user_by_id($appointment->clinic_id);
        $appointment->clinic_name = $clinic ? $clinic->name : 'Desconhecida';

        if (isset($clinic->role)) {
            $appointment->clinic_role = $clinic->role;
        } else {
            $appointment->clinic_role = 'Desconhecido';
        }
    }

    $data['appointments'] = $appointments;
    $this->load->view('client/appointments', $data);
}

// Função para editar um agendamento
public function edit_appointment($appointment_id) {
    $this->verifySession();
    $user_id = $this->session->userdata('user_id');

    // Obter o agendamento pelo ID
    $appointment = $this->Appointment_model->get_appointment_by_id($appointment_id);

    if (!$appointment) {
        show_404();
    }

    // Verificar se o agendamento pertence ao usuário logado
    if ($appointment->user_id != $user_id) {
        redirect('client/appointments');
    }

    // Carregar os modelos necessários para editar os dados
    $this->load->model('Pet_model');
    $this->load->model('User_model');

    // Obter lista de clínicas e pets
    $clinics = $this->User_model->get_users_by_role('clinic');
    $pets = $this->Pet_model->get_pets_by_user($user_id);

    $data['appointment'] = $appointment;
    $data['clinics'] = $clinics;
    $data['pets'] = $pets;

    // Carregar a visão de edição
    $this->load->view('client/edit_appointment', $data);
}

public function update_appointment($appointment_id) {
    // Obter os dados do formulário
    $pet_id = $this->input->post('pet_id'); // Certifique-se de que esse campo está sendo enviado corretamente
    $clinic_id = $this->input->post('clinic_id');
    $description = $this->input->post('description');
    $status = $this->input->post('status');

    // Verificar se pet_id está vazio ou inválido
    if (!$pet_id) {
        // Caso o pet_id não tenha sido preenchido, retornar um erro ou atribuir um valor padrão
        $this->session->set_flashdata('error', 'Pet não selecionado.');
        redirect('client_dashboard/appointments');
    }

    if ($status == 'cancelado') {
        redirect('client_dashboard/cancel_appointment/' . $appointment_id);
    }

    $appointment_data = [
        'user_id' => $this->session->userdata('user_id'),
        'clinic_id' => $this->input->post('clinic_id'),
        'pet_id' => $this->input->post('pet_id'),
        'description' => $this->input->post('description'),
        'status' => $this->input->post('status') // Não inclua 'type'
    ];

    // Atualizar no banco
    $this->Appointment_model->update($appointment_id, $appointment_data);

    // Redirecionar ou retornar à página de agendamentos
    redirect('client_dashboard/appointments');
}


}