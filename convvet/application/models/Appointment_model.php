<?php
class Appointment_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    // Criar um novo agendamento
    public function create_appointment($data) {
        return $this->db->insert('appointments', $data);
    }

    public function get_archived_appointments() {
        $this->db->where('status', 'arquivado'); // Filtra pelas que estão arquivadas
        $query = $this->db->get('appointments');
        return $query->result_array(); // Retorna as soluções arquivadas
    }


    public function update($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('appointments', $data);  // Atualiza a tabela 'appointments'
    }
    
    public function cancel_appointment($id) {
        // Obter o agendamento para obter todas as informações necessárias
        $appointment = $this->db->get_where('appointments', ['id' => $id])->row_array();
        
        if ($appointment) {
            // Mover o agendamento para a tabela 'archived_appointments'
            $this->db->insert('archived_appointments', $appointment);
    
            // Excluir o agendamento da tabela 'appointments'
            $this->db->delete('appointments', ['id' => $id]);
    
            return true;
        }
    
        return false;
    }
    
    public function test_get_pending_appointments() {
        $this->load->model('Appointment_model');
        $appointments = $this->Appointment_model->get_pending_appointments();
        echo '<pre>';
        print_r($appointments);
        echo '</pre>';
        exit; // Interrompe para verificar os resultados
    }
    
    
    
    // Obter todos os agendamentos
    public function get_all_appointments($user_id) {
        // Realiza uma junção entre as tabelas appointments, clinics e pets
        $this->db->select('appointments.id, clinics.name as clinic_name, pets.name as pet_name, appointments.description, appointments.status');
        $this->db->from('appointments');
        $this->db->join('clinics', 'clinics.id = appointments.clinic_id');
        $this->db->join('pets', 'pets.id = appointments.pet_id');
        $this->db->where('appointments.user_id', $user_id);
        $query = $this->db->get();

        return $query->result();  // Retorna os agendamentos encontrados
    }


    // Obter agendamentos pendentes de uma clínica
    public function get_appointments_for_clinic($clinic_id) {
        $this->db->where('clinic_id', $clinic_id);
        $this->db->where('status', 'pendente');  // Apenas pendentes
        $query = $this->db->get('appointments');
        return $query->result_array();
    }

    public function delete_appointment($appointment_id) {
        $this->db->where('id', $appointment_id);
        return $this->db->delete('appointments');
    }

    public function insert_appointment($data) {
        // Insere o agendamento no banco de dados
        return $this->db->insert('appointments', $data);  // Retorna TRUE ou FALSE
    }

    public function get_appointment($id) {
        $this->db->select('*');
        $this->db->from('appointments');
        $this->db->where('id', $id);
        $query = $this->db->get();

        return $query->row(); // Retorna o agendamento como um objeto
    }

// No User_model.php
public function get_clinics($role) {
    $this->db->select('id, name');
    $this->db->from('users');
    $this->db->where('role', $role);  // Filtra pelo role 'clinic'
    $query = $this->db->get();
    return $query->result();  // Retorna todas as clínicas
}

    // Buscar todos os pets
    public function get_all_pets() {
        $this->db->select('*');
        $this->db->from('pets');
        $query = $this->db->get();

        return $query->result(); // Retorna os pets como um array
    }

    // Método para buscar agendamentos do usuário
public function get_appointments_by_user($user_id) {
    $this->db->select('*');
    $this->db->from('appointments');
    $this->db->where('user_id', $user_id);
    $query = $this->db->get();
    return $query->result();
}

// Método para obter um agendamento pelo ID
public function get_appointment_by_id($appointment_id) {
    $this->db->select('*');
    $this->db->from('appointments');
    $this->db->where('id', $appointment_id);
    $query = $this->db->get();
    return $query->row();
}

public function edit_appointment($appointment_id, $description, $status) {
    // Verifica se o appointment_id é válido
    if (empty($appointment_id)) {
        echo "ID de agendamento não fornecido no modelo.";
        return false;
    }

    // Dados a serem atualizados
    $data = array(
        'description' => $description,
        'status' => $status,
        'updated_at' => date('Y-m-d H:i:s')
    );

    // Tentativa de atualização
    $this->db->where('id', $appointment_id);
    $updated = $this->db->update('appointments', $data);

    // Verificar se a atualização foi bem-sucedida
    if (!$updated) {
        // Se falhar, exibir a última consulta SQL
        echo "Erro na atualização. Última consulta SQL: " . $this->db->last_query();
        return false;
    }

    return true;
}

public function get_pending_appointments() {
    $this->db->where('status', 'pendente'); // Filtra por status 'pendente'
    $query = $this->db->get('appointments'); // Nome da tabela deve ser 'appointments'
    return $query->result_array(); // Retorna os resultados como array
}


}
?>