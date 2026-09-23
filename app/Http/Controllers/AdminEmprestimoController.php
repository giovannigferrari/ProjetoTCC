<?php

namespace App\Http\Controllers;

class AdminEmprestimoController extends Controller
{
    public function index()
    {
        return view('admin.emprestimos');
    }
}