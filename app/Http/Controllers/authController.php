<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class authController extends Controller
{
    public function addUser(Request $request)
    {
        //$request = request()-> all();
        $allUsers = User::all();
        $user = new User;
        
        // password verification
        $passwordlength = Str::length($request['password']);   // to count email string size
        if($request['password'] == $request['password_confirmation']) {   // check if user wrote the same email
            if( ($passwordlength > 8) && ($passwordlength < 99) ){      // check if email size between 8 and 99
                $emailRep = true;   // a variable to keep and check the repetition of email (cannot entre an existing email)
                foreach($allUsers as $allUser){    // fetch data from db
                    if(($allUser->email) == $request['email']) $emailRep = false; // check if user email is in db already
                }
                if($emailRep){  // if true email is not repeted
                    // stor in db
                    $user->name = $request['name'];
                    $user->email = $request['email'];
                    $user->password = $request['password'];
                    $user->save();
                    //dd($user);
                    //dd($request['email']);
                    $idDB = DB::select('select id from users where email = ?', [$request['email']]);
                    $idDB = $idDB[0]->id;
                    $user = User::findOrFail($idDB);
                    session([
                        'user'=>$user,
                        'logStatus' => true
                    ]);
                    return redirect()->route('pages.dashboard');
                }
                else{
                    return redirect()->route('pages.signup', [
                        'error'=> 'email_exists'
                    ]);
                }
            }
            else{
                return redirect()->route('pages.signup', [
                    'error'=> 'password_length'
                ]);
            }
        }
        else{
            return redirect()->route('pages.signup', [
                'error'=> 'password_confirmation'
            ]);
        }
    }

    // --

    public function login(Request $request)
    {

        $email = $request->email;
        $password = $request->password;
        $id = DB::Table('users')->select('id')->where('email',$email)->get();
        if(isset($id->all()[0]->id)){
            $idDB = $id->all()[0]->id;
            $pwdDB = DB::Table('users')->select('password')->where('id',$idDB)->get();
            $pwdDB = $pwdDB->all()[0]->password;
            if($password == $pwdDB){
                $user = User::findOrFail($idDB);
                session([
                    'user'=>$user,
                    'logStatus' => true
                ]);
                //dd(session()->all()['user']);
                return redirect()->route('pages.dashboard');
            }
            else{
                return redirect()->route('pages.login', [
                    'error'=> 'wrong_password'
                ]);
            }
        }
        else{
            return redirect()->route('pages.login', [
                'error'=> 'wrong_email'
            ]);
        }
    }

    // --

    public function logout(Request $request)
    {
        //dd($request);
        if(isset(session()->all()['logStatus'])){
            unset(session()->all()['logStatus']);
            session([
                'logStatus' => false
            ]);
            $request->session()->flush();
            return redirect()->route('pages.login');
        }
    }

    // --

    public function forgot_password(Request $request)
    {
        $userId = DB::select('select id from users where email = ?', [$request->email]);
        if(isset($userId[0])){
            $userId = $userId[0]->id;
            $user = User::findorfail($userId);
            $userEmail = $user->email;
            $data = [
                'password' => $user->password,
                'userName' => $user->name,
                'userEmail'=> $userEmail
            ];
            //return view('pages.mail', $data);
            //dd($data);
            try {
                Mail::send('pages.mail', $data, function($message) use ($userEmail) {
                    $message->to($userEmail);
                    $message->subject('Your Password');
                });
            } catch (\Throwable $th) {
                goto here;
            }
            
            return redirect()->route('pages.forgot_password',[
                'message'=>'success_email_send',
            ]);
        }
        else
        here:
        return redirect()->route('pages.forgot_password',[
            'message'=>'wrong_email'
        ]);
    }

}
