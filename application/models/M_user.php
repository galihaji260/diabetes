<?php
    if (! defined("BASEPATH")) exit ("No Direct script access allowed");
    class M_user extends CI_Model{
        private $table="user";

        function getDataUser($email,$password){
            $query = $this->db->query("SELECT * FROM user where email = '$email' and password = '$password'");
            return $query->result();
        }
        function insertUser($data){
            return $this->db->insert($this->table,$data);
        }

        function updateUser($id,$data){
            $this->db->where('id', $id);
            return $this->db->update($this->table, $data);
        }

        function deleteUser($id){

            $this->db->where('id', $id);
            $query = $this->db->delete($this->table);
            
            if($this->db->affected_rows() == '1'){
                return true;
            }else{
                return false;
            }
        }

    }
?>