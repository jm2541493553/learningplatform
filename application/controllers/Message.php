<?php
defined('BASEPATH') OR exit('No direct script access allowed');

header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Methods:OPTIONS, GET, POST'); // user_name允许option，get，post请求
header('Access-Control-Allow-Headers:x-requested-with'); // 允许x-requested-with请求头
class Message extends CI_Controller{
    public function getMessageList(){
        $this->load->model('message_model');
        $message_list=$this->message_model->getmessagelist();
        if($message_list){
            $mls_json=array();
            foreach($message_list as $ml){
                $mls=array(
                    'message_id'=>$ml->m_id,
                    'message_title'=>$ml->m_title,
                    'message_context'=>$ml->m_context
                );
                $mls_json[]=$mls;
            }
            echo $this->json(0,$mls_json);
        } else {
            echo $this->json(2,"没有留言");
        }
    }
    public function addMessage(){
        $this->load->model('message_model');
        /*$json = file_get_contents("php://input");//接收前端数据
        $json_message = json_decode($json,true);//将json格式的数据编码为数组
        $message_title=$json_message['message_title'];
        $message_content=$json_message['message_content'];*/
        $message_title=$this->input->post("message_title");
        $message_content=$this->input->post("message_content");
        $add=$this->message_model->addMessage($message_title,$message_content);
        if($add>0){
            echo $this->json(0,"添加成功");
        }else{
            echo $this->json(2,"添加失败");
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