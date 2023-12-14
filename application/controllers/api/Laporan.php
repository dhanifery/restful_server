<?php
defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Laporan extends RestController
{


     //menampilkan data laporan harian
     public function lap_harian_post()
     {

          $tanggal = $this->post('tanggal');
          $bulan = $this->post('bulan');
          $tahun = $this->post('tahun');
          $data = $this->db->select('*')->from('tbl_rinci_jadwal')
               ->join('tbl_jadwal', 'tbl_jadwal.kode_jadwal = tbl_rinci_jadwal.kode_jadwal', 'left')
               ->join('tbl_peserta', 'tbl_peserta.id_peserta = tbl_rinci_jadwal.id_peserta', 'left')
               ->join('tbl_paket', 'tbl_paket.id_paket = tbl_rinci_jadwal.id_paket', 'left')
               ->where('status_jadwal = 2')
               ->where('status_bayar = 1')
               ->where('DAY(tbl_jadwal.tgl_jadwal)', $tanggal)
               ->where('MONTH(tbl_jadwal.tgl_jadwal)', $bulan)
               ->where('YEAR(tbl_jadwal.tgl_jadwal)', $tahun)->get()->result();
          $this->response($data, RestController::HTTP_OK);
     }

     //menampilkan data laporan bulan
     public function lap_bulan_post()
     {

          $bulan = $this->post('bulan');
          $tahun = $this->post('tahun');
          $data = $this->db->select('*')->from('tbl_rinci_jadwal')
               ->join('tbl_jadwal', 'tbl_jadwal.kode_jadwal = tbl_rinci_jadwal.kode_jadwal', 'left')
               ->join('tbl_peserta', 'tbl_peserta.id_peserta = tbl_rinci_jadwal.id_peserta', 'left')
               ->join('tbl_paket', 'tbl_paket.id_paket = tbl_rinci_jadwal.id_paket', 'left')
               ->where('status_jadwal = 2')
               ->where('status_bayar = 1')
               ->where('MONTH(tbl_jadwal.tgl_jadwal)', $bulan)
               ->where('YEAR(tbl_jadwal.tgl_jadwal)', $tahun)->get()->result();
          $this->response($data, RestController::HTTP_OK);
     }

     //menampilkan data laporan tahun
     public function lap_tahun_post()
     {

          $tahun = $this->post('tahun');
          $data = $this->db->select('*')->from('tbl_rinci_jadwal')
               ->join('tbl_jadwal', 'tbl_jadwal.kode_jadwal = tbl_rinci_jadwal.kode_jadwal', 'left')
               ->join('tbl_peserta', 'tbl_peserta.id_peserta = tbl_rinci_jadwal.id_peserta', 'left')
               ->join('tbl_paket', 'tbl_paket.id_paket = tbl_rinci_jadwal.id_paket', 'left')
               ->where('status_jadwal = 2')
               ->where('status_bayar = 1')
               ->where('YEAR(tbl_jadwal.tgl_jadwal)', $tahun)->get()->result();
          $this->response($data, RestController::HTTP_OK);
     }
}
