<?php
defined('BASEPATH') OR exit ('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';
class Api extends REST_Controller{
    function __construct($config='rest'){
        parent::__construct($config);
        $this->load->model(array('m_user'));
        $this->load->model(array('m_gejala'));
    }

    function user_put(){
        $email = $this->put('email');
        $password = $this->put('password');
        $data = $this->m_user->getDataUser($email,$password);
        if($data){
            $this->response(array('status'=>'success', 'response'=>200));
        }else{
            $this->response(array('status' => 'fail','response'=> 502));
        }
    }

    function userpost_put(){
        $r = array(
            'email' => $this->put('email'),
            'password' => $this->put('password'),
            'nama' => $this->put('nama'),
            'umur' => $this->put('umur')

        );

        $data = $this->m_user->insertUser($r);

        if($data){
            $this->response(array('status'=>'success', 'response'=>200));
        }else{
            $this->response(array('status' => 'fail','response'=> 502));
        }

    }

    function updateuser_post() {
            //mengambil ID yang dikirim melalui method post
        $id = $this->post('id');
            //mengambil data yang dikirim melalui method post
        $data = array(
            'username' => $this->post('username'),
            'password' => $this->post('password')
        );
            //proses update data ke dalam database

        $update = $this->m_user->updateUser($id,$data);
            //pengecekan apakah proses update berhasil atau tidak
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    function userdelete_delete($id) {
            //mengambil data ID yang dikirim melalui method post
            //proses delete data dari database
        $delete = $this->m_user->deleteUser($id);
            //pengecekan apakah proses delete berhasil atau tidak
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    function gejala_put(){
        $nama = $this->put('nama');
        $bobot = $this->put('bobot');
        $id = $this->put('id');
        $data = $this->m_gejala->getDataUser($id,$nama,$bobot);
        if($data){
            $this->response(array('status'=>'success', 'response'=>200));
        }else{
            $this->response(array('status' => 'fail','response'=> 502));
        }
    }
}
?>