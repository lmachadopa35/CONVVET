<?php
class User_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function insert_user($data) {
        // Senha armazenada sem hash (em texto simples)
        if (isset($data['password']) && !empty($data['password'])) {
            // Não aplica hash, apenas armazena o valor fornecido
            $data['password'] = $data['password'];
        }

        return $this->db->insert('users', $data);
    }

    // Método de autenticação (verifica a senha e o role)
    public function authenticate($email, $password, $role) {
        // Verificar se o email e o role estão corretos
        $this->db->where('email', $email);
        $this->db->where('role', $role);  // Verifica também o papel
        $query = $this->db->get('users');

        if ($query->num_rows() > 0) {
            $user = $query->row();

            // Comparação de senha sem hash
            if ($user->password == $password) {
                return $user;
            }
        }

        return false;
    }

    // Obter o usuário pelo email
    public function get_user_by_email($email) {
        $this->db->where('email', $email);
        $query = $this->db->get('users');
        return $query->row_array();  // Retorna o usuário como um array
    }

    // Verifica o papel do usuário (admin, client, clinic)
    public function check_role($user_id) {
        $this->db->select('role');
        $this->db->where('id', $user_id);
        $query = $this->db->get('users');
        
        if ($query->num_rows() > 0) {
            return $query->row()->role;
        }
        return false;
    }
    public function get_user($user_id) {
        $query = $this->db->get_where('users', array('id' => $user_id));
        return $query->row_array(); // Retorna o usuário como um array
    }
    

    // Método para obter informações de um usuário com base no seu ID
    public function get_user_by_id($user_id) {
        $this->db->where('id', $user_id);
        $query = $this->db->get('users');
        
        if ($query->num_rows() > 0) {
            return $query->row();  // Retorna o usuário encontrado
        }
        return null;  // Caso não encontre
    }

    public function update_user($user_id, $data) {
        // Verificar se os campos necessários estão preenchidos
        if (empty($data['name']) || empty($data['email'])) {
            return false; // Retorna false caso algum campo obrigatório esteja vazio
        }
    
        // Realizar o update no banco de dados
        $this->db->where('id', $user_id);
        return $this->db->update('users', $data);
    }
    
    public function get_users_by_role($role) {
        $this->db->select('*');
        $this->db->from('users'); // Supondo que sua tabela de usuários se chama 'users'
        $this->db->where('role', $role); // Filtra pelos usuários com a role especificada
        $query = $this->db->get();
        return $query->result(); // Retorna todos os usuários com a role
    }
    public function get_clinics() {
        $this->db->where('role', 'clinic');  // Filtra usuários do tipo 'clinic'
        $query = $this->db->get('users');    // Busca na tabela 'users'
        return $query->result_array();        // Retorna os dados como array
    }

    public function get_role_by_user($user_id) {
        $this->db->select('role');
        $this->db->from('users');
        $this->db->where('id', $user_id);
        $query = $this->db->get();
        
        return $query->row()->role;  // Retorna o role do usuário
    }

    // Função para pegar os pets do usuário
    public function get_pets_by_user($user_id) {
        $this->db->where('user_id', $user_id);
        $query = $this->db->get('pets');
        return $query->result();
    }

    // Função para pegar as clínicas associadas ao usuário
    public function get_clinics_by_user($user_id) {
        // A clínica do usuário pode ser definida pela sua role
        $this->db->where('id', $user_id);
        $query = $this->db->get('users');
        $user = $query->row(); // Pega os dados do usuário, incluindo o role

        // Se o usuário for, por exemplo, um "administrador" de clínica, retorna as clínicas associadas ao role dele
        if ($user) {
            if ($user->role == 'admin') {
                // Exemplo de como retornar uma clínica caso o usuário seja um "admin"
                return [
                    (object)[
                        'id' => 1,
                        'name' => 'Clínica Veterinária Central'
                    ]
                ];
            } else {
                // Retornar outra lógica com base na role do usuário
                return [
                    (object)[
                        'id' => 2,
                        'name' => 'Clínica Pet Care'
                    ]
                ];
            }
        }
        return []; // Se o usuário não tiver role válida, retorna um array vazio
    }

    // Função para criar o agendamento
    public function create_appointment($user_id, $pet_id, $clinic_id, $description) {
        $data = [
            'user_id' => $user_id,
            'pet_id' => $pet_id,
            'clinic_id' => $clinic_id,
            'description' => $description,
            'created_at' => date('Y-m-d H:i:s')
        ];
        return $this->db->insert('appointments', $data);
    }
            

}
?>