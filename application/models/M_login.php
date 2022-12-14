<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_login extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('form_validation');
    }

    //Login
    public function login($table, $username, $password)
    {
        return $this->db->get_where($table, array('username' => $username, 'password' => $password));
    }

    public function gantipass($table, $pass)
    {
        return $this->db->get_where($table, array('password' => $pass));
    }

    public function update($table, $data, $id_user)
    {
        return $this->db->update($table, $data, array('id_user' => $id_user));
    }
}
