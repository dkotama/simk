<?php 

namespace App\Http;

class Flash 
{
  public function create($title , $message, $level = info, $key = 'flash_message') 
  {
    session()->flash($key, [
      'title'   => $title,
      'message' => $message,
      'level'   => $level
    ]);
  }

  public function success($message, $title = "Success")
  {
    $this->create($title, $message, 'success');
  }

  public function error($message, $title = "Error")
  {
    $this->create($title, $message, 'error');
  } 

  public function info($message, $title = "Info")
  {
    $this->create($title, $message, 'info');
  } 

  public function overlay($title, $message, $level = 'success')
  {
    $this->create($title, $message, $level, 'flash_message_overlay');
  }
}