<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_peserta extends CI_Model {

        public function get_peserta($id_peserta = null){
          if($id_peserta === null){
               return $this->db->get('tbl_peserta')->result_array();
          }else{
               return  $this->db->select('*')->from('tbl_peserta')->where('id_peserta',$id_peserta)->order_by('id_peserta','desc')->get()->row();
          }
        }

        public function update_peserta($data ,$id_peserta){
          $this->db->update('tbl_peserta', $data,['id_peserta' => $id_peserta]);
          return $this->db->affected_rows();
        }
}

/* End of file ModelName.php */
