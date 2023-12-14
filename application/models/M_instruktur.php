<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_instruktur extends CI_Model {

        public function get_instruktur($id_instruktur = null){
          if($id_instruktur === null){
               return $this->db->get('tbl_instruktur')->result_array();
          }else{
               return  $this->db->select('*')->from('tbl_instruktur')->where('id_instruktur',$id_instruktur)->order_by('id_instruktur','desc')->get()->row();
          }
        }

        public function update_instruktur($data ,$id_instruktur){
          $this->db->update('tbl_instruktur', $data,['id_instruktur' => $id_instruktur]);
          return $this->db->affected_rows();
        }
}

/* End of file ModelName.php */
