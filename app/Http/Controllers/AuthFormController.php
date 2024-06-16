<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Inertia\Inertia;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

class AuthFormController extends Controller
{
    public function form()
    {
        return Inertia::render('auth/form');
    }

    public function formLogin()
    {
        return Inertia::render('auth/login');
    }
    public function formRegister()
    {
        return Inertia::render('auth/register');
    }

    public function userlogin(Request $request)
    {
        // Проверка незаполненных полей
        if (empty($request->email) || empty($request->password)) {
            $error_code = 'empty';
            $error_text = 'Все поля должны быть заполнены.';
            return redirect()->back()->withErrors(['error' => true, 'error_code' => $error_code, 'error_text' => $error_text])->with('type', 'login')->withInput();
        }
        // Проверка формата электронной почты
        if (!filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            $error_code = 'emailIncorrect';
            $error_text = 'Указан неверный формат электронной почты.';
            return redirect()->back()->withErrors(['error' => true, 'error_code' => $error_code, 'error_text' => $error_text])->with('type', 'login')->withInput();
        }
        //Проверка на существование пользователя
        // if (!$user = User::where('email', $request->email)->first()) {
        //     $error_code = 'userNotFound';
        //     $error_text = 'Пользователь с таким email не найден.';
        //     return redirect()->back()->withErrors(['error' => true, 'error_code' => $error_code, 'error_text' => $error_text])->with('type', 'login')->withInput();
        // }

        if (!Auth::attempt(['email' => $request->email, 'password' => $request->password], true)) {
            $error_code = 'authIncorrect';
            $error_text = 'Неверный email или пароль.';
            return redirect()->back()->withErrors(['error' => true, 'error_code' => $error_code, 'error_text' => $error_text])->with('type', 'login')->withInput();
        }

        return redirect()->intended(route('profile'));
    }

    public function userregister(Request $request)
    {
        // Проверка незаполненных полей
        if (empty($request->first_name) || empty($request->last_name) || empty($request->email) || empty($request->password) || empty($request->password_confirmation)) {
            $error_code = 'empty';
            $error_text = 'Все поля должны быть заполнены.';
            return redirect()->back()->withErrors(['error' => true, 'error_code' => $error_code, 'error_text' => $error_text])->with('type', 'register')->withInput();
        }
        // Проверка формата электронной почты
        if (!filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            $error_code = 'emailIncorrect';
            $error_text = 'Указан неверный формат электронной почты';
            return redirect()->back()->withErrors(['error' => true, 'error_code' => $error_code, 'error_text' => $error_text])->with('type', 'register')->withInput();
        }
        // Проверка существующего адреса электронной почты
        if (User::where('email', $request->email)->exists()) {
            $error_code = 'emailRegister';
            $error_text = 'Данный адрес электронной почты уже используется.';
            return redirect()->back()->withErrors(['error' => true, 'error_code' => $error_code, 'error_text' => $error_text])->with('type', 'register')->withInput();
        }
        // Дополнительная проверка на совпадение паролей
        if ($request->password !== $request->password_confirmation) {
            $error_code = 'passwordIncorrect';
            $error_text = 'Пароли не совпадают.';
            return redirect()->back()->withErrors(['error' => true, 'error_code' => $error_code, 'error_text' => $error_text])->with('type', 'register')->withInput();
        }
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Авторизация с функцией "запомнить меня"
        Auth::login($user, true);

        return redirect()->intended(route('profile'));
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->intended(route('index'));
    }

}
