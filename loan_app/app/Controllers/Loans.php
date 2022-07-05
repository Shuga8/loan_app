<?php

class Loans extends Controller
{

    public function __construct()
    {
        $this->loanModel = $this->model('Loan');
        $this->profileModel = $this->model('Profile');
    }

    public function index()
    {
        if (isLoggedIn() == False) {
            header("Location: " . SITEURL . "/pages/index");
        }

        $data = [
            'id' => $_SESSION['customer_id']
        ];

        $profile = $this->profileModel->getProfile($data['id']);
        $loans = $this->loanModel->getAllLoans($data['id']);

        $data = [
            'id' => $_SESSION['customer_id'],
            'profiles' => $profile,
            'loans' => $loans,
            'loan_for' => '',
            'loan_amount' => '',
            'loan_repay_date' => '',
            'loan_repay_amount' => 'Not Paid',
            'loanError' => ''
        ];

        $this->view('Loans/index', $data);
    }

    public function applyForLoan()
    {

        if (isLoggedIn() == False) {
            header("Location: " . SITEURL . "/pages/index");
        }

        $data = [
            'id' => $_SESSION['customer_id']
        ];

        $profile = $this->profileModel->getProfile($data['id']);
        $loans = $this->loanModel->getAllLoans($data['id']);

        $data = [
            'id' => $_SESSION['customer_id'],
            'profiles' => $profile,
            'loans' => $loans,
            'loan_for' => '',
            'loan_amount' => '',
            'loan_repay_date' => '',
            'loan_repay_amount' => 'Not Paid',
            'loanError' => ''
        ];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $_POST = filter_input_array(INPUT_POST, FILTER_DEFAULT);

            $data = [
                'id' => $_SESSION['customer_id'],
                'profiles' => $profile,
                'loans' => $loans,
                'loan_by' => $_SESSION['customer_id'],
                'loan_for' => trim($_POST['loan_for']),
                'loan_amount' => trim($_POST['loan_amount']),
                'loan_collection_date' => '',
                'loan_repay_date' => trim($_POST['loan_repayment_day']),
                'loan_repaying_amount' => '',
                'loanError' => ''
            ];

            $collectionDate = date("Y-m-d");

            $collectionDate = explode('-', $collectionDate);

            $year = $collectionDate[0];
            $month = $collectionDate[1];
            $day = $collectionDate[2];

            $newCollectionDate = date_create($year . "-" . $month . "-" . $day);

            $newCollectionDate = date_format($newCollectionDate, "Y-m-d");

            if ($data['loan_repay_date'] === "one") {
                $repayDate = "1 month";
            } elseif ($data['loan_repay_date'] === "two") {
                $repayDate = "2 months";
            } elseif ($data['loan_repay_date'] === "three") {
                $repayDate = "3 months";
            }

            $presentDay = date_create($year . "-" . $month . "-" . $day);

            $repayDate = date_add($presentDay, date_interval_create_from_date_string($repayDate));
            $repayDate = date_format($repayDate, "Y-m-d");

            $presentAmount = $data['loan_amount'];

            $presentAmount = intval($presentAmount);

            $interest1 = 0.05;
            $interest2 = 0.10;
            $interest3 = 0.15;

            if ($data['loan_repay_date'] === "one") {
                $presentAmount += $presentAmount * $interest1;
            } elseif ($data['loan_repay_date'] === "two") {
                $presentAmount += $presentAmount * $interest2;
            } elseif ($data['loan_repay_date'] === "three") {
                $presentAmount += $presentAmount * $interest3;
            }



            $data = [
                'id' => $_SESSION['customer_id'],
                'profiles' => $profile,
                'loans' => $loans,
                'loan_by' => $_SESSION['customer_id'],
                'loan_for' => trim($_POST['loan_for']),
                'loan_amount' => trim($_POST['loan_amount']),
                'loan_collection_date' => $newCollectionDate,
                'loan_repay_date' => $repayDate,
                'loan_repaying_amount' => $presentAmount,
                'loanError' => '',
            ];

            /*
            echo $data['loan_by'] . "<br>";
            echo $data['loan_for'] . "<br>";
            echo $data['loan_amount'] . "<br>";
            echo $data['loan_collection_date'] . "<br>";
            echo $data['loan_repay_date'] . "<br>";
            echo $data['loan_repaying_amount'] . "<br>";
            */
            $apply = $this->loanModel->apply($data);

            if ($apply) {
                $data['loanError'] = '<span class="green">Successfull <i class="fa-solid fa-circle-check"></i></span>';
            } else {
                $data['loanError'] = "Unsuccessfull";
            }
        }

        $this->view('Loans/index', $data);
    }
}