<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sac_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    // Função para criar um chamado
    public function criar_chamado($dados) {
        // Insere os dados na tabela 'sac'
        $this->db->insert('sac', $dados);
    }

    // Função para pegar os chamados de uma clínica
    public function get_chamados_clinica($user_name) {
        // Busca os chamados associados à clínica (por nome de usuário)
        $this->db->select('sac.*, users.name');
        $this->db->from('sac');
        $this->db->join('users', 'sac.user_name = users.name');
        $this->db->where('users.role', 'clinica');  // Filtra apenas os chamados da clínica
        $query = $this->db->get();
        return $query->result();
    }
}
