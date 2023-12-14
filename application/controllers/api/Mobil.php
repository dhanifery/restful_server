<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Mobil extends RestController {

    public function __construct()
    {
         parent::__construct();
         $this->load->model('m_mobil');
    }

    //menampilkan data
    public function index_get()
    {
        $id_mobil = $this->get('id_mobil');
        if($id_mobil === null){
            $data = $this->m_mobil->get_data_mobil();
            $this->response($data,RestController::HTTP_OK);
        }
        else{
            $data = $this->m_mobil->get_data_mobil($id_mobil);
            $this->response($data,RestController::HTTP_OK);
        }
    }

    //tambah data
    public function index_post()
    {
        $data = array(
            'nama_mobil'        =>$this->post('nama_mobil'),
            'jenis_mobil'       =>$this->post('jenis_mobil'),
            'no_plat'           =>$this->post('no_plat'),
            'no_mesin'          =>$this->post('no_mesin'),
            'deskripsi_mobil'   =>$this->post('deskripsi_mobil'),
            'image_mobil'       =>$this->post('image_mobil'),
        );
        $insert = $this->db->insert('tbl_mobil', $data);
        if($insert){
            $this->response($data,RestController::HTTP_OK);
        }
        else{
            $this->response(array('status' => 'failed', 502));
        }
    }


    //update data
    public function index_put()
    {
        $id_mobil = $this->put('id_mobil');


        $check_data = $this->db->get_where('tbl_mobil',['id_mobil'=>$id_mobil])->row_array();

        if($check_data){
            
            $data = array(
                'nama_mobil'        =>$this->put('nama_mobil'),
                'jenis_mobil'       =>$this->put('jenis_mobil'),
                'no_plat'           =>$this->put('no_plat'),
                'no_mesin'          =>$this->put('no_mesin'),
                'deskripsi_mobil'   =>$this->put('deskripsi_mobil'),
            );

            $update = $this->m_mobil->update_mobil($data, $id_mobil);

            if($update){
                $this->response($data,RestController::HTTP_OK);
            }
            else{
                $this->response(array('status' => 'failed', 502));
            }
        }
        else{
            $this->response(array('status'=>'data not found'),404);
        }

    }
       //update data
       public function update_gambar_put()
       {
           $id_mobil = $this->put('id_mobil');
   
   
           $check_data = $this->db->get_where('tbl_mobil',['id_mobil'=>$id_mobil])->row_array();
   
           if($check_data){
               
               $data = array(
                   'nama_mobil'        =>$this->put('nama_mobil'),
                   'jenis_mobil'       =>$this->put('jenis_mobil'),
                   'no_plat'           =>$this->put('no_plat'),
                   'no_mesin'          =>$this->put('no_mesin'),
                   'deskripsi_mobil'   =>$this->put('deskripsi_mobil'),
                   'image_mobil'   =>$this->put('image_mobil'),
               );
   
               $update = $this->m_mobil->update_mobil($data, $id_mobil);
   
               if($update){
                   $this->response($data,RestController::HTTP_OK);
               }
               else{
                   $this->response(array('status' => 'failed', 502));
               }
           }
           else{
               $this->response(array('status'=>'data not found'),404);
           }
   
       }


    //hapus data
    public function index_delete()
    {
        $id_mobil = $this->delete('id_mobil');

        $check_data = $this->db->get_where('tbl_mobil',['id_mobil'=>$id_mobil])->row_array();

        if($check_data){
            $this->db->where('id_mobil',$id_mobil);
            $this->db->delete('tbl_mobil');

            $this->response(array('status'=>'success'),200);
        }
        else{
            $this->response(array('status'=>'data not found'),404);
        }

    }
}