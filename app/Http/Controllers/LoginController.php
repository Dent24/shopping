<?php
 
namespace App\Http\Controllers;
 
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
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
                $role = auth()->user()->roles()->first();
                return redirect()->route($role->name . '.home');
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

    public function register(RegisterRequest $request)
    {
        $role = Role::where('name', 'customer')->first();
        $role->users()->create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $attempt = auth()->attempt([
            'email' => $request->email,
            'password' => $request->password,
        ]);

        if ($attempt) {
            $role = auth()->user()->roles()->first();
            return redirect()->route($role->name . '.home');
        }

        return redirect()->route('login');
    }
}