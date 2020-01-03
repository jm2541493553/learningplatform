<?php
defined('BASEPATH') OR exit('No direct script access allowed');

header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Methods:OPTIONS, GET, POST'); // user_name允许option，get，post请求
header('Access-Control-Allow-Headers:x-requested-with'); // 允许x-requested-with请求头
class Course extends CI_Controller {
    public function getCourseList(){
        $this->load->model('course_model');
        $course_list=$this->course_model->getcourselist();
        if($course_list){
            $cls_json=array();
            foreach($course_list as $cl){
                $cls=array(
                    'course_id'=>$cl->c_id,
                    'course_name'=>$cl->c_name
                );
                $cls_json[]=$cls;
            }
            echo $this->json(0,$cls_json);
        } else {
            echo $this->json(2,"没有课程");
        }
    }
    public function addCourse(){
        $this->load->model('course_model');
       /* $json = file_get_contents("php://input");//接收前端数据
        $json_course = json_decode($json,true);//将json格式的数据编码为数组
        $course_name=$json_course['course_name'];*/
        $course_name=$this->input->post("course_name");
        if($course_name!=null){
            $add=$this->course_model->addCourse($course_name);
            if($add>0){
                echo $this->json(0,"添加成功");
            }else{
                echo $this->json(2,"添加失败");
            }
        }else{
            echo $this->json(2,"请输入课程名称");
        }
    }
    public function deleteCourse(){
        $this->load->model('course_model');
       /* $json = file_get_contents("php://input");//接收前端数据
        $json_course = json_decode($json,true);//将json格式的数据编码为数组
        $course_name=$json_course['course_name'];*/
        $course_name=$this->input->post("course_name");
        if($course_name!=null){
            $delete=$this->course_model->deleteCourse($course_name);
            if($delete>0){
                echo $this->json(0,"删除成功");
            }else{
                echo $this->json(2,"删除失败");
            }
        }else{
            echo $this->json(2,null);
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
