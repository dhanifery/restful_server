<?php
defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Admin extends RestController
{
     public function __construct()
     {
          parent::__construct();
          $this->load->model('m_user');
     }

     //  get all data admin
     public function index_get()
     {
          $id_user = $this->get('id_user');
          if ($id_user === null) {
               $data = $this->m_user->get_admin_id_user();
               $this->response($data, RestController::HTTP_OK);
          } else {
               $data = $this->m_user->get_admin_id_user($id_user);
               $this->response($data, RestController::HTTP_OK);
          }
     }

     // tambah data
     public function index_post()
     {
          $data = array(
               // 'id_user'           =>$this->post('id_user'),
               'nama_user'         => $this->post('nama_user'),
               'email'             => $this->post('email'),
               'password'          => $this->post('password'),
               'is_active'         => $this->post('is_active'),
               'level_user'        => $this->post('level_user'),
               'date_created'      => $this->post('date_created'),
               'image'             => $this->post('image'),
          );
          $insert = $this->db->insert('tbl_user', $data);
          if ($insert) {
               $this->response($data, RestController::HTTP_OK);
          } else {
               $this->response(array('status' => 'failed', 502));
          }
     }

     //  update profil admin
     public function index_put()
     {
          $id_user = $this->put('id_user');


          $check_data = $this->db->get_where('tbl_user', ['id_user' => $id_user])->row_array();

          if ($check_data) {


               $data = array(
                    'nama_user'        => $this->put('nama_user'),
                    'is_active'        => $this->put('is_active'),
                    'level_user'        => $this->put('level_user'),
               );

               $update = $this->m_user->update_user($data, $id_user);
               if ($update) {
                    $this->response(array('status' => 'Berhasil', 200));
               } else {
                    $this->response(array('status' => 'failed', 502));
               }
          } else {
               $this->response(array('status' => 'data not found'), 404);
          }
     }
     public function update_put()
     {
          $id_user = $this->put('id_user');


          $check_data = $this->db->get_where('tbl_user', ['id_user' => $id_user])->row_array();

          if ($check_data) {


               $data = array(
                    'nama_user'        => $this->put('nama_user'),
                    'is_active'        => $this->put('is_active'),
                    'level_user'        => $this->put('level_user'),
                    'image'            => $this->put('image')
               );

               $update = $this->m_user->update_user($data, $id_user);
               if ($update) {
                    $this->response(array('status' => 'Berhasil', 200));
               } else {
                    $this->response(array('status' => 'failed', 502));
               }
          } else {
               $this->response(array('status' => 'data not found'), 404);
          }
     }

     // done
     //hapus data
     public function index_delete()
     {
          $id_user = $this->delete('id_user');

          $check_data = $this->db->get_where('tbl_user', ['id_user' => $id_user])->row_array();

          if ($check_data) {
               $this->db->where('id_user', $id_user);
               $this->db->delete('tbl_user');

               $this->response(array('status' => 'success'), 200);
          } else {
               $this->response(array('status' => 'data not found'), 404);
          }
     }
}
