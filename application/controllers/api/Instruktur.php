<?php
defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Instruktur extends RestController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_instruktur');
    }

    //menampilkan data
    public function index_get()
    {

        $id_instruktur = $this->get('id_instruktur');
        if ($id_instruktur === null) {
            $data = $this->m_instruktur->get_instruktur();
            $this->response($data, RestController::HTTP_OK);
        } else {
            $data = $this->m_instruktur->get_instruktur($id_instruktur);
            $this->response($data, RestController::HTTP_OK);
        }
    }

    //menampilkan join data
    public function join_get()
    {
        $data = $this->db->select('*')->from('tbl_instruktur')->join('tbl_user', 'tbl_user.id_user = tbl_instruktur.id_user', 'left')->order_by('id_instruktur', 'desc')->get()->result();
        $this->response($data, RestController::HTTP_OK);
    }

    // tambah data
    public function index_post()
    {
        $data = array(
            // 'id_user'             => $this->post('id_user'),
            'username_instr'      => $this->post('username_instr'),
            'email_instr'         => $this->post('email_instr'),
            'TTL'                 => $this->post('TTL'),
            'no_telp'             => $this->post('no_telp'),
            'JK'                  => $this->post('JK'),
            'honor'               => $this->post('honor'),
            'image_instr'         => $this->post('image_instr'),
            'deskripsi_instr'     => $this->post('deskripsi_instr'),
        );
        $insert = $this->db->insert('tbl_instruktur', $data);
        if ($insert) {
            $this->response($data, RestController::HTTP_OK);
        } else {
            $this->response(array('status' => 'failed', 502));
        }
    }


    //update data
    public function index_put()
    {
        $id_instruktur = $this->put('id_instruktur');


        $check_data = $this->db->get_where('tbl_instruktur', ['id_instruktur' => $id_instruktur])->row_array();

        if ($check_data) {

            $data = array(
                'username_instr'      => $this->put('username_instr'),
                'email_instr'         => $this->put('email_instr'),
                'TTL'                 => $this->put('TTL'),
                'no_telp'             => $this->put('no_telp'),
                'JK'                  => $this->put('JK'),
                'honor'               => $this->put('honor'),
                'deskripsi_instr'     => $this->put('deskripsi_instr'),
            );

            $update = $this->m_instruktur->update_instruktur($data, $id_instruktur);
            if ($update) {
                $this->response($data, RestController::HTTP_OK);
            } else {
                $this->response(array('status' => 'failed', 502));
            }
        } else {
            $this->response(array('status' => 'data not found'), 404);
        }
    }

    //update data dgn gambar
    public function update_gambar_put()
    {
        $id_instruktur = $this->put('id_instruktur');


        $check_data = $this->db->get_where('tbl_instruktur', ['id_instruktur' => $id_instruktur])->row_array();

        if ($check_data) {

            $data = array(
                'username_instr'      => $this->put('username_instr'),
                'email_instr'         => $this->put('email_instr'),
                'TTL'                 => $this->put('TTL'),
                'no_telp'             => $this->put('no_telp'),
                'JK'                  => $this->put('JK'),
                'honor'               => $this->put('honor'),
                'image_instr'         => $this->put('image_instr'),
                'deskripsi_instr'     => $this->put('deskripsi_instr'),
            );

            $update = $this->m_instruktur->update_instruktur($data, $id_instruktur);
            if ($update) {
                $this->response($data, RestController::HTTP_OK);
            } else {
                $this->response(array('status' => 'failed', 502));
            }
        } else {
            $this->response(array('status' => 'data not found'), 404);
        }
    }


    //hapus data
    public function index_delete()
    {
        $id_instruktur = $this->delete('id_instruktur');

        $check_data = $this->db->get_where('tbl_instruktur', ['id_instruktur' => $id_instruktur])->row_array();

        if ($check_data) {
            $this->db->where('id_instruktur', $id_instruktur);
            $this->db->delete('tbl_instruktur');

            $this->response(array('status' => 'success'), 200);
        } else {
            $this->response(array('status' => 'data not found'), 404);
        }
    }
}
