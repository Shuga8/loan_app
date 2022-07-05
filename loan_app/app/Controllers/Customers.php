<?php

class Customers extends Controller
{
    public function __construct()
    {

        $this->customerModel = $this->model('Customer');
    }

    public function login()
    {

        //data collected from logging customer in
        $data = [
            'unameEmail' => '',
            'password' => '',
            'unameEmailError' => '',
            'passwordError' => ''
        ];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            //filter postt inputed data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'unameEmail' => trim($_POST['unameEmail']),
                'password' => trim($_POST['password']),
                'unameEmailError' => '',
                'passwordError' => ''
            ];

            if (empty($data['unameEmail'])) {
                $data['unameEmailError'] = "Please enter username or email";
            }
            if (empty($data['password'])) {
                $data['passwordError'] = "Please enter password";
            }


            if (empty($data['unameEmailError']) && empty($data['passwordError'])) {
                $loggedInCustomer = $this->customerModel->login($data['unameEmail'], $data['password']);

                if ($loggedInCustomer) {
                    $this->createUserSession($loggedInCustomer);
                } else {
                    $data['unameEmailError'] = "username/email or password incorrect";
                    $data['passwordError'] = "username/email or password incorrect";

                    $this->view('customers/login', $data);
                }
            }
        } else {
            $data = [
                'unameEmail' => '',
                'password' => '',
                'unameEmailError' => '',
                'passwordError' => ''
            ];
        }



        $this->view('Customers/login', $data);
    }

    public function register()
    {

        //data collected from registering customer 
        $data = [
            'uname' => '',
            'email' => '',
            'password' => '',
            'confirmPassword' => '',
            'unameError' => '',
            'emailError' => '',
            'passwordError' => '',
            'confirmPasswordError' => ''
        ];


        //check if the request method passed is equal to POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            //filter post data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'uname' => trim($_POST['uname']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'confirmPassword' => trim($_POST['confirmPassword']),
                'unameError' => '',
                'emailError' => '',
                'passwordError' => '',
                'confirmPasswordError' => ''
            ];

            $unameValidation = "/^[A-Z].*[0-9]$/";
            $passwordValidation = "/[a-zA-0-9]/";


            //check if username is empty and use regex to validate uname
            if (empty($data['uname'])) {
                $data['unameError'] = "Please enter username";
            } elseif (!preg_match($unameValidation, $data['uname'])) {
                $data['unameError'] = "Username must start with uppercase letters and end with numbers";
            }

            //check if username already exists
            if ($this->customerModel->findUserByUsername($data['uname'])) {
                $data['unameError'] = "Username is taken";
            }

            //check if email is empty and validte on valid email using filter validate email
            if (empty($data['email'])) {
                $data['emailError'] = "Please enter email";
            } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                $data['emailError'] = "Email is invalid";
            }
            if ($this->customerModel->findUserByEmail($data['email'])) {
                $data['emailError'] = "Email is taken";
            }

            //check if password is empty
            if (empty($data['password'])) {
                $data['passwordError'] = "Please enter password";
            }

            //check if confirm password is empty
            if (empty($data['confirmPassword'])) {
                $data['confirmPasswordError'] = "Please re-enter password";
            }

            //check if passwords do not match 
            if ($data['password'] !== $data['confirmPassword']) {
                $data['passwordError'] = "Passwords do not match";
                $data['confirmPasswordError'] = "Passwords do not match";
            }

            //check if password is less than 8 characters
            if (strlen($data['confirmPassword']) <  8) {
                $data['passwordError'] = "Passwords must be at least 8 characters";
                $data['confirmPasswordError'] = "Passwords must be at least 8 characters";
            }

            if (empty($data['unameError']) && empty($data['emailError']) && empty($data['passwordError']) && empty($data['confirmPasswordError'])) {

                //hash password 
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                if ($this->customerModel->register($data)) {
                    header("Location: " . SITEURL . "/customers/login");
                } else {
                    die("Something went wrong");
                }
            }
        } else {

            $data = [
                'uname' => '',
                'email' => '',
                'password' => '',
                'confirmPassword' => '',
                'unameError' => '',
                'emailError' => '',
                'passwordError' => '',
                'confirmPasswordError' => ''
            ];
        }



        $this->view('Customers/register', $data);
    }

    public function createUserSession($customer)
    {
        $_SESSION['customer_id'] = $customer->customer_id;
        $_SESSION['customer_uname'] = $customer->customer_uname;
        $_SESSION['customer_email'] = $customer->customer_email;
        $_SESSION['status'] = $customer->customer_status;
        header("Location: " . SITEURL . "/pages/index");
    }

    public function logout()
    {
        unset($_SESSION['customer_id']);
        unset($_SESSION['customer_uname']);
        unset($_SESSION['customer_email']);

        header("Location: " . SITEURL . "/pages/index");
    }
}