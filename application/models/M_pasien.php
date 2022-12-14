<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_pasien extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('form_validation');
    }

    //Login
    public function data($table)
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->order_by('id_pasien', 'DESC');
        return $this->db->get();
    }

    public function detail($table,$id)
    {
        return $this->db->get_where($table, array('id_pasien' => $id));
    }

    public function detail_nik($table,$nik)
    {
        return $this->db->get_where($table, array('nik_pasien' => $nik));
    }
    
    public function tambah($table,$data)
    {
        return $this->db->insert($table,$data);
    }
    
    public function edit($table,$data,$id)
    {
        return $this->db->update($table,$data,array('id_pasien' => $id));
    }
    
    public function hapus($table,$id)
    {
        return $this->db->delete($table,array('id_pasien' => $id));
    }
}
