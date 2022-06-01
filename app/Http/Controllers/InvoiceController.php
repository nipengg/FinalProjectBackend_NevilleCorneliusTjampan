<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\Invoice;

class InvoiceController extends Controller
{
    public function genPDF($in)
    {
        $items = Invoice::where('invoice_id', $in)->get();
        $total = 0;

        foreach ($items as $item)
        {
            $subtotal = $item->total * $item->qty;
            $total = $total + $subtotal;
        }

        $data = [
            'items' => $items,
            'invoice' => $in,
            'total' => $total,
            'date' => date('m/d/Y'),
        ];

        $pdf = PDF::loadView('myPDF', $data);

        return $pdf->stream();
    }
}
