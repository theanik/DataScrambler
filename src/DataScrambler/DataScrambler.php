<?php

namespace Scrambler\DataScrambler;

class DataScrambler{
    private $key;
    public $originalKey;
    function __construct()
    {
        $this->key = "asdfghjklzxcvbnmqwertyuiop1234567890";
        $this->originalKey = '';

    }

    public function displayKey($task)
    {
        if('key' == $task){
            $this->generateKey();
            return "value = ".$this->originalKey;
        }
        
    }

    private function generateKey(){
        $originalKey = str_split($this->key);
        shuffle($originalKey);
        $this->originalKey = join('',$originalKey);
    }

    public function ScrambleData($originalData,$myKey)
    {
        $len = strlen($originalData);
        $scrambleData = '';
        if($len > 0){
            for($i = 0;$i < $len;$i++){
                $currentChar = $originalData[$i];
                $position = strpos($this->key,$currentChar);
                if($position !== false){
                    $scrambleData .= $myKey[$position];
                }else{
                    $scrambleData .= $currentChar;
                }
            }
            return $scrambleData;
        }
    }

    public function DecodeData($encData,$myKey)
    {
        $len = strlen($encData);
        $plainData = '';
        if($len > 0){
            for($i = 0;$i < $len;$i++){
                $currentChar = $encData[$i];
                $position = strpos($myKey,$currentChar);
                if($position !== false){
                    $plainData .= $this->key[$position];
                }else{
                    $plainData .= $currentChar;
                }
            }
            return $plainData;
        }
    }





}

