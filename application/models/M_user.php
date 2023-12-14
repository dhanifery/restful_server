<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_user extends CI_Model {

        public function get_user($email = null){
          if($email === null){
               return $this->db->get('tbl_user')->result_array();
          }else{
               return  $this->db->select('*')->from('tbl_user')->where('email',$email)->order_by('email','desc')->get()->row();
          }
        }

        public function get_user_kursus($id_user = null){
          if($id_user=== null){
               return $this->db->get('tbl_user')->result_array();
          }else{
               return  $this->db->select('*')->from('tbl_user')->where('id_user',$id_user)->order_by('id_user','desc')->get()->row();
          }
        }

        public function get_id_user($id_user = null){
          if($id_user === null){
               return $this->db->get('tbl_user')->result_array();
          }else{
               return  $this->db->select('*')->from('tbl_user')->where('id_user',$id_user)->order_by('email','desc')->get()->row();
          }
        }


        public function get_admin_id_user($id_user = null){
          if($id_user === null){
               return  $this->db->select('*')->from('tbl_user')->where('level_user = 1')->order_by('id_user','desc')->get()->result();

          }else{
               return  $this->db->select('*')->from('tbl_user')->where('id_user',$id_user)->order_by('email','desc')->get()->row();
          }
        }

        public function update_user($data ,$id_user){
          $this->db->update('tbl_user', $data,['id_user' => $id_user]);
          return $this->db->affected_rows();
        }
}

/* End of file ModelName.php */
