<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_login extends CI_Model {

        public function proses_login($email, $password)
        {
             return $this->db->query("SELECT * FROM tbl_user WHERE email = '$email' AND password = '$password'");   
        } 

        // public function registrasi($data = null)
        // {
        //         $this->db->insert('tbl_user', $data);
        // }

        

}

/* End of file ModelName.php */
