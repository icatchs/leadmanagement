<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pendinglead;
class PendingLeadsController extends Controller
{
    public function index(){
        $pendingleads = Pendinglead::latest('id')->paginate(10);
        return view('dashboard.pendinglead.index',compact('pendingleads'));
    }

}
