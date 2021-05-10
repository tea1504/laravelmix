<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Carbon\Carbon;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Invoice::with('table')->with('staff')->orderBy('is_paid', 'asc', 'date', 'desc')->get());
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
        $request->validate([
            'table_id' => 'required'
        ]);
        $invoice = new Invoice();
        // $invoice->staff_id = $request->user()->id;
        $invoice->table_id = $request->table_id;
        $invoice->date = Carbon::now();
        $invoice->is_paid = false;
        $invoice->check_in = Carbon::now();
        $invoice->save();
        $i=1;
        foreach($request->listOrder as $order){
            $invoice->dishes()->attach($order['dish']['id'],[
                'numerical_order' => $i++,
                'amount' => $order['amount'],
                'price' => $order['dish']['price'],
            ]);
        }
        return response()->json($invoice);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(Invoice::with('dishes')->with('table')->find($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
        $invoice = Invoice::find($id);
        $invoice->dishes()->detach();
        $i=1;
        foreach($request->listOrder as $order){
            $invoice->dishes()->attach($order['dish']['id'],[
                'numerical_order' => $i++,
                'amount' => $order['amount'],
                'price' => $order['dish']['price'],
            ]);
        }
        return response()->json($invoice);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $invoice = Invoice::find($id);
        $invoice->dishes()->detach();
        $invoice->delete();
        return response()->json($id);
    }

    public function detail($id)
    {
        return response()->json(Invoice::find($id)->dishes);
    }
    public function thanhtoan(Request $request, $id)
    {
        $invoice = Invoice::find($id);
        $invoice->staff_id = $request->user()->id;
        $invoice->is_paid = 1;
        $invoice->check_out = Carbon::now();
        $invoice->save();
        return response()->json($invoice);
    }
}
