<?php

namespace App\Http\Controllers\Admin\Variant;

use App\Models\ProductVariant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Log;

class VariantController extends Controller
{
    protected $mVariant;

    public function __construct(ProductVariant $variant)
    {
        $this->middleware('auth');
        $this->mVariant = $variant;
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
    public function guardaVariant(Request $oRequest)
    {
       var_dump($oRequest);
        try {
            $moneda = $this->mVariant->create([
               'variant' => $oRequest->nombre_variant,
               'product_id' => $oRequest->product_id
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
