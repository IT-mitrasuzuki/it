<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;


use App\Http\Controllers\first;
 
class LoginController extends Controller
{
    /**
     * Handle an authentication attempt.
     */

    public function index()
    {
        return view("auth.login");
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/')->with('success','Berhasil Logout');

    }

    public function proses_login(Request $request)
    {
        // dd($request->all());
        $credentials = $request->validate([
            'username'=>'required',
            'password'=> 'required',
        ],[
            'username.required' => 'Username Wajib Diisi',
            'password.required' => 'Password Wajib Diisi',
        ]);

        // $user = User::where('email', $request->email)->first();

        // $infologin = [
        //     'username' => $request->username,
        //     'password' => $request->password,
        // ];

        // if (Auth::guard('useratt')->attempt(['username' => $request->username, 'password' => $request->password])) {
        //     return redirect('/dashboard')->with('success', 'Berhasil Login');
        // } elseif (Auth::guard('user')->attempt(['username' => $request->username, 'password' => $request->password])) {
        //     return redirect('/dashboard')->with('success', 'Berhasil Login');
        // }
        //     return redirect('/')->with('failed','Username dan Password Tidak Valid');

       if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
           return redirect('/dashboard')->with('success', 'Berhasil Login');
       }
         return redirect('/')->with('failed','Username dan Password Tidak Valid');
    

}}