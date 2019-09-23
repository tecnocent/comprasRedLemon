<?php

namespace App\Http\Controllers\Admin\Moneda;

use App\Models\Currency;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Log;

class MonedaController extends Controller
{
    protected $mCurrency;

    public function __construct(Currency $currency)
    {
        $this->middleware('auth');
        $this->mCurrency = $currency;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * @param Request $oRequest
     * @param $orden
     * @return \Illuminate\Http\RedirectResponse
     */
    public function guardaMoneda(Request $oRequest)
    {
        try {
            $moneda = $this->mCurrency->create([
                'name' => $oRequest->currency_name,
                'code' => $oRequest->currency_code,
            ]);

            // Alerta
            $notification = array(
                'message' => 'Moneda agregada correctamente.',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        } catch (\Exception $e) {
            // Alerta
            $notification = array(
                'message' => 'Algún error ocurrió.',
                'alert-type' => 'warning'
            );
            Log::error('Error on ' . __METHOD__ . ' line ' . $e->getLine() . ':' . $e->getMessage());
            return redirect()->back()->with($notification);
        }
    }
}
