<?php

class Mapel
{
    // table name definition and database connection
    private $db_conn;
    private $table_name = "mapel";

    // object properties
    public $id;
    public $name;

    public function __construct($db)
    {
        $this->db_conn = $db;
    }

    // used by create.php and edit.php to select category drop-down list
    function getAll()
    {
        //select all data
        $sql = "SELECT * FROM " . $this->table_name . "  ORDER BY id DESC";

        $prep_state = $this->db_conn->prepare($sql);
        $prep_state->execute();
        $data = array();
        while ($row = $prep_state->fetch(PDO::FETCH_ASSOC)){
            $data[] = $row;
        }
        return $data;
    }

    function get_jadwal()
    {
        $date = date('Y-m-d');
        $q = 'SELECT * FROM mapel WHERE date = ?';
        $prep_state = $this->db_conn->prepare($q);
        $prep_state->bindParam(1, $date);
        $prep_state->execute();

        $data = array();
        while ($row = $prep_state->fetch(PDO::FETCH_ASSOC)){
            $data[] = $row;
        }
        return $data;
    }

    function tambah_mapel($data = array())
    {
        if(!empty($data) && is_array($data))
        {
            //write query
            $sql = "INSERT INTO " . $this->table_name . " SET kelas_id = ?, title = ?, kode = ?, link = ?, date = ?, start = ?, end = ?, status = ?, color = ? ";

            if(!empty($data['id']))
            {
                $sql = "UPDATE " . $this->table_name . " SET kelas_id = ?, title = ?, kode = ?, link = ?, date = ?, start = ?, end = ?, status = ?, color = ? WHERE id = ?";
            }
            $prep_state = $this->db_conn->prepare($sql);
            $prep_state->bindParam(1, $data['kelas_id']);
            $prep_state->bindParam(2, $data['title']);
            $prep_state->bindParam(3, $data['kode']);
            $prep_state->bindParam(4, $data['link']);
            $prep_state->bindParam(5, $data['date']);
            $prep_state->bindParam(6, $data['start']);
            $prep_state->bindParam(7, $data['end']);
            $prep_state->bindParam(8, $data['status']);
            $prep_state->bindParam(9, $data['color']);
            if(!empty($data['id']))
            {
                $prep_state->bindParam(10, $data['id']);
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
    function get_mapel($id = 0)
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
    function del_mapel($id=0)
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

