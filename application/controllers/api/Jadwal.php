<?php
defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Jadwal extends RestController
{
    public function __construct()
     {
          parent::__construct();
          $this->load->model('m_jadwal');
     }

    //menampilkan data active
    public function data_active_get()
    {
        $data = $this->db->select('*')->from('tbl_jadwal')
            ->join('tbl_peserta', 'tbl_peserta.id_peserta = tbl_jadwal.id_peserta', 'left')
            ->join('tbl_instruktur', 'tbl_instruktur.id_instruktur = tbl_jadwal.id_instruktur', 'left')
            ->join('tbl_paket', 'tbl_paket.id_paket = tbl_jadwal.id_paket', 'left')
            ->where('status_jadwal = 2')
            ->where('status_bayar = 1')
            ->order_by('tbl_jadwal.id_jadwal', 'desc')->get()->result();
        $this->response($data, RestController::HTTP_OK);
    }

    //menampilkan get data
    public function data_get()
    {
        $data =
            $this->db->select('*')->from('tbl_jadwal')
            ->join('tbl_peserta', 'tbl_peserta.id_peserta = tbl_jadwal.id_peserta', 'left')
            ->join('tbl_instruktur', 'tbl_instruktur.id_instruktur = tbl_jadwal.id_instruktur', 'left')
            ->join('tbl_paket', 'tbl_paket.id_paket = tbl_jadwal.id_paket', 'left')
            ->order_by('tbl_jadwal.id_jadwal', 'desc')->get()->result();
        $this->response($data, RestController::HTTP_OK);
    }

    public function data_belum_bayar_get()
    {
        $data =
            $this->db->select('*')->from('tbl_jadwal')
            ->join('tbl_peserta', 'tbl_peserta.id_peserta = tbl_jadwal.id_peserta', 'left')
            ->join('tbl_instruktur', 'tbl_instruktur.id_instruktur = tbl_jadwal.id_instruktur', 'left')
            ->join('tbl_paket', 'tbl_paket.id_paket = tbl_jadwal.id_paket', 'left')
            ->where('status_bayar = 0')
            ->order_by('tbl_jadwal.id_jadwal', 'desc')->get()->result();
        $this->response($data, RestController::HTTP_OK);
    }

    public function data_sudah_bayar_get()
    {
        $data =
            $this->db->select('*')->from('tbl_jadwal')
            ->join('tbl_peserta', 'tbl_peserta.id_peserta = tbl_jadwal.id_peserta', 'left')
            ->join('tbl_instruktur', 'tbl_instruktur.id_instruktur = tbl_jadwal.id_instruktur', 'left')
            ->join('tbl_paket', 'tbl_paket.id_paket = tbl_jadwal.id_paket', 'left')
            ->where('status_bayar = 1')
            ->where('status_jadwal = 0')
            ->order_by('tbl_jadwal.id_jadwal', 'desc')->get()->result();
        $this->response($data, RestController::HTTP_OK);
    }
    public function data_pending_get()
    {
        $data =
            $this->db->select('*')->from('tbl_jadwal')
            ->join('tbl_peserta', 'tbl_peserta.id_peserta = tbl_jadwal.id_peserta', 'left')
            ->join('tbl_instruktur', 'tbl_instruktur.id_instruktur = tbl_jadwal.id_instruktur', 'left')
            ->join('tbl_paket', 'tbl_paket.id_paket = tbl_jadwal.id_paket', 'left')
            ->where('status_bayar = 1')
            ->where('status_jadwal = 1')
            ->order_by('tbl_jadwal.id_jadwal', 'desc')->get()->result();
        $this->response($data, RestController::HTTP_OK);
    }

    public function cek_bukti_get()
    {
        $id_jadwal = $this->get('id_jadwal');
        $data = $this->db->select('*')->from('tbl_jadwal')->where('id_jadwal', $id_jadwal)->get()->row();
        $this->response($data, RestController::HTTP_OK);
    }


    public function update_jadwal_put()
    {

        $id_jadwal = $this->put('id_jadwal');

        $check_data = $this->db->get_where('tbl_jadwal', ['id_jadwal' => $id_jadwal])->row_array();

        if ($check_data) {
            $data = array(
                'status_jadwal'        => $this->put('status_jadwal'),
            );

            $update = $this->m_jadwal->update_jadwal($data, $id_jadwal);
            if ($update) {
                $this->response(array('status' => 'Berhasil', 200));
            } else {
                $this->response(array('status' => 'failed', 502));
            }
        } else {
            $this->response(array('status' => 'data not found'), 404);
        }
    }

    // update jadwal confirm instruktur
    public function update_jadwal_confirm_put()
    {

        $id_jadwal = $this->put('id_jadwal');

        $check_data = $this->db->get_where('tbl_jadwal', ['id_jadwal' => $id_jadwal])->row_array();

        if ($check_data) {
            $data = array(
                'id_user_instruktur'   => $this->put('id_user_instruktur'),
                'id_instruktur'        => $this->put('id_instruktur'),
                'status_jadwal'        => $this->put('status_jadwal'),
            );

            $update = $this->m_jadwal->update_jadwal($data, $id_jadwal);
            if ($update) {
                $this->response(array('status' => 'Berhasil', 200));
            } else {
                $this->response(array('status' => 'failed', 502));
            }
        } else {
            $this->response(array('status' => 'data not found'), 404);
        }
    }

    // detail jadwal admin
    public function detail_jadwal_get()
    {
        $id_jadwal = $this->get('id_jadwal');
        $data = 
        $this->db->select('*')->from('tbl_jadwal')
        ->join('tbl_peserta', 'tbl_peserta.id_peserta = tbl_jadwal.id_peserta', 'left')
        ->join('tbl_user', 'tbl_user.id_user = tbl_jadwal.id_user_peserta', 'left')
        ->join('tbl_instruktur', 'tbl_instruktur.id_instruktur = tbl_jadwal.id_instruktur', 'left')
        ->join('tbl_paket', 'tbl_paket.id_paket = tbl_jadwal.id_paket', 'left')
        ->where('id_jadwal', $id_jadwal)
        ->get()->row();
        $this->response($data, RestController::HTTP_OK);
    }

}
 