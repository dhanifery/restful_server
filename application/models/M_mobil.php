<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_mobil extends CI_Model {

        public function get_data_mobil($id_mobil = null){
          if($id_mobil === null){
               return $this->db->get('tbl_mobil')->result_array();
          }else{
               return  $this->db->select('*')->from('tbl_mobil')->where('id_mobil',$id_mobil)->get()->row();
          }
        }
        public function update_mobil($data ,$id_mobil){
          $this->db->update('tbl_mobil', $data,['id_mobil' => $id_mobil]);
          return $this->db->affected_rows();
        }
}

/* End of file ModelName.php */
