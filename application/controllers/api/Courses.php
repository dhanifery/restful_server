<?php
defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Courses extends RestController
{
     public function __construct()
     {
          parent::__construct();
          $this->load->model('m_user');
     }

     public function peserta_get()
     {

          $id_user = $this->get('id_user');
          $data =
               $this->db->select('*')->from('tbl_peserta')->where('id_user', $id_user)->order_by('id_peserta', 'desc')->get()->result();
               $this->response($data, RestController::HTTP_OK);
     }

     public function instruktur_get()
     {

          $id_user = $this->get('id_user');
          $data =
               $this->db->select('*')->from('tbl_instruktur')->where('id_user', $id_user)->order_by('id_instruktur', 'desc')->get()->result();
               $this->response($data, RestController::HTTP_OK);
     }
}
