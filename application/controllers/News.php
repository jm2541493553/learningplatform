<?php
defined('BASEPATH') OR exit('No direct script access allowed');

header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Methods:OPTIONS, GET, POST'); // user_name允许option，get，post请求
header('Access-Control-Allow-Headers:x-requested-with'); // 允许x-requested-with请求头
class News extends CI_Controller {
    public function getNewsList(){
        $this->load->model('news_model');
        $news_list=$this->news_model->getnewslist();
        if($news_list){
            $nls_json=array();
            foreach($news_list as $nl){
                $nls=array(
                    'news_id'=>$nl->news_id,
                    'news_name'=>$nl->news_name,
                    'news_contect'=>$nl->news_contect,
                    'news_time'=>$nl->news_time
                );
                $nls_json[]=$nls;
            }
            echo $this->json(0,$nls_json);
        } else {
            echo $this->json(2,"没有资讯");
        }
    }
    public function addNews(){
        $this->load->model('news_model');
     /*   $json = file_get_contents("php://input");//接收前端数据
         $json_news = json_decode($json,true);//将json格式的数据编码为数组
         $news_name=$json_news['news_name'];
         $news_contect=$json_news['news_contect'];*/
        $news_name=$this->input->post("news_title");
        $news_contect=$this->input->post("news_contect");
            $add=$this->news_model->addNews($news_name,$news_contect);
            if($add>0){
                echo $this->json(0,"添加成功");
            }else{
                echo $this->json(2,"添加失败");
            }
    }
    public function deleteNews(){
        $this->load->model('news_model');
        /*$json = file_get_contents("php://input");//接收前端数据
        $json_news = json_decode($json,true);//将json格式的数据编码为数组
        $news_name=$json_news['news_name'];*/
        $news_id=$this->input->post("news_id");
            $delete=$this->news_model->deleteNews($news_id);
            if($delete>0){
                echo $this->json(0,"删除成功");
            }else{
                echo $this->json(2,"删除失败");
            }
    }
    public function UploadFile(){
        $config['upload_path']= 'application/uploads/';//设置上传路径
        $config['allowed_types']= 'gif|jpg|png|jpeg'; //设置图片类型
        $config['file_name'] = date('YmdHis').rand(1000,9999);//配置图片名称


        $this->load->library('upload', $config);//加载ci自带的图片上传插件
        // print_r($this->upload->data());//打印上传信息
        if (!$this->upload->do_upload('file_name'))//上传文件
            {
            $this->return['status'] = 'fail';
            $this->return['msg'] = $this->upload->display_errors();//显示错误信息
            $this->result();
            }else{
            $data = $this->upload->data();//获取上传信息
            $path = base_url('application/uploads/').$data['file_name'];//拼接出文件路径
            echo $path;
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