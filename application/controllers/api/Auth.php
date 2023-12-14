<?php
defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Auth extends RestController
{
     public function __construct()
     {
          parent::__construct();
          $this->load->model('m_login');
     }

     // lagin akun
     public function index_post()
     {
          if ($_SERVER["REQUEST_METHOD"] == "POST") {
               if (isset($_POST['email']) && isset($_POST['password'])) {
                    $user_login = $this->m_login->proses_login($_POST['email'], $_POST['password']);
                    $result['email'] = null;
                    $result['level_user'] = null;
                    $result['nama_user'] = null;
                    $result['is_active'] = null;
                    $result['id_user'] = null;

                    if ($user_login->num_rows() == 1) {
                         $result['value'] = "1";
                         $result['pesan'] = "Login Berhasil!";
                         $result['email'] = $user_login->row()->email;
                         $result['level_user'] = $user_login->row()->level_user;
                         $result['nama_user'] = $user_login->row()->nama_user;
                         $result['is_active'] = $user_login->row()->is_active;
                         $result['id_user'] = $user_login->row()->id_user;
                    } else {
                         $result['value'] = '0';
                         $result['pesan'] = 'Username/password salah!';
                    }
               } else {
                    $result['value'] = '0';
                    $result['pesan'] = 'input kosong!';
               }
          } else {
               $result['value'] = '0';
               $result['pesan'] = 'Invalid request method!';
          }

          echo json_encode($result);
     }

     // registrasi akun
     public function regis_post(){
          $data = array(
               'nama_user' => $this->input->post('nama_user'),
               'email' => $this->input->post('email'),
               'image' => 'default.jpg',
               'password' => $this->input->post('password'),
               'level_user' => '2',
               'is_active' => '1',
               'date_created' =>time()
           );
           $insert = $this->db->insert('tbl_user', $data);
           if($insert){
               $this->response($data,RestController::HTTP_OK);
           }
           else{
               $this->response(array('status' => 'failed', 502));
           }
     }
}
