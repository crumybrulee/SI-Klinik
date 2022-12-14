<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_antrian extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('form_validation');
    }

    //Login
    public function cek($table)
    {
        $this->db->select_max('no_antrian');
        $this->db->from($table);
        return $this->db->get();
    }

    public function cek_pasien($table,$id_pasien,$today)
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where('id_pasien', $id_pasien);
        $this->db->where('tgl_checkup', $today);
        $this->db->where('status_antrian !=', 'selesai');
        return $this->db->get();
    }

    public function data($table)
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->join('pasien', $table.'.id_pasien = pasien.id_pasien');
        $this->db->order_by('id_antrian','ASC');
        return $this->db->get();
    }

    public function cek_data_pasien($table,$id)
    {
        $this->db->select('id_antrian,no_antrian,pasien.id_pasien,user.id_user,tgl_checkup,status_antrian,nik_pasien,nama_pasien,umur_pasien,alamat_pasien, jenis_kelamin, nama_user');
        $this->db->from($table);
        $this->db->join('pasien', $table.'.id_pasien = pasien.id_pasien');
        $this->db->join('user', $table.'.id_user = user.id_user');
        $this->db->where('id_antrian',$id);
        return $this->db->get();
    }

    public function tambah($table,$data)
    {
        return $this->db->insert($table,$data);
    }

    public function edit($table,$data,$id)
    {
        return $this->db->update($table,$data, array('id_antrian' => $id));
    }

}
