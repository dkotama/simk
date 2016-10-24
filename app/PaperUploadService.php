<?php


namespace App;
/**
 *
 */
define('UPLOAD_FOLDER', 'uploads'); // upload folder on /public
// use Illuminate\Http\Request;
// use Illuminate\Http\UploadedFile;
// use Illuminate\Contracts\Filesystem\Filesystem;

// class PaperUploadService
// {
//   protected $uploadFolder = 'upload';
//   protected $file = NULL;
//   protected $filename = NULL;
//
//   function __construct(UploadedFile $file)
//   {
//     $this->file = $file;
//   }
//
//   public function getFilePath($title)
//   {
//     return $this->uploadFolder . '/' . $title;
//   }
//
//   public function uploadPaper()
//   {
//       try {
//         $this->filename = $this->getRandomFileName(); // renameing image
//         $this->file->move($this->uploadFolder, $fileName); // uploading file to given path
//       } catch (Exception $e) {
//         return false;
//       }
//
//       dd($filename);
//       return true;
//   }
//
//   public function getFileName()
//   {
//     return $this->filename;
//   }
//
//   public function getRandomFileName()
//   {
//     return md5(uniqid('', true) . microtime()) . $this->file->getClientOriginalExtension;
//   }
// }
