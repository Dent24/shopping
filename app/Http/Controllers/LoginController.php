<?php
 
namespace App\Http\Controllers;
 
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
 
class LoginController extends Controller
{
    public function login()
    {
        $rules = [
            'email'=>'required|email',
            'password'=>'required',
        ];

        $validator = Validator::make(request()->only(['email', 'password']), $rules);

        if ($validator->passes()) {
            $attempt = auth()->attempt([
                'email' => request()->input('email'),
                'password' => request()->input('password'),
            ]);

            if ($attempt) {
                return redirect()->route('manage.home');
            }

            return response()->json('帳號或密碼錯誤', 422);
        }

        //fails
        return response()->json('帳號或密碼錯誤', 422);
    }

    public function logout() {
        auth()->logout();
        return;
    }
}