<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class pagesController extends Controller
{
    //dashboard action
    public function dashboard()
    {
        if(isset(session()->all()['logStatus']) && session()->all()['logStatus'] == true ){
            return view('pages.dashboard',[
                'page_name' => 'Dashboard'
            ]);
        }
        else{
            return redirect()->route('pages.login');
        }
    }
    //signup action
    public function signup()
    {
        if(isset(session()->all()['logStatus']) && session()->all()['logStatus'] == true){
            return redirect()->route('pages.dashboard');
        }
        $error = null;
        if(isset($_GET['error'])){
            $getError = $_GET['error'];
            switch ($getError) {
                case 'email_exists':
                    $error = "This email is already used!";
                    break;
                case 'password_length':
                    $error = "Password length must be between 8 and 100!";
                    break;
                case 'password_confirmation':
                    $error = "Confirm password does not match!";
                    break;
                default:
                    $error = "Something went wrong, please try again!";
                    break;
            }
        }
        return view('pages.signup',[
            'page_name' => 'Signup',
            'error' => $error
        ]);
    }
    //login action
    public function login()
    {
        if(isset(session()->all()['logStatus']) && session()->all()['logStatus'] == true){
            return redirect()->route('pages.dashboard');
        }
        $error = null;
        if(isset($_GET['error'])){
            $getError = $_GET['error'];
            switch ($getError) {
                case 'wrong_password':
                    $error = "Wrong password!";
                    break;
                case 'wrong_email':
                    $error = "Wrong email!";
                    break;
                case 'session_expired':
                    $error = "Session expired please login again!";
                    break;
                default:
                    $error = "Something went wrong, please try again!";
                    break;
            }
        }
        return view('pages.login',[
            'page_name' => 'Login',
            'error' => $error
        ]);
    }
    //forgot_password action
    public function forgot_password()
    {
        if(isset(session()->all()['logStatus']) && session()->all()['logStatus'] == true){
            return redirect()->route('pages.dashboard');
        }
        $dbRespons = null;
        $colorClass = 'red';
        if(isset($_GET['message'])){
            $getFromGet = $_GET['message'];
            switch ($getFromGet) {
                case 'success_email_send':
                    $dbRespons = 'The password has been sent to your email address';
                    $colorClass = 'green';
                    break;
                // -
                case 'wrong_email':
                    $dbRespons = 'Email not found';
                    $colorClass = 'red';
                    break;
                default:
                    $dbRespons = "Something went wrong, please try again!";
                    break;
            }
        }
        return view('pages.forgot-password',[
            'page_name' => 'forgot password',
            'dbRespons' => $dbRespons,
            'colorClass' => $colorClass
        ]);
    }
}
