<?php
    if (! defined("BASEPATH")) exit ("No Direct script access allowed");
    class M_gejala extends CI_Model{
        private $table="gejala";

        function getDataGejala($id,$nama,$bobot){
            $query = $this->db->query("SELECT * FROM gejala where id = '$id' and nama = '$nama' and bobot = $bobot");
            return $query->result();
        }
    }
?>