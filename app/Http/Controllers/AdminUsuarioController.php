<?php

namespace App\Http\Controllers;

class AdminUsuarioController extends Controller
{
    public function index()
    {
        return view('admin.usuarios');
    }
}