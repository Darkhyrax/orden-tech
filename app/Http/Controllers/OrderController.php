<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Articulo;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $orders = Order::all();
        return view('order.index',compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $articulos = Articulo::all();
        return view('order.create',compact('articulos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'articulos' =>'required',
        ],
        [
            'articulos.required' => "Debe agregar al menos un producto a la lista"
        ]);

        DB::beginTransaction();
        try 
        {
            $order = Order::create([
                'user_id' => Auth::user()->id,
                'monto' => $request->monto,
            ]);

            foreach ($request->articulos as $key => $articulo) 
            {
                $model = new OrderDetail;
                $model->articulo_id = $articulo;
                $model->cantidad = $request->cantidad[$key];
                $model->precio = Articulo::find($articulo)->precio;
                $model->total = $model->precio * $model->cantidad;
                $model->order_id = $order->id;
                $model->save();
            }

            DB::commit();

            return redirect()->route('orders.index')->with('flash_message',['success','Se ha creado la orden exitosamente']);
        } 
        catch (Exception $e) 
        {
            DB::rollBack();
            return redirect()->back()->with('flash_message',['error','']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        $articulos_comprados = OrderDetail::where('order_id',$order->id)->get();
        $numero_orden = $order->numero_orden;
        return view('order_detail.show',compact('articulos_comprados','numero_orden'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        $articulos_comprados = OrderDetail::where('order_id',$order->id)->get();
        $articulos = Articulo::all();
        $estados = \App\Models\Estado::all();
        return view('order.edit',compact('articulos_comprados','articulos','order','estados'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $request->validate([
            'articulos' =>'required',
            'estatus' => 'required|integer|exists:estados,id'
        ],
        [
            'articulos.required' => "Debe agregar al menos un producto a la lista"
        ]);

        DB::beginTransaction();
        try 
        {
            $order = Order::find($id);
            $order->estado_id = $request->estatus;
            $order->monto = $request->monto;
            $order->save();

            OrderDetail::where('order_id', $order->id)->delete();

            foreach ($request->articulos as $key => $articulo) 
            {
                $model = new OrderDetail;
                $model->articulo_id = $articulo;
                $model->cantidad = $request->cantidad[$key];
                $model->precio = Articulo::find($articulo)->precio;
                $model->total = $model->precio * $model->cantidad;
                $model->order_id = $order->id;
                $model->save();
            }

            DB::commit();

            return redirect()->route('orders.index')->with('flash_message',['success','Se ha editado la orden exitosamente']);
        } 
        catch (Exception $e) 
        {
            DB::rollBack();
            return redirect()->back()->with('flash_message',['error','']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        OrderDetail::where('order_id', $id)->delete();
        Order::destroy($id);
        return redirect()->route('orders.index')->with('flash_message',['warning','Se ha eliminado la orden']);
    }

    /**
     * Añadir producto a la lista para solicitar orden.
     *
     * @param  ID Articulo
     * @return JSON Response
     */
    public function agregar_producto(Request $request)
    {
        $request->validate([
            'articulo' => 'required|integer|exists:articulos,id'
        ]);

        $articulo = Articulo::find($request->articulo);

        $data = [
            'id'=> $articulo->id,
            'nombre' => $articulo->nombre,
            'precio' => $articulo->precio,
        ];

        return response()->json($data,201);
    }
}
