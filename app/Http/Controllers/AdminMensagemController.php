<?php

namespace App\Http\Controllers;

class AdminMensagemController extends Controller
{
    public function index()
    {
        return view('admin.mensagens');
    }
}