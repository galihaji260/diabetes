<?php
    defined('BASEPATH') OR exit ('No direct script access allowed');
    require APPPATH . 'libraries/REST_Controller.php';
    class Api extends REST_Controller{
        function __construct($config='rest'){
            parent::__construct($config);
            $this->load->model(array('m_user'));
        }
        
        function user_get(){
            $data = $this->m_user->getDataUser();
            $user['user'] =$data;
            $this->response($user, 200);
        }

        function userpost_put(){
            $r = array(
                'username' => $this->put('username'),
                'password' => $this->put('password')
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
    }
?>