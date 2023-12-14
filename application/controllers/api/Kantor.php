<?php
defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;
use GuzzleHttp\Psr7\Query;

class Kantor extends RestController
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_kantor');
    }

    //menampilkan data
    public function index_get()
    {
        $id_kantor = $this->get('id_kantor');
        if ($id_kantor === null) {
            $data = $this->m_kantor->get_kantor();
            $this->response($data, RestController::HTTP_OK);
        } else {
            $data = $this->m_kantor->get_kantor($id_kantor);
            $this->response($data, RestController::HTTP_OK);
        }
    }

    // rows jumlah user online
    public function online_get()
    {
        $data = $this->db->select('*')->from('tbl_user')->where('is_active = 1')->get()->num_rows();

        $this->response($data, RestController::HTTP_OK);
    }

    // rows jumlah user offline
    public function offline_get()
    {
        $data = $this->db->select('*')->from('tbl_user')->where('is_active = 2')->get()->num_rows();
        $this->response($data, RestController::HTTP_OK);
    }

    // total daftar online
    public function total_online_get()
    {
        $data = $this->db->select('*')->from('tbl_peserta')->where('id_user != 0')->get()->num_rows();
        $this->response($data, RestController::HTTP_OK);
    }
    // total daftar online
    public function total_offline_get()
    {
        $data = $this->db->select('*')->from('tbl_peserta')->where(['id_user' => null])->get()->num_rows();
        $this->response($data, RestController::HTTP_OK);
    }

    // total daftar online
    public function total_user_get()
    {
        $data = $this->db->get('tbl_user')->num_rows();
        $this->response($data, RestController::HTTP_OK);
    }

    //  update data kantor tanpa gambar
    public function index_put()
    {
        $id_kantor = $this->put('id_kantor');


        $check_data = $this->db->get_where('tbl_kantor', ['id_kantor' => $id_kantor])->row_array();

        if ($check_data) {


            $data = array(
                'alamat'           => $this->put('alamat'),
                'no_telp'          => $this->put('no_telp'),
                'deskripsi'        => $this->put('deskripsi'),
            );

            $update = $this->m_kantor->update_kantor($data, $id_kantor);
            if ($update) {
                $this->response(array('status' => 'Berhasil', 200));
            } else {
                $this->response(array('status' => 'failed', 502));
            }
        } else {
            $this->response(array('status' => 'data not found'), 404);
        }
    }


    //  update data kantor dgn gambar
    public function kantor_gambar_put()
    {
        $id_kantor = $this->put('id_kantor');


        $check_data = $this->db->get_where('tbl_kantor', ['id_kantor' => $id_kantor])->row_array();

        if ($check_data) {


            $data = array(
                'alamat'           => $this->put('alamat'),
                'no_telp'          => $this->put('no_telp'),
                'deskripsi'        => $this->put('deskripsi'),
                'image'            => $this->put('image'),
            );

            $update = $this->m_kantor->update_kantor($data, $id_kantor);
            if ($update) {
                $this->response(array('status' => 'Berhasil', 200));
            } else {
                $this->response(array('status' => 'failed', 502));
            }
        } else {
            $this->response(array('status' => 'data not found'), 404);
        }
    }
}
