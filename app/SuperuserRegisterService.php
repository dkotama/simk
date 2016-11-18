<?php


namespace App;

use App\User;
/**
 *
 */
// use Illuminate\Http\Request;
// use Illuminate\Http\UploadedFile;
// use Illuminate\Contracts\Filesystem\Filesystem;

class SuperuserRegisterService
{
  public function create($userData, $confId)
  {
    $userData['password'] = bcrypt($userData['password']);
    $userData['activated'] = true;

    $user = User::create($userData);

    if (isset($userData['autoassign'])) {
      if (in_array('author', $userData['autoassign'])) {
        $user->authoring()->attach($confId);
      }

      if (in_array('reviewer', $userData['autoassign'])) {
        $user->reviewing()->attach($confId);
      }

      if (in_array('admin', $userData['autoassign'])) {
        $user->update(['is_admin' => true]);
      }
    }

    return $user;
    // dd('CONTOLAN');
    // return view('organizers.users.new', $this->viewData);    return
  }
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
}
