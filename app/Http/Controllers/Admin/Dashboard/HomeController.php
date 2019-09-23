<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Models\DisenoProducto;
use App\Models\GastosOrigenOrdenCompra;
use App\Models\OrdenCompra;
use App\Models\PagoMontoOrdenCompra;
use App\Models\Producto;
use App\Models\ProductoOrdenCompra;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
//        return view('admin.home')->with(['encargados' => $this->mUser->all()]);

        $ordenesCompra = OrdenCompra::with('proveedor', 'almacen')->get();
        return view('admin.home_bk')
            ->with([
                'encargados' => $this->mUser->all(),
                'ordenes' => $ordenesCompra
            ]);

    }


}