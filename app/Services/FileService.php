<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\UploadedFile;

class FileService
{
    public function upload(UploadedFile|array $file, User $user)
    {
        if (!is_array($file)) {
            $file = [$file];
        }

        $storedFiles = [];

        /** @var UploadedFile $f */
        foreach ($file as $f) {
            $path = $f->store('files/' . $user->id, 'local');

            $storedFiles[] = [
                'path' => $path,
                'name' => $f->getClientOriginalName(),
                'size' => $f->getSize(),
                'type' => mime_content_type($f->getRealPath()),
            ];
        }

        return $user->storedFiles()->createMany($storedFiles);
    }

    public function delete($file)
    {
        $file->delete();
    }
}
