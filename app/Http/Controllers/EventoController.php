<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EventoController extends Controller
{
    public function index(Request $request)
    {
        return view('Evento.index');
    }
    public function create()
    {
        return view('Evento.index');
    }
    public function store(Request $request)
    {
        return view('Evento.index');
    }
    public function show($id)
    {
        return view('Evento.index');
    }
}
