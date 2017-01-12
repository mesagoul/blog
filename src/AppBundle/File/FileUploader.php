<?php

namespace AppBundle\File;

Class FileUploader
{
  private $filepath;
  private $fileWebPath;
  public function __construct($filepath, $fileWebPath){
    $this->filepath = $filepath;
    $this->fileWebPath = $fileWebPath;
  }
  public function upload($subject)
  {
    $file = $subject->getHeaderImage();

    $fileName = md5(uniqid()).'.'.$file->guessExtension();

    $subject->setHeaderImage(
      $this->fileWebPath.'/'.$fileName
    );
    $file->move(
      $this->filepath,
      $fileName
    );
    return $subject;
  }
}
