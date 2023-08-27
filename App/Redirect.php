<?php 
namespace App;
class Redirect{
    public $where;
    public function __construct(string $where)
    {
        $this->where=$where;
    }
    public function go()
    {
      header("Location:" . $this->where);
    }
}