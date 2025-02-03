<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests; // Asegúrate de importar esto
use Illuminate\Contracts\View\View;

class UserController extends Controller
{
    use AuthorizesRequests; // Asegúrate de incluir este trait

    public function __construct()
    {
        $this->authorizeResource(User::class, 'users'); // Agrega el segundo argumento
    }

    public function index(): View
    {
        $users = User::paginate();

        return view('users.index', compact('users'));
    }
}
