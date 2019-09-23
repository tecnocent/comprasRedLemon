<?php

namespace App\Http\Controllers\Admin\Incoterm;

use App\Models\Incoterm;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Log;

class IncotermController extends Controller
{
    protected $mIncoterm;

    public function __construct(Incoterm $incoterm)
    {
        $this->middleware('auth');
        $this->mIncoterm = $incoterm;
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
    public function guardaIncoterm(Request $oRequest)
    {
        try {
            $moneda = $this->mIncoterm->create([
                'nombre' => $oRequest->nombre_incoterm
            ]);

            // Alerta
            $notification = array(
                'message' => 'Incoterm agregado correctamente.',
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
