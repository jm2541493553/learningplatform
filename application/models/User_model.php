<?php

class User_model extends CI_Model
{
    public function getuserslist(){
        return $this->db->get('t_user')->result();
    }

    public function get_by_email_and_pwd($username, $password)
    {
        return $this->db->get_where('t_user', array(
                'user_name' => $username,
                'password' => $password
            )
        )->row();
    }
    public function addUser($username, $password)
    {
        $this->db->insert('t_user', array(
                'user_name' => $username,
                'password' => $password,
                'user_permission'=>1
            )
        );
        return $this -> db -> affected_rows();
    }
    public function deleteUser($user_id)
    {
        $this->db->delete('t_user', array(
                'user_id' => $user_id
            )
        );
        return $this -> db -> affected_rows();
    }
}
