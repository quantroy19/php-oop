<?php

namespace App\Controllers;

use App\Models\User;
use App\Models\Role;

class AuthController
{

    public function registerForm()
    {
        return view('auth.register-form', [
            'title' => 'Đăng Ký'
        ]);
        // view('auth/register-form.php', [
        //     'title' => 'Đăng Ký'
        // ]);
        // include_once './app/views/auth/register-form.php';
    }

    public function createAccount()
    {


        $checkIsset = User::where('email', '=', $_POST['email'])->first();
        if (!$checkIsset) {
            $model = new User();
            $model->fill($_POST);
            $model->password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $model->save();
            header('location: ' . BASE_URL . 'dang-nhap');
            die;
        } else {
            $_SESSION['error'] = "Email đã tồn tại";
            header('location: ' . BASE_URL . 'dang-ky');
            die;
        }
    }

    //Login
    public function loginForm()
    {
        return view('auth.login-form', [
            'title' => 'Đăng Nhập'
        ]);
    }

    public function login()
    {
        if (isset($_POST['login'])) {
            // dd($_POST);
            $user = User::where('email', $_POST['email'])->first();
            // dd($user);
            // ->andWhere(['password', '=', password_hash($_POST['password'], PASSWORD_DEFAULT)])
            if ($user && password_verify($_POST['password'], $user->password)) {


                $_SESSION['auth'] = [
                    'id' => $user->id,
                    'email' => $user->email,
                    'name' => $user->name,
                    'avatar' => $user->avatar,
                    'role_id' => $user->role_id,
                    'role_name' => $user->getRoleName(),
                ];
                if ($user->role_id == 1) {
                    header('location: ' . BASE_URL . 'dashboard');
                } else {
                    header('location: ' . BASE_URL);
                }
                die;
            } else {
                $_SESSION['error'] = 'Email hoặc mật khẩu không chính xác';
                header("location: " . BASE_URL . "dang-nhap");
                die;
            }
        }
    }
    public function logout()
    {
        session_destroy();
        header('location: ' . BASE_URL);
        die;
    }
}
