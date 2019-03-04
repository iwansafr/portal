<?php

class Config
{
    // table name definition and database connection
    private $db_conn;
    private $table_name = "config";


    public function __construct($db)
    {
        $this->db_conn = $db;
    }

    function get_config($name = '')
    {
        if(!empty($name))
        {
            $sql = "SELECT * FROM " . $this->table_name . " WHERE title = :title LIMIT 1";

            $prep_state = $this->db_conn->prepare($sql);
            $prep_state->bindParam(':title', $name);
            $prep_state->execute();
            $data = $prep_state->fetch(PDO::FETCH_ASSOC);
            if(!empty($data))
            {
                $data = json_decode($data['params'],1);
            }
            return $data;
        }
    }
    function save($title = '')
    {
        $status = array('status'=>FALSE,'msg'=>'title empty');
        if(!empty($_POST) && !empty($title))
        {
            $data = $_POST;
            if(!empty($data))
            {
                $data = json_encode($data);
                $current_config = $this->get_config($title);
                $status = array('status'=>FALSE,'msg'=>'data empty');
                if(!empty($current_config))
                {
                    $q = 'UPDATE '.$this->table_name.' SET params = :params WHERE title = :title';
                }else{
                    $q = 'INSERT INTO '.$this->table_name.' SET params = :params, title = :title';
                }
                $prep = $this->db_conn->prepare($q);
                $prep->bindParam(':params',$data);
                $prep->bindParam(':title',$title);
                if($prep->execute())
                {
                    $status = array('status'=>TRUE,'msg'=>'Successfull saved data '.$title);
                }else{
                    $status = array('status'=>FALSE,'msg'=>'saved data failed');
                }
            }
        }
        return $status;
    }
}

