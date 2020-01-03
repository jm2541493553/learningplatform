<?php

class Course_model extends CI_Model
{
    public function getcourselist(){
        return $this->db->get('t_course')->result();
    }
    public function addCourse($course_name)
    {
        $this->db->insert('t_course', array(
                'c_name' => $course_name
            )
        );
        return $this -> db -> affected_rows();
    }
    public function deleteCourse($course_name)
    {
        $this->db->delete('t_course', array(
                'c_name' => $course_name
            )
        );
        return $this -> db -> affected_rows();
    }
}