<?php
class Pet_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database(); // Carrega o banco de dados explicitamente, caso não esteja carregado automaticamente
    }

    public function insert_pet($data) {
        return $this->db->insert('pets', $data); // Insere os dados na tabela 'pets'
    }

    

    // Método para obter todos os pets de um usuário
    public function get_pets_by_user($user_id) {
        $this->db->select('*');
        $this->db->from('pets');
        $this->db->where('user_id', $user_id);
        $query = $this->db->get();
        return $query->result();
    }
      // Método para obter um pet pelo ID
      public function get_pet_by_id($pet_id) {
        $query = $this->db->get_where('pets', ['id' => $pet_id]);
        return $query->row();
    }

    // Método para atualizar os dados de um pet
    public function update_pet($pet_id, $data) {
        $this->db->where('id', $pet_id);
        $this->db->update('pets', $data);
    }

    // Método para excluir um pet
    public function delete_pet($pet_id) {
        $this->db->where('id', $pet_id);
        $this->db->delete('pets');
    }
    public function get_all_pets() {
        $this->db->select('pets.id, pets.type, pets.name AS pet_name, pets.breed, pets.age, users.name AS user_name');
        $this->db->from('pets');
        $this->db->join('users', 'pets.user_id = users.id', 'left');  // LEFT JOIN para incluir pets sem usuário
        $query = $this->db->get();
        return $query->result();
    }
}
?>
