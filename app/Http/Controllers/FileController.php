<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Laravel\Sanctum\Sanctum;

class FileController extends Controller
{
    public function index()
    {
        return Inertia::render('File/Index');
    }
}
