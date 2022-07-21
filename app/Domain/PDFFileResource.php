<?php

namespace App\Domain;

use App\Models\Resource\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class PDFFileResource implements ResourcesInterface
{

    public function rules(): array
    {
        return [
            'title' => 'required',
            'file' => 'sometimes|mimes:pdf|max:10000'
        ];
    }

    public function store(array $data): File
    {
        $file = $data['file'];
        $fileName = $this->uploadFile($file);

        return File::create([
            'title' => $data['title'],
            'path' => "pdf/$fileName",
            'type' => 'pdf',
        ]);
    }

    public function update(string $id, array $data): File
    {
        $file = File::findOrFail($id);
        $newFile = $data['file'];

        if(isset($newFile) && $newFile instanceof UploadedFile) {
            $fileName = $this->uploadFile($newFile);
            $this->removeFile($file);
            $file->path = "pdf/$fileName";
        }

        $file->title = $data['title'];

        $file->save();

        return $file;
    }

    public function get(string $id): File
    {
        return File::findOrFail($id);
    }

    public function delete(string $id): void
    {
        $file = File::findOrFail($id);
        $this->removeFile($file);
        $file->delete();
    }

    private function uploadFile(UploadedFile $newFile): string
    {
        $fileName = $newFile->hashName();
        Storage::disk('local')->putFileAs('pdf', $newFile, $fileName);
        return $fileName;
    }

    private function removeFile(File $file): void
    {
        $exists = Storage::exists($file->path);
        if ($exists) {
            Storage::disk('local')->delete($file->path);
        }
    }
}