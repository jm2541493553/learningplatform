<?php
class News_model extends CI_Model
{
    public function getnewslist(){
        return $this->db->get('t_news')->result();
    }
    public function addNews($news_name,$news_contect)
    {
        $this->db->insert('t_news', array(
                'news_name' => $news_name,
                'news_contect'=>$news_contect
            )
        );
        return $this -> db -> affected_rows();
    }
    public function deleteNews($news_id)
    {
        $this->db->delete('t_news', array(
                'news_id' => $news_id
            )
        );
        return $this -> db -> affected_rows();
    }
}