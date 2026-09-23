<?php

namespace App\Http\Controllers;

class AdminLivroController extends Controller
{
    public function index()
    {
        return view('admin.livros');
    }
}