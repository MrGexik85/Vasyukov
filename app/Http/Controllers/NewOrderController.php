<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cfo;
use App\Models\Unit;
use App\Models\Product;
use App\Models\Order;
use Auth;

class NewOrderController extends Controller
{
    /**
     * Response on GET query '/new_record'
     * 
     * @return view
     */
    public function index(){
        return view("new_record", [
            'cfos' => Cfo::all(),
            'units' => Unit::all(),
            'purchaseMethods' => ['прямой', 'тендер'],
        ]);
    }

    /**
     * Response on POST query '/dashboard'
     *
     * Creating a new order and products in this order for current user
     * 
     * @return redirect
     */
    public function create(Request $request) {
        //dd($request);
        //dd($request->keys());
        for($i = 1; $i <= $request->input('count_row'); $i++){
            $this->validate($request, [
                'name_' . $i => 'required|max:45|alpha_dash',
                'unit_' . $i => 'required',
                'count_' . $i => 'required|min:0|numeric',
                'price_' . $i => 'required|min:0|numeric',
                'way_' . $i => 'required',
                'date_' . $i => 'required',
                'cfo_' . $i => 'required',
                'cps_' . $i => 'required',
                'cec_' . $i => 'required',
            ]);
        }

        $order = Order::create([
            'order_name' => "Заявка от " . date('d-m-Y'),
            'status_id' => 1,
            'user_id' => Auth::user()->id,
            'isActual' => 1,
        ]);
        
        for($i = 1; $i <= $request->input('count_row'); $i++){
            $amount = (double) $request->input('count_' . $i);
            $price = (float) $request->input('price_' . $i);

            $product = Product::create([
                'name' => $request->input('name_' . $i),
                'unit_id' => $request->input('unit_' . $i),
                'order_id' => $order->id,
                'year' => date('Y'),
                'amount' => $amount,
                'unitCost' => $price,
                'allCost' => $price * $amount,
                'combinationContract' => $request->input('union_' . $i) ? $request->input('union_' . $i) : '',
                'purchaseMethod' => $request->input('way_' . $i),
                'purchaseDate' => $request->input('date_' . $i),
                'CFO_id' => $request->input('cfo_' . $i),
                'CPS' => $request->input('cps_' . $i),
                'CEC' => $request->input('cec_' . $i),
            ]);
        }
        
        return redirect()->route('dashboard');  
    }
}
