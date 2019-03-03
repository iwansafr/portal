<?php

class Kelas
{
    // table name definition and database connection
    private $db_conn;
    private $table_name = "kelas";

    // object properties
    public $id;
    public $name;

    public function __construct($db)
    {
        $this->db_conn = $db;
    }

    // used by create.php and edit.php to select category drop-down list
    function getAll($assoc = FALSE)
    {
        //select all data
        $sql = "SELECT id, title FROM " . $this->table_name . "  ORDER BY title";

        $prep_state = $this->db_conn->prepare($sql);
        $prep_state->execute();
        $data = array();
        while ($row = $prep_state->fetch(PDO::FETCH_ASSOC)){
            $data[] = $row;
        }
        if($assoc)
        {
            $tmp_data = $data;
            $data = array();
            foreach ($tmp_data as $key => $value) 
            {
                $data[$value['id']] = $value['title'];
            }
        }
        return $data;
    }

    function tambah_kelas($data = array())
    {
        if(!empty($data) && is_array($data))
        {
            //write query
            $sql = "INSERT INTO " . $this->table_name . " SET title = ?";

            if(!empty($data['id']))
            {
                $sql = "UPDATE " . $this->table_name . " SET title = ? WHERE id = ?";
            }
            $prep_state = $this->db_conn->prepare($sql);

            $prep_state->bindParam(1, $data['title']);
            if(!empty($data['id']))
            {
                $prep_state->bindParam(2, $data['id']);
            }

            if ($prep_state->execute()) {
                return true;
            } else {
                return false;
            }
        }
    }

    // used by index.php to read category name
    function getName()
    {

        $sql = "SELECT title FROM " . $this->table_name . " WHERE id = ? limit 0,1";

        $prep_state = $this->db_conn->prepare($sql);
        $prep_state->bindParam(1, $this->id); // und somit der Platzhalter der SQL Anweisung :id durch die angegebene Variable $id ersetzt.
        $prep_state->execute();

        $row = $prep_state->fetch(PDO::FETCH_ASSOC);

        $this->name = $row['name'];
    }
    function get_kelas($id = 0)
    {
        if(!empty($id))
        {
            $sql = "SELECT * FROM " . $this->table_name . " WHERE id = ? LIMIT 1";

            $prep_state = $this->db_conn->prepare($sql);
            $prep_state->bindParam(1, $id); // und somit der Platzhalter der SQL Anweisung :id durch die angegebene Variable $id ersetzt.
            $prep_state->execute();
            // $row = $prep_state->fetch(PDO::FETCH_ASSOC);
            $data = $prep_state->fetch(PDO::FETCH_ASSOC);
            return $data;
        }
    }
    function del_kelas($id=0)
    {
        if(!empty($id))
        {
            $sql = "DELETE FROM " . $this->table_name . " WHERE id = ?";
            $prep_state = $this->db_conn->prepare($sql);
            $prep_state->bindParam(1, $id);
            if ($prep_state->execute()) {
                return true;
            } else {
                return false;
            }   
        }
    }
}

