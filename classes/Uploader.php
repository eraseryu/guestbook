<?php

class Uploader
{
    private $destinationPath;
    private $errorMessage;
    private $extensions;
    private $allowAll;
    private $maxSize;
    private $uploadName;
    private $seqnence;
    public $name = 'Uploader';
    public $useTable = false;

    public function setDir($path)
    {
        $this->destinationPath = $path;
        $this->allowAll = false;
    }

    public function allowAllFormats()
    {
        $this->allowAll = true;
    }

    public function setMaxSize($sizeMB)
    {
        $this->maxSize = $sizeMB * (1024*1024);
    }

    public function setExtensions($options)
    {
        $this->extensions = $options;
    }

    public function setSameFileName()
    {
        $this->sameFileName = true;
        $this->sameName = true;
    }

    public function getExtension($string)
    {
        $ext = "";
        try {
            $parts = explode(".", $string);
            $ext = strtolower($parts[count($parts) - 1]);
        } catch(Exception $c) {
            $ext = "";
        }

        return $ext;
    }

    public function setMessage($message)
    {
        $this->errorMessage = $message;
    }

    public function getMessage()
    {
        return $this->errorMessage;
    }

    public function getUploadName()
    {
        return $this->uploadName;
    }

    public function setSequence($seq)
    {
        $this->imageSeq = $seq;
    }

    public function getRandom()
    {
        return strtotime(date('Y-m-d H:i:s')) . rand(1111,9999) . rand(11,99) . rand(111,999);
    }

    public function sameName($true)
    {
        $this->sameName =   $true;
    }

    public function uploadFile($fileBrowse)
    {
        $result = false;
        $size = $_FILES[$fileBrowse]["size"];
        $name = $_FILES[$fileBrowse]["name"];
        $ext = $this->getExtension($name);

        if (!is_dir($this->destinationPath)) {
            $this->setMessage("Destination folder is not a directory.");
        } else if(!is_writable($this->destinationPath)) {
            $this->setMessage("Destination is not writable.");
        } else if(empty($name)) {
            $this->setMessage("File not selected.");
        } else if($size>$this->maxSize) {
            $this->setMessage("File is too large.");
        } else if($this->allowAll || (!$this->allowAll && in_array($ext, $this->extensions))) {

            if($this->sameName == false) {
                $this->uploadName = $this->imageSeq . "-" . substr(md5(rand(1111,9999)),0,8) . $this->getRandom() . rand(1111,1000) . rand(99,9999) . "." . $ext;
            } else{
                $this->uploadName = $name;
            }
            if (move_uploaded_file($_FILES[$fileBrowse]["tmp_name"],$this->destinationPath . $this->uploadName)) {
                $result = true;
            } else {
                $this->setMessage("Upload failed, try later.");
            }
        } else {
            $this->setMessage("Invalid file format.");
        }

        return $result;
    }

    public function deleteUploaded()
    {
        unlink($this->destinationPath.$this->uploadName);
    }
}
