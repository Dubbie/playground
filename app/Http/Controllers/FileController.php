<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class FileController extends Controller
{
    public function index()
    {
        return Inertia::render('File/Index');
    }

    public function download(Request $request)
    {
        $file = $request->user()->storedFiles()->findOrFail($request->file);

        return response()->download(storage_path('app/' . $file->path), $file->name);
    }
}
