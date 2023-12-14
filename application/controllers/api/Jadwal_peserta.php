<?php
defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Jadwal_peserta extends RestController
{
     public function __construct()
     {
          parent::__construct();
          $this->load->model('m_jadwal');
     }

     public function jadwal_get()
     {
          $id_user = $this->get('id_user');
          $data = $this->db->select('*')
               ->from('tbl_jadwal')
               ->join('tbl_peserta', 'tbl_peserta.id_peserta = tbl_jadwal.id_peserta', 'left')
               ->join('tbl_user', 'tbl_user.id_user = tbl_jadwal.id_user_peserta', 'left')
               ->join('tbl_instruktur', 'tbl_instruktur.id_instruktur = tbl_jadwal.id_instruktur', 'left')
               ->join('tbl_paket', 'tbl_paket.id_paket = tbl_jadwal.id_paket', 'left')
               ->where('id_user_peserta', $id_user)
               ->where('status_jadwal = 0 ')
               ->where('status_bayar = 0')
               ->order_by('id_jadwal', 'desc')->get()->result();
          $this->response($data, RestController::HTTP_OK);
     }

     public function jadwal_pending_get()
     {
          $id_user = $this->get('id_user');
          $data = $this->db->select('*')
               ->from('tbl_jadwal')
               ->join('tbl_peserta', 'tbl_peserta.id_peserta = tbl_jadwal.id_peserta', 'left')
               ->join('tbl_user', 'tbl_user.id_user = tbl_jadwal.id_user_peserta', 'left')
               ->join('tbl_instruktur', 'tbl_instruktur.id_instruktur = tbl_jadwal.id_instruktur', 'left')
               ->join('tbl_paket', 'tbl_paket.id_paket = tbl_jadwal.id_paket', 'left')
               ->where('id_user_peserta', $id_user)
               ->where('status_jadwal = 1 ')
               ->where('status_bayar = 1')
               ->order_by('id_jadwal', 'desc')->get()->result();
          $this->response($data, RestController::HTTP_OK);
     }

     public function jadwal_bayar_get()
     {
          $id_user = $this->get('id_user');
          $data = $this->db->select('*')
               ->from('tbl_jadwal')
               ->join('tbl_peserta', 'tbl_peserta.id_peserta = tbl_jadwal.id_peserta', 'left')
               ->join('tbl_user', 'tbl_user.id_user = tbl_jadwal.id_user_peserta', 'left')
               ->join('tbl_instruktur', 'tbl_instruktur.id_instruktur = tbl_jadwal.id_instruktur', 'left')
               ->join('tbl_paket', 'tbl_paket.id_paket = tbl_jadwal.id_paket', 'left')
               ->where('id_user_peserta', $id_user)
               ->where('status_jadwal = 0 ')
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
               ->where('id_user_peserta', $id_user)
               ->where('status_jadwal = 2 ')
               ->where('status_bayar = 1')
               ->order_by('id_jadwal', 'desc')->get()->result();
          $this->response($data, RestController::HTTP_OK);
     }


     // simpan data jadwal
     public function index_post()
     {
          $data = array(
               'id_user_peserta'       => $this->post('id_user_peserta'),
               'id_peserta'            => $this->post('id_peserta'),
               'id_paket'              => $this->post('id_paket'),
               'kode_jadwal'           => $this->post('kode_jadwal'),
               'tgl_latihan'           => $this->post('tgl_latihan'),
               'jam_latihan'           => $this->post('jam_latihan'),
               'total_bayar'           => $this->post('total_bayar'),
               'status_bayar'          => $this->post('status_bayar'),
               'tgl_jadwal'            => $this->post('tgl_jadwal'),
               'status_jadwal'         => $this->post('status_jadwal'),
          );
          $insert = $this->db->insert('tbl_jadwal', $data);
          if ($insert) {
               $this->response($data, RestController::HTTP_OK);
          } else {
               $this->response(array('status' => 'failed', 502));
          }
     }

     // simpan data jadwal
     public function simpan_rinci_post()
     {
          $data = array(
               'id_peserta'            => $this->post('id_peserta'),
               'id_paket'              => $this->post('id_paket'),
               'kode_jadwal'           => $this->post('kode_jadwal'),
          );
          $insert = $this->db->insert('tbl_rinci_jadwal', $data);
          if ($insert) {
               $this->response($data, RestController::HTTP_OK);
          } else {
               $this->response(array('status' => 'failed', 502));
          }
     }

     // simpan data bayar
     public function upload_bukti_put()
     {
          $id_jadwal = $this->put('id_jadwal');
          $data = array(
               'atas_nama'            => $this->put('atas_nama'),
               'bank'                 => $this->put('bank'),
               'total_bayar'          => $this->put('total_bayar'),
               'no_rek'               => $this->put('no_rek'),
               'status_bayar'         => $this->put('status_bayar'),
               'bukti_bayar'          => $this->put('bukti_bayar'),
          );
          $insert = $this->db->where('id_jadwal',$id_jadwal)->update('tbl_jadwal', $data);
          if ($insert) {
               $this->response($data, RestController::HTTP_OK);
          } else {
               $this->response(array('status' => 'failed', 502));
          }
     }


     // jadwal bayar
     public function bayar_peserta_get()
     {
          $id_jadwal = $this->get('id_jadwal');
          $data = $this->db->select('*')->from('tbl_jadwal')->where('id_jadwal', $id_jadwal)->get()->row();
          $this->response($data, RestController::HTTP_OK);
     }

     // jadwal bayar
     public function bank_get()
     {
          $data = $this->db->select('*')->from('tbl_bank')->get()->result();
          $this->response($data, RestController::HTTP_OK);
     }
}
