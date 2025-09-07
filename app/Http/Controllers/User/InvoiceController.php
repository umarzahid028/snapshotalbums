<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Admin\Invoice;
use Illuminate\Http\Request;
use Dompdf\Dompdf;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoices = Invoice::orderBy('updated_at', 'desc')->get();
        return view('invoice-list', compact('invoices'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $invoices = Invoice::where('id', $id)->get();
        // return view('pdf_invoice', compact('invoices'));
        
        $html = view('pdf_invoice', compact('invoices'))->render();

        // // Create a new dompdf instance
        $dompdf = new Dompdf();

        // // Load the HTML into the dompdf instance
        $dompdf->loadHtml($html);

        // // Set the paper size and orientation
        $dompdf->setPaper('A4', 'landscape');

        // // Render the PDF
        $dompdf->render();

        // // Output the generated PDF to the browser
        return $dompdf->stream('invoice.pdf');
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
