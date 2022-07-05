<?php


class Customer
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getCustomers()
    {
        $this->db->query("SELECT * FROM customers");

        $result = $this->db->resultSet();

        return $result;
    }

    public function login($unameEmail, $password)
    {
        $this->db->query("SELECT * FROM customers WHERE customer_uname = :uname OR customer_email = :email");

        $this->db->bind(":uname", $unameEmail);
        $this->db->bind(":email", $unameEmail);

        if ($this->db->execute()) {

            if ($row = $this->db->single()) {
                $hashedPass = $row->customer_password;

                if (password_verify($password, $hashedPass)) {
                    return $row;
                } else {
                    return false;
                }
            }
        }
    }

    public function register($data)
    {
        //prepare query
        $customer_id = uniqid($data['email']);
        $this->db->query("INSERT INTO customers (customer_id, customer_uname, customer_email, customer_password) VALUES(:customer_id, :customer_uname, :customer_email, :customer_password)");

        //bind values to query
        $this->db->bind(':customer_id', $customer_id);
        $this->db->bind(':customer_uname', $data['uname']);
        $this->db->bind(':customer_email', $data['email']);
        $this->db->bind(':customer_password', $data['password']);

        //execute query
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    //find user by email, email is passed by the controller
    public function findUserByEmail($email)
    {

        //prepared statement
        $this->db->query("SELECT * FROM customers WHERE customer_email = :email");

        //Email param will be binded with the email variable
        $this->db->bind(':email', $email);

        //check if row count for the email is greater than 0
        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    //find user by username
    public function findUserByUsername($uname)
    {
        //prepared statement
        $this->db->query("SELECT * FROM customers WHERE customer_uname = :uname");

        //bind the query
        $this->db->bind(':uname', $uname);

        //check if the row count is greater than zero
        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }
}