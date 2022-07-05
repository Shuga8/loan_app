<?php

class Profile
{

    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getProfile($id)
    {
        //get customers from users in reference to id
        $this->db->query("SELECT * FROM customers WHERE customer_id = :id");

        //bind id to query
        $this->db->bind(':id', $id);

        //execute query
        if ($this->db->execute()) {
            if ($row = $this->db->resultSet()) {
                return $row;
            } else {
                return false;
            }
        }
    }

    public function addProfileImage($data)
    {
        //get customers from users in reference to id
        $this->db->query("UPDATE customers SET customer_image = :img WHERE customer_id = :id");

        //bind id to query
        $this->db->bind(':img', $data['imageName']);
        $this->db->bind(':id', $data['id']);

        //execute query
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function addDetails($data)
    {
        $this->db->query("UPDATE customers SET customer_firstname = :fname, customer_middlename = :mname, customer_lastname = :lname, customer_uname = :uname, customer_email = :email, customer_phone_number = :phone, customer_address_state = :states, customer_address_city = :city, customer_address_street = :street  WHERE customer_id = :id ");

        //bind values
        $this->db->bind(":fname", $data['fname']);
        $this->db->bind(":mname", $data['mname']);
        $this->db->bind(":lname", $data['lname']);
        $this->db->bind(":uname", $data['uname']);
        $this->db->bind(":email", $data['email']);
        $this->db->bind(":phone", $data['phone']);
        $this->db->bind(":states", $data['state']);
        $this->db->bind(":city", $data['city']);
        $this->db->bind(":street", $data['street']);
        $this->db->bind(":id", $data['id']);

        //execute query and return boolean values
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function updateStatus($data)
    {
        $this->db->query("UPDATE customers SET customer_status = :stats WHERE customer_id = :id");

        $this->db->bind(':stats', $data['status']);
        $this->db->bind(':id', $data['id']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function changePassword($data)
    {
        $this->db->query("UPDATE customers SET customer_password = :pwd WHERE customer_id = :id");

        $this->db->bind(':pwd', $data['pwd']);
        $this->db->bind(':id', $data['id']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}