<?php


namespace App\Controller;


use App\Models\User;

class PageController extends BaseController
{


    public function actionLogin()
    {
        middleware('guest', '/profile');

        if($_POST['login']){

            $email = $_POST['email']?:null;
            $password = $_POST['password']?:null;

            if($email && $password){
                $result = User::login($email, $password);
                if($result['success']){
                    redirect('/');
                }else{
                    $_REQUEST['error']['message'] = $result['message'];
                }
            }
        }

        $this->view
            ->title('Login')
            ->layout('empty-layout')
            ->render('login');
    }

    public function actionRegistration()
    {
        middleware('guest', '/profile');

        if($_POST['registration']){

            $email = $_POST['email']?:null;
            $password = $_POST['password']?:null;
            $name = $_POST['name']?:null;

            if($email && $password && $name){
                $result = User::create($email, $password, $name);
                if($result['success']){
                    $_REQUEST['success']['message'] = $result['message'];
                }else{
                    $_REQUEST['error']['message'] = $result['message'];
                }
            }
        }

        $this->view
            ->title('Registration')
            ->layout('empty-layout')
            ->render('registration');
    }

    public function actionProfile()
    {
        middleware('auth', '/login');

        $this->updateProfileData();

        $this->uploadProfilePhoto();

        $this->changeProfilePassword();

        $user = User::get($_SESSION['user_id']);

        $this->view
            ->title('Profile')
            ->render('profile', [
                'user' => $user
            ]);
    }

    public function actionLogout()
    {
        middleware('auth', '/login');

        unset($_SESSION['user_id']);
        unset($_SESSION['logged_in']);

        redirect('/login');
    }

    public function actionError()
    {
        $this->view
            ->title('Page not found')
            ->layout('empty-layout')
            ->render('404');
    }

    public function updateProfileData()
    {
        if($_POST['update']){

            $id = $_POST['id']?:null;
            $email = $_POST['email']?:null;
            $name = $_POST['name']?:null;

            if($id && $email && $name){
                $result = User::update($id, $email, $name);
                if($result['success']){
                    $_REQUEST['success']['message'] = $result['message'];
                }else{
                    $_REQUEST['error']['message'] = $result['message'];
                }
            }else{
                $_REQUEST['error']['message'] = _("Wrong form data");
            }
        }
    }

    public function uploadProfilePhoto()
    {
        if($_POST['upload-photo']){
            $upload_file = ROOT_DIR.'storage/' . md5($_POST['id']);
            if (move_uploaded_file($_FILES['photo']['tmp_name'], $upload_file)) {
                $_REQUEST['success']['message'] = _("File uploaded");
            } else {
                $_REQUEST['error']['message'] = _("Something went wrong");
            }
        }
    }

    public function changeProfilePassword()
    {
        if($_POST['change-password']){
            $id = $_POST['id']?:null;
            $old_password = $_POST['old-password']?:null;
            $new_password = $_POST['password']?:null;

            if($id && $old_password && $new_password){
                $result = User::change_password($id, $old_password, $new_password);
                if($result['success']){
                    $_REQUEST['success']['message'] = $result['message'];
                }else{
                    $_REQUEST['error']['message'] = $result['message'];
                }
            }else{
                $_REQUEST['error']['message'] = _("Wrong form data");
            }
        }
    }
}
