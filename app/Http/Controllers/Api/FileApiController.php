<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFilesRequest;
use App\Models\StoredFile;
use App\Services\FileService;
use Illuminate\Support\Facades\Auth;

class FileApiController extends Controller
{
    private FileService $fileService;

    public function __construct(FileService $fileService)
    {
        $this->fileService = $fileService;
    }

    public function get()
    {
        return response()->json([
            'success' => true,
            'message' => 'ok',
            'data' => Auth::user()->storedFiles,
        ]);
    }

    public function create(StoreFilesRequest $request)
    {
        $data = $request->validated();

        $this->fileService->upload($data['files'], Auth::user());

        return response()->json([
            'success' => true,
            'message' => 'ok',
            'data' => Auth::user()->storedFiles,
        ]);
    }

    public function destroy(StoredFile $file)
    {
        if ($file->user_id !== Auth::id()) {
            return response()->json([
                'success' => false,
                'message' => 'unauthorized',
            ], 403);
        }

        $this->fileService->delete($file);

        return response()->json([
            'success' => true,
            'message' => 'ok',
            'data' => Auth::user()->storedFiles,
        ]);
    }
}
