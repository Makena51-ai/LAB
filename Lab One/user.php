<?php
include "crud.php";
include "DBConnector.php";

class User implements Crud
{
    private $user_id;
    private $first_name;
    private $last_name;
    private $city_name;
    private $conn;

    function __construct($first_name,$last_name,$city_name)
    {
        $this->firstname=$first_name;
        $this->lastName=$last_name;
        $this->city_name=$city_name;
        $this->conn=new DBConnector;
    }

    public function setUserId()
    {
        $this->user_id=$user_id;
    }

    public function getUserId()
    {
        return $this->$user_id;
    }

    public function save()
    {
        $fn=$this->first_name;
        $ln=$this->last_name;
        $city=$this->city_name;
        $sql=mysqli_query("INSERT INTO table_user(first_name,last_name,user_city VALUES ('$fn','$ln','$city')");
        if($this->conn->conn->query($sql))
        {
            return "Operation was successful";
        }
        else
        {
            echo($this->conn->conn->error);
            return null;
        }
    }

    public function readAll($conn)
    {
       
    }

    public function readUnique()
    {
        return null;
    }

    public function search()
    {
        return null;
    }

    public function update()
    {
        return null;
    }

    public function removeOne()
    {
        return null;
    }

    public function removeAll()
    {
        return null;
    }

}
