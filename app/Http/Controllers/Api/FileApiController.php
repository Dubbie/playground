<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFilesRequest;
use Illuminate\Support\Facades\Auth;

class FileApiController extends Controller
{
    public function get()
    {
        return Auth::user()->files;
    }

    public function create(StoreFilesRequest $request)
    {
        $data = $request->validated();

        // TODO: Add service call
        // $this->fileService->create($files);
        return response()->json([
            'succes' => true,
            'message' => 'ok'
        ]);
    }
}
