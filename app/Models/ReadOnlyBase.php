<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReadOnlyBase
{
    use HasFactory;

    protected $titles_array = [];

    public function all(){
        return $this->titles_array;
    }

    public function get($id){
        return $this->titles_array[$id];
    }
}
