<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BaoCaoController extends Controller
{
    public function DoanhThuTheoNam(Request $request)
    {
        $result = DB::select("SELECT month(a.date) 'thang', SUM(b.price*b.amount) 'doanhthu' FROM invoices a, dish_invoice b WHERE a.id = b.invoice_id AND year(a.date) = " . $request->nam . " AND a.is_paid = 1 GROUP BY month(a.date);");
        return response()->json($result);
    }
    public function DoanhThuTheoThang(Request $request)
    {
        $result = DB::select("SELECT day(a.date) 'ngay', SUM(b.price*b.amount) 'doanhthu' FROM invoices a, dish_invoice b WHERE a.id = b.invoice_id AND year(a.date) = " . $request->nam . " AND month(a.date) = " . $request->thang . " AND a.is_paid = 1 GROUP BY a.date;");
        return response()->json($result);
    }
    public function Mau()
    {
        $result = DB::select("");
        return response()->json($result);
    }
}
