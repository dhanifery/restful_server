<?php
defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Rows extends RestController
{

     //menampilkan data
     public function instr_get()
     {
          $data = $this->db->get('tbl_instruktur')->num_rows();
          $this->response($data, RestController::HTTP_OK);
     }

     //menampilkan data
     public function jadwal_get()
     {
          $data = $this->db->get('tbl_jadwal')->num_rows();
          $this->response($data, RestController::HTTP_OK);
     }

     public function peserta_get()
     {
          $data = $this->db->get('tbl_peserta')->num_rows();
          $this->response($data, RestController::HTTP_OK);
     }
}
