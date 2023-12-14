<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_paket extends CI_Model {

        public function get_data_paket($id_paket = null){
          if($id_paket === null){
               return $this->db->get('tbl_paket')->result_array();
          }else{
               return  $this->db->select('*')->from('tbl_paket')->join('tbl_mobil', 'tbl_mobil.id_mobil = tbl_paket.id_mobil', 'left')->where('id_paket',$id_paket)->get()->row();
          }
        }

        public function update_paket($data ,$id_paket){
          $this->db->update('tbl_paket', $data,['id_paket' => $id_paket]);
          return $this->db->affected_rows();
        }
}

/* End of file ModelName.php */
