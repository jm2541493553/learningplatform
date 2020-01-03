<?php
defined('BASEPATH') OR exit('No direct script access allowed');

header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Methods:OPTIONS, GET, POST'); // user_name允许option，get，post请求
header('Access-Control-Allow-Headers:x-requested-with'); // 允许x-requested-with请求头
class User extends CI_Controller {
    public function getUserList()
    {
        $this->load->model('user_model');
        $user_list = $this->user_model->getuserslist();
        if ($user_list) {
        $nls_json = array();
        foreach ($user_list as $nl) {
            $nls = array(
                'user_id'=>$nl->user_id,
                'username'=>$nl->user_name,
                'password'=>$nl->password,
                'user_permission'=>$nl->user_permission
            );
            $nls_json[] = $nls;
        }
        echo $this->json(0, $nls_json);
    } else {
        echo $this->json(2, "没有资讯");
    }
    }
    //登陆时检查用户和密码
	public function login(){
        $this->load->model('user_model');
        /*$json = file_get_contents("php://input");//接收前端数据
        $json_user = json_decode($json,true);//将json格式的数据编码为数组
        $username=$json_user['username'];
        $password=$json_user['password'];*/
        $username=$this->input->post("username");
        $password=$this->input->post("password");
        $user = $this->user_model->get_by_email_and_pwd($username,$password);
        if ($user) {
                    $user_id=$user->user_id;
                    $user_permission=$user->user_permission;
                    $result = array(
                        'user_id'=>$user_id,
                        'user_permission'=>$user_permission
                    );
                    $json_res = $this->json(0, $result);
                    echo $json_res;
                }else{
                    $fail = $this->json(2, null);
                    echo $fail;
                }

	}
	//添加用户
	public function addUser(){
        $this->load->model('user_model');
        /*$json = file_get_contents("php://input");//接收前端数据
        $json_user = json_decode($json,true);//将json格式的数据编码为数组
        $user_permission=$json_user['user_permission'];
        $username=$json_user['username'];
        $password=$json_user['password'];*/
        $username=$this->input->post("username");
        $password=$this->input->post("password");
            $add=$this->user_model->addUser($username,$password);
            if($add>0){
                echo $this->json(0,"添加成功");
            }else{
                echo $this->json(2,"添加失败");
            }

    }
    //删除用户
    public function deleteUser(){
        $this->load->model('user_model');
        /*$json = file_get_contents("php://input");//接收前端数据
        $json_user = json_decode($json,true);//将json格式的数据编码为数组
        $user_permission=$json_user['user_permission'];
        $username=$json_user['username'];*/
        $user_id=$this->input->post("user_id");
            $delete=$this->user_model->deleteUser($user_id);
            if($delete>0){
                echo $this->json(0,"删除成功");
            }else{
                echo $this->json(2,"删除失败");
            }
    }
    function json($code, $data=array())//json返回方法
    {
        $result = array(
            'code'=>$code,
            'data'=>$data
        );
        return json_encode($result, JSON_UNESCAPED_UNICODE);
        exit;
    }
}
