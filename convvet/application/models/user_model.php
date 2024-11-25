<?php
// application/models/User_model.php
class User_model extends CI_Model {



    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function insert_user($data) {
        // Tenta inserir os dados na tabela 'users'
        return $this->db->insert('users', $data);
    }

// No modelo User_model
// No modelo User_model
// No modelo User_model
public function authenticate($email, $password) {
    // Verifica se o usuário existe pelo email
    $this->db->where('email', $email);
    $query = $this->db->get('users');  // Supondo que o nome da tabela seja 'users'

    if ($query->num_rows() > 0) {
        $user = $query->row();

        // Compara a senha diretamente (sem hash)
        if ($password == $user->password) {
            // Senha correta, retorna o usuário
            return $user;
        } else {
            // Senha incorreta
            return false;
        }
    }

    // Se o email não foi encontrado, retorna false
    return false;
}

    
        // Obter o usuário pelo email
        public function get_user_by_email($email) {
            $this->db->where('email', $email);
            $query = $this->db->get('users'); // Assume que você tem uma tabela 'users'
            return $query->row_array();  // Retorna o usuário como um array
        }

    public function check_login($email, $password) {
        $this->db->where('email', $email);
        $query = $this->db->get('users');
        
        if ($query->num_rows() > 0) {
            $user = $query->row();
            if (password_verify($password, $user->password)) {
                return $user;
            }
        }
        return false;
    }

    public function check_role($user_id) {
        $this->db->select('role');
        $this->db->where('id', $user_id);
        $query = $this->db->get('users');
        
        if ($query->num_rows() > 0) {
            return $query->row()->role;
        }
        return false;
    }

}


?>