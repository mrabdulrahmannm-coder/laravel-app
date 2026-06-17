<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class AboutController extends Controller
{
    public function up():void
    {
        Schema::table('student', function (Blueprint $table){
            $table->string('foto')->default(null);
        });
    }
}
