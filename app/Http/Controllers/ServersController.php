<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;

class ServersController extends Controller
{
    public function index(){
        return view('servers.index');
    }
}
