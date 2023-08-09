<?php
namespace App;
class LittleContent{
    public $string;
    public function __construct(string $string)
    {
        $this->string=$string;
    }
    public function extrait(int $limit=60):string
    {
        $coupe=$this->string;
        $length=mb_strpos($coupe,' ',$limit);
        $substring=nl2br(mb_substr($coupe,0,$length));
        return $substring . "...";

    }
    public function AfiicheDate(){
       

    }
}