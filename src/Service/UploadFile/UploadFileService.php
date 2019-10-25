<?php


namespace App\Service\UploadFile;


use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class UploadFileService
{
    private $uploadDir;
    public function __construct(string $uploadDir)
    {
        $this->uploadDir = $uploadDir;
    }
    public function upload(UploadedFile $file): ?string
    {
        try {
            $newFileName = \md5(\uniqid($file->getClientOriginalName())).'.png';
            $file->move($this->uploadDir, $newFileName);
            return $newFileName;
        } catch (FileException $e) {
            return null;
        }
    }

    public function remove(?string $filename)
    {
        try {
            if(file_exists('your_file_name'))
                unlink($this->uploadDir.$filename);
            return true;
        } catch (FileException $e) {
            return null;
        }
    }
}