<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class User extends RestController {
     public function __construct()
     {
          parent::__construct();
          $this->load->model('m_user');
     }    

    //menampilkan data
    public function index_get()
    {
        $email = $this->get('email');
        if($email === null){
            $data = $this->m_user->get_user();
            $this->response($data,RestController::HTTP_OK);
        }
        else{
            $data = $this->m_user->get_user($email);
            $this->response($data,RestController::HTTP_OK);
        }
     }


    //menampilkan data by_id
    public function id_get()
    {
        $id_user = $this->get('id_user');
        if($id_user === null){
            $data = $this->m_user->get_id_user();
            $this->response($data,RestController::HTTP_OK);
        }
        else{
            $data = $this->m_user->get_id_user($id_user);
            $this->response($data,RestController::HTTP_OK);
        }
     }


     //  update profil admin
     public function index_put()
     {
        $id_user = $this->put('id_user');


        $check_data = $this->db->get_where('tbl_user',['id_user'=>$id_user])->row_array();

        if($check_data){

            
            $data = array(
                'nama_user'        =>$this->put('nama_user'),
            );

            $update = $this->m_user->update_user($data, $id_user);
            if($update){
                $this->response(array('status' => 'Berhasil', 200));
            }
            else{
                $this->response(array('status' => 'failed', 502));
            }
        }
        else{
            $this->response(array('status'=>'data not found'),404);
        }
     }
     public function update_put()
     {
        $id_user = $this->put('id_user');


        $check_data = $this->db->get_where('tbl_user',['id_user'=>$id_user])->row_array();

        if($check_data){

            
            $data = array(
                'nama_user'        =>$this->put('nama_user'),
                'image'            =>$this->put('image')
            );

            $update = $this->m_user->update_user($data, $id_user);
            if($update){
                $this->response(array('status' => 'Berhasil', 200));
            }
            else{
                $this->response(array('status' => 'failed', 502));
            }
        }
        else{
            $this->response(array('status'=>'data not found'),404);
        }
     }

    //  update password 
     public function update_pass_put()
     {
        $id_user = $this->put('id_user');


        $check_data = $this->db->get_where('tbl_user',['id_user'=>$id_user])->row_array();

        if($check_data){

            
            $data = array(
                'password'         =>$this->put('password')
            );

            $update = $this->m_user->update_user($data, $id_user);
            if($update){
                $this->response(array('status' => 'Berhasil', 200));
            }
            else{
                $this->response(array('status' => 'failed', 502));
            }
        }
        else{
            $this->response(array('status'=>'data not found'),404);
        }
     }
}

