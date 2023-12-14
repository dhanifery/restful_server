<?php
defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Jadwal_instruktur extends RestController
{
     public function __construct()
     {
          parent::__construct();
          $this->load->model('m_jadwal');
     }

     public function jadwal_get()
     {
          $data = $this->db->select('*')
               ->from('tbl_jadwal')
               ->join('tbl_peserta', 'tbl_peserta.id_peserta = tbl_jadwal.id_peserta', 'left')
               ->join('tbl_user', 'tbl_user.id_user = tbl_jadwal.id_user_peserta', 'left')
               ->join('tbl_instruktur', 'tbl_instruktur.id_instruktur = tbl_jadwal.id_instruktur', 'left')
               ->join('tbl_paket', 'tbl_paket.id_paket = tbl_jadwal.id_paket', 'left')
               ->where('status_jadwal = 1')
               ->where('status_bayar = 1')
               ->order_by('id_jadwal', 'desc')->get()->result();
          $this->response($data, RestController::HTTP_OK);
     }

     public function jadwal_aktif_get()
     {
          $id_user = $this->get('id_user');
          $data = $this->db->select('*')
               ->from('tbl_jadwal')
               ->join('tbl_peserta', 'tbl_peserta.id_peserta = tbl_jadwal.id_peserta', 'left')
               ->join('tbl_user', 'tbl_user.id_user = tbl_jadwal.id_user_peserta', 'left')
               ->join('tbl_instruktur', 'tbl_instruktur.id_instruktur = tbl_jadwal.id_instruktur', 'left')
               ->join('tbl_paket', 'tbl_paket.id_paket = tbl_jadwal.id_paket', 'left')
               ->where('id_user_instruktur', $id_user)
               ->where('status_jadwal = 2 ')
               ->where('status_bayar = 1')
               ->order_by('id_jadwal', 'desc')->get()->result();
          $this->response($data, RestController::HTTP_OK);
     }
}

