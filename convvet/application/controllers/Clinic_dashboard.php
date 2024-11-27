<?php
// application/controllers/Clinic_dashboard.php
class Clinic_dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');  // Carrega o modelo da clínica
        $this->load->library('form_validation');  // Carregar a biblioteca de validação
        $this->load->helper('url');  // Carregar o helper de URL
        $this->verifySession();  // Verifica se o usuário está logado
        $this->load->library('upload');  
        $this->load->model('Pet_model');
        $this->load->helper('url');                // Carregar o helper de URL para usar a função redirect
        $this->load->model('Appointment_model');
        $this->load->model('Emergency_model');
        $this->load->library('session');
    }

    public function archived_emergencies() {
        $clinic_id = $this->session->userdata('user_id');
        $data['archived_emergencies'] = $this->Emergency_model->get_emergencies_by_clinic_and_status($clinic_id, 'atendido');
        $this->load->view('clinic/archived_emergencies', $data);
    }
    
    public function update_status($appointment_id, $new_status) {
        // Valida se o status é permitido
        $valid_statuses = ['atendido', 'rejeitado', 'cancelado'];
        if (in_array($new_status, $valid_statuses)) {
            // Tenta atualizar o status
            $description = "Status alterado para " . $new_status;
            $result = $this->Appointment_model->edit_appointment($appointment_id, $description, $new_status);
    
            if ($result) {
                $this->session->set_flashdata('success', 'Status atualizado com sucesso!');
            } else {
                $this->session->set_flashdata('error', 'Erro ao atualizar o status.');
            }
        } else {
            $this->session->set_flashdata('error', 'Status inválido.');
        }
    
        redirect('clinic/pending_appointments'); // Redireciona para a página de pendentes
    }
    
    public function edit_appointment($appointment_id, $description, $status) {
        if (empty($appointment_id)) {
            log_message('error', 'ID de agendamento não fornecido.');
            return false;
        }
    
        $data = [
            'description' => $description,
            'status' => $status,
            'updated_at' => date('Y-m-d H:i:s')
        ];
    
        $this->db->where('id', $appointment_id);
        $updated = $this->db->update('appointments', $data);
    
        if (!$updated) {
            log_message('error', 'Erro ao atualizar: ' . $this->db->last_query());
            return false;
        }
    
        return true;
    }
    public function get_pending_appointments() {
        $query = $this->db->get_where('appointments', ['status' => 'pendente']);
        return $query->result_array();
    }

        
    

    public function view_emergencies() {
        $clinic_id = $this->session->userdata('user_id');
        $data['emergencies'] = $this->Emergency_model->get_emergencies_by_clinic_and_status($clinic_id, 'pendente');
        $data['in_progress'] = $this->Emergency_model->get_emergencies_by_clinic_and_status($clinic_id, 'em atendimento');
        $this->load->view('clinic/emergency_dashboard', $data);
    }
    
    

    // Método para atualizar o status da emergência
    public function update_emergency($emergency_id) {
        $status = $this->input->post('status');
        $this->Emergency_model->update_emergency_status($emergency_id, $status);

        // Redirecionar após a atualização
        $this->session->set_flashdata('success', 'Status da emergência atualizado com sucesso!');
        redirect('clinic_dashboard/view_emergencies');
    }


    public function pending_appointments() {
        $this->load->model('Appointment_model'); // Certifique-se de carregar o modelo
        $data['appointments'] = $this->Appointment_model->get_pending_appointments(); // Chama o método
        $this->load->view('clinic/pending_appointments', $data); // Envia os dados para a view
    }
    
    public function test_get_pending_appointments() {
        $this->load->model('Appointment_model');
        $appointments = $this->Appointment_model->get_pending_appointments();
        echo '<pre>';
        print_r($appointments);
        echo '</pre>';
        exit; // Interrompe para mostrar os dados
    }
    
    



    public function get_all_clinics() {   
        $user_id = $this->session->userdata('user_id');
        $user = $this->User_model->get_user_by_id($user_id);
        if ($user && $user->role === 'clinic') {
            $this->db->select('id, name, address');
            $this->db->from('clinics');
            $query = $this->db->get();
            
            // Retorna os resultados
            return $query->result();
        }    
        
}

    public function verifySession(){
        $user_id = $this->session->userdata('user_id');

        // Verifica se o usuário está logado
        if (!$user_id) {
            redirect('auth/login'); // Redireciona se o usuário não estiver logado
        }
    }
    public function profile() {
        $user_id = $this->session->userdata('user_id');
        
        // Obtém as informações do usuário
        $user = $this->User_model->get_user_by_id($user_id);
        
        if ($user && $user->role === 'clinic') {
            $data['user'] = $user;
            $this->load->view('clinic/profile', $data);  // Carrega a view 'clinic/profile'
        } else {
            redirect('clinic_dashboard');
        }
    }

    public function edit_profile() {
        $user_id = $this->session->userdata('user_id');
        $user = $this->User_model->get_user_by_id($user_id);

        if ($user && $user->role === 'clinic') {
            $data['user'] = $user;
            $this->load->view('clinic/edit_profile', $data);
        } else {
            redirect('clinic_dashboard');
        }
    }

    public function update_profile() {
        $user_id = $this->session->userdata('user_id');
        
        $data = array(
            'name' => $this->input->post('name'),
            'email' => $this->input->post('email'),
            'phone' => $this->input->post('phone'),
            'address' => $this->input->post('address'),
            'cnpj' => $this->input->post('cnpj'),
        );
        
        // Atualiza as informações principais do usuário
        $result = $this->User_model->update_user($user_id, $data);
        
        if ($result) {
            $this->session->set_flashdata('success', 'Perfil atualizado com sucesso!');
            redirect('clinic_dashboard/profile');
        } else {
            $this->session->set_flashdata('error', 'Erro ao atualizar perfil.');
            redirect('clinic_dashboard/edit_profile');
        }
    }
    
    public function upload_foto() {
        $user_id = $this->session->userdata('user_id');
        
        if (!$user_id) {
            redirect('auth/login');
        }
    
        // Configuração de upload
        $config['upload_path'] = './uploads/profile_pictures/';
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $config['max_size'] = 1024;
    
        $this->upload->initialize($config);
    
        if ($this->upload->do_upload('profile_picture')) {
            $upload_data = $this->upload->data();
            $profile_picture = $upload_data['file_name'];  // Nome do arquivo
    
            // Atualiza o banco de dados com a nova foto
            $data = [
                'profile_picture' => $profile_picture,
            ];
    
            $result = $this->User_model->update_user($user_id, $data);
    
            if ($result) {
                $this->session->set_flashdata('success', 'Foto de perfil atualizada com sucesso!');
                redirect('clinic_dashboard/profile');
            } else {
                $this->session->set_flashdata('error', 'Erro ao atualizar foto de perfil.');
                redirect('clinic_dashboard/edit_profile');
            }
        } else {
            // Caso ocorra erro no upload
            $error = $this->upload->display_errors();
            $this->session->set_flashdata('error', $error);
            redirect('clinic_dashboard/edit_profile');
        }
    }
      
    public function index() {
        $user_id = $this->session->userdata('user_id');
        $user = $this->User_model->get_user_by_id($user_id);
        // Verifica se o usuário está logado
        if ($user && $user->role !== 'clinic') {
            redirect('auth/logout'); // Redireciona se o usuário não estiver logado
        }
        // Pega os pets do usuário logado

        // Carrega a visão com os dados dos pets
        $this->load->view('clinic/dashboard');
    }

    public function view_pets() {    
        $user_id = $this->session->userdata('user_id');
        $user = $this->User_model->get_user_by_id($user_id);
        if ($user && $user->role === 'clinic') {
            $data['pets'] = $this->Pet_model->get_all_pets(true); // Passa true para incluir usuário
    // Carregar a view e passar os dados
    $this->load->view('clinic/view_pets', $data);
        }    
        
}


}
?>