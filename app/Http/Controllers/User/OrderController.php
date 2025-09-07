<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Admin\Invoice;
use App\Models\Admin\Product;
use App\Models\User\Order;
use Carbon\Carbon;
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
    public function index()
    {
        if(Auth::check() && Auth::user()->role->id == 2 || Auth::user()->role->id == 3 || Auth::user()->role->id == 4)
        {
            $orders = Order::orderBy('updated_at', 'desc')->get();
        }
        return view('orders-list', compact('orders'));
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $usr_id = $request->user_id;
        $pro_id = $request->product_id;
        $exist_qty = $request->qty;
        $order_qty = $request->order_qty;
        $retailer_price = $request->P_for_retailer;
        $distributor_price = $request->P_for_distributor;
        $wholesaler_price = $request->P_for_wholesaler;

        // Check if order_qty is greater than exist_qty
        if ($order_qty > $exist_qty) {
            return redirect()->back()->with('error', 'Sorry, you cannot order more than the available quantity.');
        }

        if($retailer_price)
        {
            $order_total_price = $order_qty * $retailer_price;
            $get_price = $retailer_price;
        }
        elseif($distributor_price)
        {
            $order_total_price = $order_qty * $distributor_price;
            $get_price = $distributor_price;
        }
        elseif($wholesaler_price)
        {
            $order_total_price = $order_qty * $wholesaler_price;
            $get_price = $wholesaler_price;
        }
        else
        {
            return "Does Not Exist";
        }

        // dd($get_price);
        // subtract Qty
        $after_minus_qty = $exist_qty - $order_qty;
        // after Subtract Qty is Save in Product
        $products = Product::findOrFail($pro_id);
        $products->qty = $after_minus_qty;
        $products->save();  
        // get Date
        $date =  date("Y-m-d");
        // save order
        $orders = new Order();
        $orders->user_id = $usr_id;
        $orders->product_id = $pro_id;
        $orders->date = $date;
        $orders->paid = 'No';
        $orders->status = 'Pending';
        $orders->order_price = $get_price;
        $orders->item = $order_qty;
        $orders->total = $order_total_price;
        $orders->save();

        return redirect()->route('user.order.index')->with('success', 'Order Place successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //  invoice number Generate

    

    public function edit($id)
    {
        // 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

         
    
    public function update(Request $request, $id)
    {
        // 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
