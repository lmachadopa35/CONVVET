<?php
class Emergency_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();

    }
    public function insert_emergency($data) {
        // Insere os dados na tabela 'emergencies'
        $this->db->insert('emergencies', $data);
        return $this->db->insert_id(); // Retorna o ID do registro inserido
    }

    // Método para obter emergências (exemplo de listagem)
    public function get_emergencies() {
        $this->db->select('*');
        $this->db->from('emergencies');
        $query = $this->db->get();
        return $query->result_array(); // Retorna as emergências como um array
    }

    public function get_emergencies_by_clinic($clinic_id) {
        $this->db->select('emergencies.*, pets.name as pet_name, pets.type as pet_type, pets.breed, pets.age');
        $this->db->from('emergencies');
        $this->db->join('pets', 'pets.id = emergencies.pet_id'); // Relaciona pets à emergência
        $this->db->where('emergencies.clinic_id', $clinic_id);
        $this->db->order_by('emergencies.created_at', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function get_emergencies_by_clinic_and_status($clinic_id, $status) {
        $this->db->select('emergencies.*, pets.name AS pet_name, pets.type AS pet_type, pets.breed, pets.age');
        $this->db->from('emergencies');
        $this->db->join('pets', 'emergencies.pet_id = pets.id', 'left'); // Certifique-se de que `pets` é o nome correto da tabela
        $this->db->where('emergencies.clinic_id', $clinic_id);
        $this->db->where('emergencies.status', $status);
        $query = $this->db->get();
        return $query->result_array();
    }
    
    
    

    // Método para atualizar o status da emergência
    public function update_emergency_status($emergency_id, $status) {
        $this->db->where('id', $emergency_id);
        $this->db->update('emergencies', ['status' => $status]); // Atualiza o status
    }


}
