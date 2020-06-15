<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Explorer extends Controller
{
    private $url;
    private $fileName;
    private $fileNames;
    private $ext;
    public $files;

    public function __construct($dni, $ext="*", $dir='upload', $options= array())
    {
        if(empty($dni)){
            throw new Exception("Requiero un dni para trabajar", 1);
        }
        $this->fileName = $dni;
        $this->fileNames = array();
        $this->ext = $ext;
        $this->validDir($dir);

        if(!empty($options)){
            if(array_key_exists('fecha', $options)){
                $this->fileName .= "_".$options['fecha'];
            }
        }
        $this->generateFileName($ext);
        $this->getFiles();
    }
    private function validDir($dir)
    {

        if(strcasecmp($dir,'upload') !== false){
            $this->url = public_path()."/upload";
            if(!file_exists($this->url)){
                throw new Exception("No se puede acceder a la ruta dada", 1);
            }
        }
        else{
            if(!file_exists($dir)){
                throw new Exception("No se puede acceder a la ruta dada", 1);
            }
            else{
                 $this->url = $dir;
            }
        }
    }
    private function generateFileName($ext)
    {
        if(is_array($ext)){
            foreach ($ext as $key => $value) {
               $this->fileNames[] = $this->fileName.".".$value;
            }
        }
    }
    private function getFiles()
    {
        if($dir = opendir($this->url)){
            while (($file = readdir($dir)) !== false) {
                if($file != '.' && $file != '..'){
                    if(is_dir($file)){
                        $this->files['dir'][] = $this->url."/".$i['filename']."/";
                    }else{
                        $i = pathinfo($file);
                        if(is_array($this->ext)){
                            if(in_array($i['extension'],$this->ext)){
                                if(strrpos($i['filename'],$this->fileName) !== false){
                                   $this->files['file'][] = array(
                                        'path'=>$this->url."/".$i['filename'].".".$i['extension'],
                                        'ext'=>$i['extension'],
                                        'name'=>$i['filename']
                                   );
                                }
                            }
                        }else{
                            if(strrpos($i['filename'],$this->fileName) !== false){
                               $this->files['file'][] = array(
                                    'path'=>$this->url."/".$i['filename'].".".$i['extension'],
                                    'ext'=>$i['extension'],
                                    'name'=>$i['filename']
                               );
                            }
                        }
                    }
                }
            }
            closedir($dir);
        }
    }
}
