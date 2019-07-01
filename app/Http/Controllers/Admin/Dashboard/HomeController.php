<?php

namespace App\Http\Controllers\Admin\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class HomeController extends Controller
{
    protected $mUser;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(User $usuario)
    {
        $this->middleware('auth');
        $this->mUser = $usuario;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.home')->with(['encargados' => $this->mUser->all()]);
    }
}