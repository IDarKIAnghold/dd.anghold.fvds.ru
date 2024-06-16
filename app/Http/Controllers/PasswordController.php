<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PasswordController extends Controller
{
    public function passwordUpdate(Request $request)
    {
        if ($request->current_password == '' || $request->password == '' || $request->password_confirmation == '') {
            $error_code = 'emptyInput';
            $error_text = 'Не все Поля заполнены.';
            return redirect()->back()->withErrors(['error' => true, 'error_code' => $error_code, 'error_text' => $error_text]);
        }

        $user = Auth::user();
        if (!Hash::check($request->current_password, $user->password)) {
            $error_code = 'passwordIncorrect';
            $error_text = 'Пароль не верент.';
            return redirect()->back()->withErrors(['error' => true, 'error_code' => $error_code, 'error_text' => $error_text]);
        }

        if ($request->current_password == $request->password) {
            $error_code = 'oldPassword';
            $error_text = 'Новый пароль не должен быть схожим с старым.';
            return redirect()->back()->withErrors(['error' => true, 'error_code' => $error_code, 'error_text' => $error_text]);
        }

        if ($request->password != $request->password_confirmation) {
            $error_code = 'Passwordmismatch';
            $error_text = 'Пароли не совпадают.';
            return redirect()->back()->withErrors(['error' => true, 'error_code' => $error_code, 'error_text' => $error_text]);
        }
        $request->user()->update([
            'password' => Hash::make($request->password),
        ]);

        return back();
    }
}
