<?php
defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Paket extends RestController
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_paket');
    }

    //menampilkan data
    public function index_get()
    {
        $id_paket = $this->get('id_paket');
        if ($id_paket === null) {
            $data = $this->m_paket->get_data_paket();
            $this->response($data, RestController::HTTP_OK);
        } else {
            $data = $this->m_paket->get_data_paket($id_paket);
            $this->response($data, RestController::HTTP_OK);
        }
    }


    //menampilkan join data
    public function join_get()
    {
        $data = $this->db->select('*')->from('tbl_paket')->join('tbl_mobil', 'tbl_mobil.id_mobil = tbl_paket.id_mobil', 'left')->order_by('tbl_paket.id_mobil', 'desc')->get()->result();
        $this->response($data, RestController::HTTP_OK);
    }

    // tambah data
    public function index_post()
    {
        $data = array(
            'id_mobil'          => $this->post('id_mobil'),
            'nama_paket'        => $this->post('nama_paket'),
            'byk_pertemuan'     => $this->post('byk_pertemuan'),
            'harga'             => $this->post('harga'),
            'deskripsi_paket'   => $this->post('deskripsi_paket'),
            'image'             => $this->post('image'),
        );
        $insert = $this->db->insert('tbl_paket', $data);
        if ($insert) {
            $this->response($data, RestController::HTTP_OK);
        } else {
            $this->response(array('status' => 'failed', 502));
        }
    }


    //update data
    public function index_put()
    {
        $id_paket = $this->put('id_paket');


        $check_data = $this->db->get_where('tbl_paket', ['id_paket' => $id_paket])->row_array();

        if ($check_data) {

            $data = array(
                'id_mobil'          => $this->put('id_mobil'),
                'nama_paket'        => $this->put('nama_paket'),
                'byk_pertemuan'     => $this->put('byk_pertemuan'),
                'harga'             => $this->put('harga'),
                'deskripsi_paket'   => $this->put('deskripsi_paket'),
            );

            $update = $this->m_paket->update_paket($data, $id_paket);
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
    //update data
    public function update_gambar_put()
    {
        $id_paket = $this->put('id_paket');


        $check_data = $this->db->get_where('tbl_paket', ['id_paket' => $id_paket])->row_array();

        if ($check_data) {

            $data = array(
                'id_mobil'          => $this->put('id_mobil'),
                'nama_paket'        => $this->put('nama_paket'),
                'byk_pertemuan'     => $this->put('byk_pertemuan'),
                'harga'             => $this->put('harga'),
                'deskripsi_paket'   => $this->put('deskripsi_paket'),
                'image'   => $this->put('image'),
            );

            $update = $this->m_paket->update_paket($data, $id_paket);
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
        $id_paket = $this->delete('id_paket');

        $check_data = $this->db->get_where('tbl_paket', ['id_paket' => $id_paket])->row_array();

        if ($check_data) {
            $this->db->where('id_paket', $id_paket);
            $this->db->delete('tbl_paket');

            $this->response(array('status' => 'success'), 200);
        } else {
            $this->response(array('status' => 'data not found'), 404);
        }
    }
}
