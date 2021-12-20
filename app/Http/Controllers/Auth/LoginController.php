<?php

namespace App\Http\Controllers\Auth;

use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
  public function showLoginForm(): Response
  {
    return Inertia::render('Auth/Login');   // Vue component
  }

  /**
   * @throws ValidationException
   */
  public function authenticate(Request $request): RedirectResponse
  {
    $credentials = $this->validate($request, [
      'email' => ['required', 'email'],
      'password' => ['required'],
    ]);
    if (Auth::attempt($credentials)) {
      $request->session()->regenerate();
      return redirect()->intended('/');
    }
    return back()->withErrors([
      'email' => 'The provided credentials do not match our records.',
    ]);
  }

  public function logout(Request $request)
  {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
  }
}
