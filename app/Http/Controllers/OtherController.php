<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OtherController extends Controller
{
    public function MonCho()
    {
        $res = DB::select("SELECT dish_invoice.*, dishes.name, dishes.image, tables.name as table_name FROM dish_invoice, dishes, invoices, tables WHERE dishes.id = dish_invoice.dish_id AND invoices.table_id = tables.id AND invoices.id = dish_invoice.invoice_id AND dish_invoice.status = 0 AND invoices.is_paid = 0");
        return response()->json($res);
    }
    public function daCheBien($id)
    {
        DB::select("UPDATE dish_invoice SET status = 1 WHERE id = ".$id);
        return response()->json("ok");
    }
    public function lenMon(){
        $res = DB::select("SELECT a.* FROM tables a, invoices b WHERE a.id = b.table_id AND b.is_paid=0");
        $result = [];
        foreach($res as $r){
            $temp = DB::select("SELECT c.id, d.name, c.amount, d.image FROM tables a, invoices b, dish_invoice c, dishes d WHERE a.id = b.table_id AND b.id = c.invoice_id AND d.id=c.dish_id AND b.is_paid = 0 AND c.status = 1 AND a.id = ".$r->id);
            if(count($temp)>0){
                array_push($result, [
                    'table' => $r,
                    'dishes' => $temp
                ]);
            }
        }
        return response()->json($result);
    }
    public function daLen($id)
    {
        DB::select("UPDATE dish_invoice SET status = 2 WHERE id = ".$id);
        return response()->json("ok");
    }
    public function demMonCho()
    {
        $c = DB::select("SELECT COUNT(*) c FROM tables a, invoices b, dish_invoice c, dishes d WHERE a.id = b.table_id AND b.id = c.invoice_id AND d.id=c.dish_id AND b.is_paid = 0 AND c.status = 1");
        return response()->json($c);
    }
}
