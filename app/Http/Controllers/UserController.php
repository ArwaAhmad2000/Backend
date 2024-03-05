<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function all()
    {
        $users = User::get();
        return response()->json($users);
    }

    public function delete($id)
    {
        $users = User::destroy($id);
        return response()->json("deleted");
    }
}
