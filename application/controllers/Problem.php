<?php
defined('BASEPATH') OR exit('No direct script access allowed');

header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Methods:OPTIONS, GET, POST'); // user_name允许option，get，post请求
header('Access-Control-Allow-Headers:x-requested-with'); // 允许x-requested-with请求头
class Problem extends CI_Controller{
    public function getProblemList(){
        $this->load->model('problem_model');
        $problem_list=$this->problem_model->getproblemlist();
        if($problem_list){
            $cls_json=array();
            foreach($problem_list as $cl){
                $cls=array(
                    'p_id'=>$cl->p_id,
                    'p_question'=>$cl->p_question,
                    'p_answer1'=>$cl->p_answer1,
                    'p_answer2'=>$cl->p_answer2,
                    'p_answer3'=>$cl->p_answer3,
                    'p_answer4'=>$cl->p_answer4,
                    'p_correct'=>$cl->p_correct
                );
                $cls_json[]=$cls;
            }
            echo $this->json(0,$cls_json);
        } else {
            echo $this->json(2,"没有课程");
        }
    }
    public function deleteProblem(){
        $this->load->model('problem_model');
        /* $json = file_get_contents("php://input");//接收前端数据
         $json_course = json_decode($json,true);//将json格式的数据编码为数组
        $problem_id=$json_course['problem_id'];*/
        $problem_id=$this->input->post("problem_id");
            $delete=$this->problem_model->deleteProblem($problem_id);
            if($delete>0){
                echo $this->json(0,"删除成功");
            }else{
                echo $this->json(2,"删除失败");
            }

    }
    public function addProblem(){
        $this->load->model('problem_model');
        /*$json = file_get_contents("php://input");//接收前端数据
        $json_problem = json_decode($json,true);//将json格式的数据编码为数组
        $p_question=$json_problem['p_question'];
        $answer1=$json_problem['answer1'];
        $answer2=$json_problem['answer2'];
        $answer3=$json_problem['answer3'];
        $answer4=$json_problem['answer4'];
        $p_correct=$json_problem['p_correct'];*/
        $p_question=$this->input->post("p_question");
        $answer1=$this->input->post("answer1");
        $answer2=$this->input->post("answer2");
        $answer3=$this->input->post("answer3");
        $answer4=$this->input->post("answer4");
        $p_correct=$this->input->post("p_correct");
        $add=$this->problem_model->addProblem($p_question,$answer1,$answer2,$answer3,$answer4,$p_correct);
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