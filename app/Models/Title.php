<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Title extends ReadOnlyBase
{
    use HasFactory;
    protected $titles_array = ['Mr','Mrs','Ms','Dr','Mx'];
}
