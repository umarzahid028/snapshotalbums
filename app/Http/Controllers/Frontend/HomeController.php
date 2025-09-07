<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Admin\ForLease;
use App\Models\Admin\ForSale;
use App\Models\Frontend\Winner;
use App\Models\Admin\Leads;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('frontend.index');
    }
   
   
    public function portfolio()
    {  
        $forsales = ForSale::all();
        $forleases = ForLease::all();
        // dd($forsales);
        $data = $forsales->concat($forleases)->sortByDesc('created_at');
        // dd($data->all());
        return view('frontend.portfolio', compact('data'));
    }
    public function about()
    {
        return view('frontend.about-us');
    }
    public function contact()
    {
        return view('frontend.contact-us');
    }
    public function privacy()
    {
        return view('frontend.privacy-policy');
    }
    public function single_page_forsale(Request $request, $id)
    {
        $forsales = ForSale::where('id', $id)->get();
        return view('frontend.single_page', compact('forsales'));
    }
    public function single_page_forlease(Request $request, $id)
    {
        $forsales = ForLease::where('id', $id)->get();
        return view('frontend.single_page', compact('forsales'));
    }

    // for woring 
    public function working()
    {
        $forsales = ForSale::all();
        return view('frontend.portfolio_working', compact('forsales'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $data = new Leads();
        $data->property_id = $request->input('property_id');
        $data->lead_property_type = $request->input('lead_property_type');
        $data->name = $request->input('name');
        $data->phone = $request->input('phone');
        $data->email = $request->input('email');
        $data->message = $request->input('message');
        $data->save();

        // return $data;
        return response()->json(['message' => 'Successfully updated'], 200);
    }
    

}
