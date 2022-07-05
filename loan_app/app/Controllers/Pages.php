<?php

class Pages extends Controller {
    public function __construct()
    {
        $this->customerModel = $this->model('Customer');
    }

    public function index() {
        $customers = $this->customerModel->getCustomers();

        $data = [
            'title' => 'Home Page',
            'customers' => $customers
        ];
        $this->view('Pages/index', $data);
    }

    public function contact() {
        $this->view('Pages/contact');
    }


}