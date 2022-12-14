<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Antrian extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['m_pasien','m_antrian']);
        $this->load->helper(array('form', 'url'));
    }

    public function index()
    {
        $nik = $this->input->post('nik');

        $cari = $this->m_pasien->detail_nik('pasien',$nik)->row();
        $antrian = $this->m_antrian->data('antrian')->result();

        if (isset($_GET['cari'])) {
            if ($cari=="") {
                $this->session->set_flashdata('cari_pasien','Data Tidak Ditemukan!');
                redirect('antrian');
            }
        }

        $data = array(
            'title'        => 'User',
            'antrian'        => $antrian,
            'cari'        => $cari,
            'isi'        => 'petugas/v_antrian',
        );

        $this->load->view('layout/wrapper', $data);


    }


    public function tambah($id=null)
    {
        if ($id=="") show_404();

        $cek = $this->m_antrian->cek('antrian')->row();

        if ($cek->no_antrian=="") {
            $no_antrian = 'K0001';
        }
        else{
            $urut = (int) substr($cek->no_antrian, 1, 4);
            $urut++;
            $no_antrian = sprintf("K%04s", $urut);
        }

        $today = date('Y-m-d');
        $cek_today = $this->m_antrian->cek_pasien('antrian',$id,$today)->num_rows();

        if ($cek_today>0) {
            $this->session->set_flashdata('cari_pasien', 'Pasien Tersebut Sudah Terdaftar Hari Ini!');
            redirect(base_url('antrian'));
        }
        else{
            $data_antrian = array(
                'no_antrian'        => $no_antrian,
                'id_pasien'        => $id,
                'id_user'        => $this->session->userdata('id_user'),
                'tgl_checkup'        => $today,
                'status_antrian'        => 'antrian'
            );

            $this->m_antrian->tambah('antrian', $data_antrian);

            $this->session->set_flashdata('antrian_pasien', 'Antrian '.$no_antrian.' Berhasil Ditambahkan!');
            redirect(base_url('antrian'));
        }
        // $id_antrian = $this->db->insert_id();

        // $data_pemeriksaan = array(
        //     'id_antrian'        => $id_antrian,
        //     'tekanan_darah'        => '',
        //     'suhu_badan'        => '',
        //     'keluhan'        => '',
        // );

        // $this->m_antrian->tambah('pemeriksaan', $data_antrian);
        // $id_pemeriksaan = $this->db->insert_id();

        // $data_rekam_medis = array(
        //     'id_pemeriksaan'        => $id_pemeriksaan,
        //     'id_user'        => '',
        //     'diagnosa'        => '',
        //     'tindakan'        => '',
        //     'rujukan'        => '',
        // );


        // $this->m_pasien->tambah('pasien', $data);


    }


    public function periksa($id=null)
    {
        if($id=="") show_404();

        $valid = $this->form_validation;
        
        
        $valid->set_rules(
            'tekanan_darah',
            'Tekanan Darah',
            'required',
            array(
                'required'                       => 'Tekanan Darah harus diisi'
            )
        );

        $valid->set_rules(
            'suhu_badan',
            'Suhu Badan',
            'required',
            array(
                'required'                       => 'Suhu Badan harus diisi'
            )
        );

        $valid->set_rules(
            'keluhan',
            'Keluhan',
            'required',
            array(
                'required'                       => 'Keluhan harus diisi'
            )
        );
        
        


        if ($valid->run() === false) {
            $this->session->set_flashdata('gagal', validation_errors());

            $edit_status = array(
                'status_antrian' => 'pemeriksaan',
                'id_user' => $this->session->userdata('id_user')
            );

            $this->m_antrian->edit('antrian',$edit_status,$id);

            $data_pasien = $this->m_antrian->cek_data_pasien('antrian',$id)->row();

            $data = array(
                'title'        => 'Pemeriksaan',
                'data'        => $data_pasien,
                'isi'        => 'petugas/v_pemeriksaan',
            );
            // echo "<pre>";
            // print_r($data_pasien);
            // echo "</pre>";
            $this->load->view('layout/wrapper', $data);
        } else {

            $i = $this->input;

            $id_antrian      = $id;
            $tekanan_darah     = $i->post('tekanan_darah');
            $suhu_badan     = $i->post('suhu_badan');
            $keluhan     = $i->post('keluhan');

            $data = array(
                'id_antrian'        => $id_antrian,
                'tekanan_darah'        => $tekanan_darah,
                'suhu_badan'        => $suhu_badan,
                'keluhan'        => $keluhan,
                'status_pemeriksaan'        => 'petugas'
            );

            $this->m_antrian->tambah('pemeriksaan', $data);

            $this->session->set_flashdata('sukses', 'Pemeriksaan Oleh Petugas Selesai');
            redirect(base_url('antrian'));

        }
    }


    // public function hapus($id=null)
    // {
    //     if($id=="") show_404();

    //     $this->m_pasien->hapus('pasien', $id);

    //     $this->session->set_flashdata('sukses', 'Pasien Berhasil Dihapus!');
    //     redirect(base_url('pasien'));

    // }
}
