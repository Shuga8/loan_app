<?php

class Profiles extends Controller
{

    public function __construct()
    {
        $this->profileModel = $this->model('Profile');
    }

    public function profile()
    {

        if (isLoggedIn() == False) {
            header("Location: " . SITEURL . "/pages/index");
        }

        $data = [
            'id' => $_SESSION['customer_id'],
            'profiles' => '',
            'imageError' => ''
        ];

        $profile = $this->profileModel->getProfile($data['id']);

        $data = [
            'id' => $_SESSION['customer_id'],
            'profiles' => $profile,
            'imageError' => ''
        ];


        $this->view('Profile/profile', $data);
    }

    public function image()
    {

        if (isLoggedIn() == False) {
            header("Location: " . SITEURL . "/pages/index");
        }


        $data = [
            'id' => $_SESSION['customer_id'],
            'imageName' => '',
            'imageError' => ''
        ];


        $profile = $this->profileModel->getProfile($data['id']);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $data = [
                'id' => $_SESSION['customer_id'],
                'imageName' => '',
                'imageError' => '',
                'profiles' => $profile
            ];

            $profile = $this->profileModel->getProfile($data['id']);

            $imageName = $_FILES['file']['name'];
            $imageType = $_FILES['file']['type'];
            $tmpName = $_FILES['file']['tmp_name'];
            $imageSize = $_FILES['file']['size'];

            $imageExplode = explode('.', $imageName);
            $imageExtension = strtolower(end($imageExplode));

            $fileExtensions = ['jpeg', 'jpg', 'png'];
            $fileTypes = ['image/jpeg', 'image/jpg', 'image/png'];

            if (in_array($imageExtension, $fileExtensions)) {

                if (in_array($imageType, $fileTypes)) {

                    if ($imageSize < 1000000) {

                        //delete previous existing images
                        if (!empty($profile->customer_image)) {
                            $formerImage = '../public/profile_images/' . $profile->customer_image;

                            if (unlink($formerImage)) {

                                $time = time();

                                $newImageName = $time . $imageName;

                                $fileDestination =  '../public/profile_images/' . $newImageName;

                                if (move_uploaded_file($tmpName, $fileDestination)) {

                                    if (empty($data['imageError'])) {
                                        $data = [
                                            'id' => $_SESSION['customer_id'],
                                            'imageName' => $newImageName,
                                            'imageError' => '',
                                            'profiles' => $profile
                                        ];

                                        $insertImage = $this->profileModel->addProfileImage($data);

                                        if ($insertImage) {
                                            header("Location: " . SITEURL . "/Profiles/profile");
                                        }
                                    }
                                }
                            }
                        } else {

                            //if profile image is empty

                            $time = time();

                            $newImageName = $time . $imageName;

                            $fileDestination =  '../public/profile_images/' . $newImageName;

                            if (move_uploaded_file($tmpName, $fileDestination)) {

                                if (empty($data['imageError'])) {

                                    $data = [
                                        'id' => $_SESSION['customer_id'],
                                        'imageName' => $newImageName,
                                        'imageError' => '',
                                        'profiles' => $profile
                                    ];

                                    $insertImage = $this->profileModel->addProfileImage($data);

                                    if ($insertImage) {
                                        header("Location: " . SITEURL . "/Profiles/profile");
                                    }
                                }
                            }
                        }
                    } else {
                        $data['imageError'] = "File size is too big";
                    }
                } else {
                    $data['imageError'] = "Cannot accept this type of file check the file type";
                }
            } else {
                $data['imageError'] = "Cannot accept this type of file check the extension";
            }
        }
    }

    public function verify()
    {
        if (isLoggedIn() == False) {
            header("Location: " . SITEURL . "/pages/index");
        }


        $data = [
            'id' => $_SESSION['customer_id'],
        ];

        $profile = $this->profileModel->getProfile($data['id']);

        $data = [
            'id' => $_SESSION['customer_id'],
            'profiles' => $profile,
            'fname' => '',
            'mname' => '',
            'lname' => '',
            'uname' => '',
            'email' => '',
            'phone' => '',
            'state' => '',
            'city' => '',
            'street' => '',
            'fnameError' => '',
            'mnameError' => '',
            'lnameError' => '',
            'unameError' => '',
            'emailError' => '',
            'phoneError' => '',
            'stateError' => '',
            'cityError' => '',
            'streetError' => ''
        ];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_DEFAULT);

            $data = [
                'id' => $_SESSION['customer_id'],
                'profiles' => $profile,
                'fname' => trim($_POST['fname']),
                'mname' => trim($_POST['mname']),
                'lname' => trim($_POST['lname']),
                'uname' => trim($_POST['uname']),
                'email' => trim($_POST['email']),
                'phone' => trim($_POST['phone']),
                'state' => trim($_POST['state']),
                'city' => trim($_POST['city']),
                'street' => trim($_POST['street']),
                'fnameError' => '',
                'mnameError' => '',
                'lnameError' => '',
                'unameError' => '',
                'emailError' => '',
                'phoneError' => '',
                'stateError' => '',
                'cityError' => '',
                'streetError' => ''
            ];


            if (empty($data['fname'])) {
                $data['fnameError'] = "Please enter firstname";
            }
            if (empty($data['mname'])) {
                $data['mnameError'] = "Please enter middlename";
            }
            if (empty($data['lname'])) {
                $data['lnameError'] = "Please enter lastname";
            }
            if (empty($data['uname'])) {
                $data['unameError'] = "Please enter username";
            }
            if (empty($data['email'])) {
                $data['emailError'] = "Please enter email";
            }
            if (empty($data['phone'])) {
                $data['phoneError'] = "Please enter phone";
            }
            if (empty($data['state'])) {
                $data['stateError'] = "Please enter state";
            }
            if (empty($data['city'])) {
                $data['cityError'] = "Please enter city address";
            }
            if (empty($data['street'])) {
                $data['streetError'] = "Please enter street address";
            }

            if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                $data['emailError'] = "Invalid Email";
            }

            //check if all erros are empty
            if (empty($data['fnameError']) && empty($data['mnameError']) && empty($data['lnameError']) && empty($data['unameError']) && empty($data['emailError']) && empty($data['phoneError']) && empty($data['stateError']) && empty($data['cityError']) && empty($data['streetError'])) {

                $update = $this->profileModel->addDetails($data);

                if ($update) {
                    header("Location: " . SITEURL . "/Profiles/profile");
                }
            }
        }


        $this->view('Profile/verify', $data);
    }

    public function change_password()
    {

        if (isLoggedIn() == False) {
            header("Location: " . SITEURL . "/pages/index");
        }


        $data = [
            'id' => $_SESSION['customer_id'],
        ];


        $profile = $this->profileModel->getProfile($data['id']);

        $data = [
            'id' => $_SESSION['customer_id'],
            'profiles' => $profile,
            'pwd' => '',
            'reenter_pwd' => '',
            'reenter_pwd_again' => '',
            'pwdError' => '',
            'reenter_pwd_error' => '',
            'reenter_pwd_again_error' => ''
        ];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $_POST = filter_input_array(INPUT_POST, FILTER_DEFAULT);

            $data = [
                'id' => $_SESSION['customer_id'],
                'profiles' => $profile,
                'pwd' => trim($_POST['pwd']),
                'reenter_pwd' => trim($_POST['reenter_pwd']),
                'reenter_pwd_again' => trim($_POST['reenter_pwd_again']),
                'pwdError' => '',
                'reenter_pwd_error' => '',
                'reenter_pwd_again_error' => ''
            ];


            //check if fields are empty

            if (empty($data['pwd'])) {
                $data['pwdError'] = "Enter a new password";
            }


            if (empty($data['reenter_pwd'])) {
                $data['reenter_pwd_error'] = "Re-enter new password";
            }


            if (empty($data['reenter_pwd_again'])) {
                $data['reenter_pwd_again_error'] = "Re-enter new password again";
            }

            //check if passwords match
            if ($data['pwd'] !== $data['reenter_pwd']) {
                $data['pwdError'] = "Passwords do not match";
                $data['reenter_pwd_error'] = "Passwords do not match";
            }

            if ($data['pwd'] !== $data['reenter_pwd_again']) {
                $data['pwdError'] = "Passwords do not match";
                $data['reenter_pwd_again_error'] = "Passwords do not match";
            }

            if ($data['reenter_pwd'] !== $data['reenter_pwd_again']) {
                $data['reenter_pwd_error'] = "Passwords do not match";
                $data['reenter_pwd_again_error'] = "Passwords do not match";
            }

            if (!preg_match("/^[A-Za-z].*[0-9].*/", $data['pwd'])) {
                $data['reenter_pwd_again_error'] = "Password must start a letter and must contain upper and lower case letters and numbers";
            } elseif (strlen($data['pwd']) < 8) {
                $data['reenter_pwd_again_error'] = "Password must be at least 8 characters";
            }

            if (empty($data['pwdError']) && empty($data['reenter_pwd_error']) && empty($data['reenter_pwd_again_error'])) {

                $data = [
                    'id' => $_SESSION['customer_id'],
                    'profiles' => $profile,
                    'pwd' => trim($_POST['pwd']),
                    'reenter_pwd' => trim($_POST['reenter_pwd']),
                    'reenter_pwd_again' => trim($_POST['reenter_pwd_again']),
                    'pwdError' => '',
                    'reenter_pwd_error' => '',
                    'reenter_pwd_again_error' => ''
                ];

                $hashedPassword = password_hash($data['pwd'], PASSWORD_DEFAULT);

                $data = [
                    'id' => $_SESSION['customer_id'],
                    'profiles' => $profile,
                    'pwd' => $hashedPassword,
                    'reenter_pwd' => trim($_POST['reenter_pwd']),
                    'reenter_pwd_again' => trim($_POST['reenter_pwd_again']),
                    'pwdError' => '',
                    'reenter_pwd_error' => '',
                    'reenter_pwd_again_error' => ''
                ];

                $changePassword = $this->profileModel->changePassword($data);

                if ($changePassword) {
                    header("Location: " . SITEURL . "/Profiles/profile");
                } else {
                    $data['reenter_pwd_again_error'] = "Passwords failed to change";
                }
            }
        }

        $this->view('Profile/change', $data);
    }

    public function verifyAccount()
    {
        if (isLoggedIn() == False) {
            header("Location: " . SITEURL . "/pages/index");
        }


        $data = [
            'id' => $_SESSION['customer_id'],
            'imageName' => '',
        ];


        $profile = $this->profileModel->getProfile($data['id']);

        $data = [
            'id' => $_SESSION['customer_id'],
            'imageName' => '',
            'status' => 'Verified',
            'profiles' => $profile
        ];

        $verify = $this->profileModel->updateStatus($data);

        if ($verify) {
            header("Location: " . SITEURL . "/Profiles/profile");
        }

        $this->view('Profile/profile', $data);
    }
}