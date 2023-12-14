<?php
defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Peserta extends RestController
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_peserta');
    }

    //menampilkan all data
    public function index_get()
    {

        $id_peserta = $this->get('id_peserta');
        if ($id_peserta === null) {
            $data = $this->m_peserta->get_peserta();
            $this->response($data, RestController::HTTP_OK);
        } else {
            $data = $this->m_peserta->get_peserta($id_peserta);
            $this->response($data, RestController::HTTP_OK);
        }
    }

    // tambah data offline
    public function index_post()
    {
        $data = array(
            // 'id_user'           =>$this->post('id_user'),
            'username_peserta'  => $this->post('username_peserta'),
            'email_peserta'     => $this->post('email_peserta'),
            'TTL'               => $this->post('TTL'),
            'alamat'            => $this->post('alamat'),
            'no_telp'           => $this->post('no_telp'),
            'JK'                => $this->post('JK'),
            'image_peserta'     => $this->post('image_peserta'),
        );
        $insert = $this->db->insert('tbl_peserta', $data);
        if ($insert) {
            $this->response($data, RestController::HTTP_OK);
        } else {
            $this->response(array('status' => 'failed', 502));
        }
    }

    // tambah data offline
    public function add_online_post()
    {
        $data = array(
            'username_peserta'  => $this->post('username_peserta'),
            'id_user'           => $this->post('id_user'),
            'email_peserta'     => $this->post('email_peserta'),
            'TTL'               => $this->post('TTL'),
            'alamat'            => $this->post('alamat'),
            'no_telp'           => $this->post('no_telp'),
            'JK'                => $this->post('JK'),
            'image_peserta'     => $this->post('image_peserta'),
        );
        $insert = $this->db->insert('tbl_peserta', $data);
        if ($insert) {
            $this->response($data, RestController::HTTP_OK);
        } else {
            $this->response(array('status' => 'failed', 502));
        }
    }


    //update data tanpa gambar
    public function index_put()
    {
        $id_peserta = $this->put('id_peserta');


        $check_data = $this->db->get_where('tbl_peserta', ['id_peserta' => $id_peserta])->row_array();

        if ($check_data) {

            $data = array(
                'username_peserta'  => $this->put('username_peserta'),
                'TTL'               => $this->put('TTL'),
                'alamat'            => $this->put('alamat'),
                'no_telp'           => $this->put('no_telp'),
                'JK'                => $this->put('JK'),
                // 'image_peserta'     =>$this->put('image_peserta'),
            );

            $update = $this->m_peserta->update_peserta($data, $id_peserta);
            if ($update) {
                $this->response($data, RestController::HTTP_OK);
            } else {
                $this->response(array('status' => 'failed', 502));
            }
        } else {
            $this->response(array('status' => 'data not found'), 404);
        }
    }

    //update data tanpa gambar
    public function update_gambar_put()
    {
        $id_peserta = $this->put('id_peserta');


        $check_data = $this->db->get_where('tbl_peserta', ['id_peserta' => $id_peserta])->row_array();

        if ($check_data) {

            $data = array(
                'username_peserta'  => $this->put('username_peserta'),
                'TTL'               => $this->put('TTL'),
                'alamat'            => $this->put('alamat'),
                'no_telp'           => $this->put('no_telp'),
                'JK'                => $this->put('JK'),
                'image_peserta'     => $this->put('image_peserta'),
            );

            $update = $this->m_peserta->update_peserta($data, $id_peserta);
            if ($update) {
                $this->response($data, RestController::HTTP_OK);
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
        $id_peserta = $this->delete('id_peserta');

        $check_data = $this->db->get_where('tbl_peserta', ['id_peserta' => $id_peserta])->row_array();

        if ($check_data) {
            $this->db->where('id_peserta', $id_peserta);
            $this->db->delete('tbl_peserta');

            $this->response(array('status' => 'success'), 200);
        } else {
            $this->response(array('status' => 'data not found'), 404);
        }
    }
}
