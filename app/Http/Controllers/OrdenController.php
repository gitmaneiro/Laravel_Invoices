<?php

namespace App\Http\Controllers;

use App\Models\Orden;
use App\Models\Cliente;
use App\Models\Producto;

use LaravelDaily\Invoices\Invoice;
use LaravelDaily\Invoices\Classes\Buyer;
use LaravelDaily\Invoices\Classes\Party;
use LaravelDaily\Invoices\Classes\InvoiceItem;

use Illuminate\Http\Request;



class OrdenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ordenes = Orden::with('productos', 'cliente')->get();
        return view('orden.index', ['ordenes'=>$ordenes]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $productos = Producto::all();
        $clientes = Cliente::all();

        return view('orden.crear', ['productos'=>$productos, 'clientes'=>$clientes]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, ['cliente_id'=>'required']);

        $orden = Orden::create( [
            'user_id' => auth()->user()->id,
            'orden_fecha' => now(),
            'cliente_id'=>$request->input('cliente_id')
        ]);

        $productos = $request->input('productos', []);
        $cantidades = $request->input('quantities', []);

        for ($producto = 0; $producto < count($productos); $producto++) {
            if ($productos[$producto] != '') {
                $orden->productos()->attach($productos[$producto], ['quantity' => $cantidades[$producto]]);
            }
        }

       //$orden->productos()->attach($request->input('productos'));

        return redirect()->route('orden.index');
    }


    public function generarFactura($id)
    {
        $customer = new Buyer([
            'name'          => $order->customer->name,
            'custom_fields' => [
                'email' => $order->customer->email,
            ],
        ]);

        $seller = new Buyer([
            'name'          => $order->user->name,
            'custom_fields' => [
                'email' => $order->user->email,
            ],
        ]);

        foreach ($order->products as $product) {
            $items[] = (new InvoiceItem())->title($product->name)
                ->pricePerUnit($product->price)
                ->quantity($product->pivot->quantity);
        }

        $invoice = Invoice::make()
            ->buyer($customer)
            ->seller($seller)
            ->currencySymbol('$')
            ->currencyCode('USD')
            ->taxRate(15)
            ->addItems($items);

        return $invoice->download();
    }

    /**
     * Display the specified resource.
     */
    public function show(Orden $orden)
    {
        $cliente = new Buyer([
            'name'          => $orden->cliente->name,
            'custom_fields' => [
                'email' => $orden->cliente->email,
            ],
        ]);

        $vendedor = new Party([
            'name'          => $orden->user->name,
            'custom_fields' => [
                'email' => $orden->user->email,
            ],
        ]);
        
            $items=array();
        foreach ($orden->productos as $producto) {
            $items[] = (new InvoiceItem())->title($producto->nombre)
                ->pricePerUnit($producto->precio)
                ->quantity($producto->pivot->quantity);
        }

        $item = InvoiceItem::make('Service 1')->pricePerUnit(2);
        
        $invoice = Invoice::make()
            ->buyer($cliente)
            ->seller($vendedor)
            ->dateFormat(format:'m/d/y')
            ->currencySymbol('$')
            ->currencyCode('USD')
            ->taxRate(15)
            ->addItems($items);
        
        return $invoice->stream();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Orden $orden)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Orden $orden)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Orden $orden)
    {
        //
    }
}
