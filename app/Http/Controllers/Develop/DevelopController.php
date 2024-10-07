<?php

namespace App\Http\Controllers\Develop;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DevelopController extends Controller
{
    function testing()
    {
        return bcrypt('admin');
    }
}
