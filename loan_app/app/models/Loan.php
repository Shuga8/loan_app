<?php

class Loan
{

    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }


    //get all customer loans and set their order by the date applied for the loan
    public function getAllLoans($id)
    {
        $this->db->query("SELECT * FROM loans WHERE loan_by = :customer_id");


        //bind the query
        $this->db->bind(':customer_id', $id);

        //chech if query is executed and return apporiate value

        //execute query
        if ($this->db->execute()) {
            if ($row = $this->db->resultSet()) {
                return $row;
            } else {
                return false;
            }
        }
    }

    //get all pending loan Counts
    public function pendingLoanCount($id)
    {
        $this->db->query("SELECT  FROM loans WHERE loan_by = :customer_id");


        //bind the query
        $this->db->bind(':customer_id', $id);

        //chech if query is executed and return apporiate value

        //execute query
        if ($this->db->execute()) {
            if ($row = $this->db->resultSet()) {
                return $row;
            } else {
                return false;
            }
        }
    }

    public function apply($data)
    {
        $this->db->query("INSERT INTO loans (loan_by, loan_for, loan_amount, loan_collection_date, loan_repay_date, loan_repaying_amount) VALUES(:loan_by, :for, :amount, :collection_date, :repay_date, :repaying_amount)");

        $this->db->bind(':loan_by', $data['loan_by']);
        $this->db->bind(':for', $data['loan_for']);
        $this->db->bind(':amount', $data['loan_amount']);
        $this->db->bind(':collection_date', $data['loan_collection_date']);
        $this->db->bind(':repay_date', $data['loan_repay_date']);
        $this->db->bind(':repaying_amount', $data['loan_repaying_amount']);

        //execue query

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}