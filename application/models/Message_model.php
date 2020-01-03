<?php
class Message_model extends CI_Model{
    public function getmessagelist(){
        return $this->db->get('t_message')->result();
    }
    public function addMessage($message_title,$message_content){
            $this->db->insert('t_message', array(
                    'user_id' => 1,
                    'm_title' => $message_title,
                    'm_context'=>$message_content
                )
            );
            return $this -> db -> affected_rows();
    }
}