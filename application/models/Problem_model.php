<?php
class Problem_model extends CI_Model{
    public function getproblemlist(){
        return $this->db->get('t_problem')->result();
    }
    public function addProblem($p_question,$answer1,$answer2,$answer3,$answer4,$p_correct){
        $this->db->insert('t_problem', array(
                'p_question' => $p_question,
                'p_answer1'=>$answer1,
                'p_answer2'=>$answer2,
                'p_answer3'=>$answer3,
                'p_answer4'=>$answer4,
                'p_correct'=>$p_correct
            )
        );
        return $this -> db -> affected_rows();
    }
    public function deleteProblem($problem_id)
    {
        $this->db->delete('t_problem', array(
                'p_id' => $problem_id
            )
        );
        return $this -> db -> affected_rows();
    }
}