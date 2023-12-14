<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_jadwal extends CI_Model {

        public function update_jadwal($data ,$id_jadwal){
          $this->db->update('tbl_jadwal', $data,['id_jadwal' => $id_jadwal]);
          return $this->db->affected_rows();
        }
}

/* End of file ModelName.php */
