<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Inertia\Response;

class IndexController extends Controller
{
  public function index(): Response
  {
    $users = User::all();

    return Inertia::render('index', [
      'users' => $users,
    ]);
  }
}