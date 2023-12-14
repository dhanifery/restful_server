<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_kantor extends CI_Model {

        public function get_kantor($id_kantor = null){
          if($id_kantor === null){
               return $this->db->get('tbl_kantor')->result_array();
          }else{
               return  $this->db->select('*')->from('tbl_kantor')->where('id_kantor',$id_kantor)->order_by('id_kantor','desc')->get()->row();
          }
        }

        public function update_kantor($data ,$id_kantor){
          $this->db->update('tbl_kantor', $data,['id_kantor' => $id_kantor]);
          return $this->db->affected_rows();
        }
}

/* End of file ModelName.php */
