<?php

namespace App\Http\Controllers;

use App\BuyListing;
use Illuminate\Http\Request;

class BuyListingsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query=BuyListing::orderBy('created_at','desc');
        if ($request->search) {
            $query->where('product_name', 'like', '%'.$request->search.'%')
                ->orWhere('person_name', 'like', '%'.$request->search.'%')
                ->orWhere('payment_method', 'like', '%'.$request->search.'%')
                ->orWhere('date', 'like', '%'.$request->search.'%');
        }
        if($request->product_name){
            $query->where('product_name', 'like', '%'.$request->product_name.'%');
        }
        if($request->person_name){
            $query->where('person_name', 'like', '%'.$request->person_name.'%');
        }
        if($request->payment_method === 'cash' || $request->payment_method === 'cheque'){
            $query->where('payment_method', 'like', '%'.$request->payment_method.'%');
        }
        if($request->start_date && $request->end_date){
            $query->whereBetween('date', [$request->start_date, $request->end_date]);
        }
        $listings=$query->get();
        return view('showbuylisting',compact('listings'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('createbuylisting');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'product_name'=>'required|min:2',
            'product_price'=>'required|numeric',
            'person_name'=>'required|min:2',
            'payment_method'=>'required',
            'payment_amount'=>'required|numeric',
            'date'=>'required|date_format:Y-m-d',
            'note'=>'required',
        ]);

        $product=BuyListing::create([
            'product_name'=>$request->product_name,
            'product_price'=>$request->product_price,
            'person_name'=>$request->person_name,
            'payment_method'=>$request->payment_method,
            'payment_amount'=>$request->payment_amount,
            'date'=>$request->date,
            'note'=>$request->note,
        ]);

        return redirect('/buylistings')->with('success', 'Product Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $listing =BuyListing::find($id);
        return view('showlisting')->with('listing',$listing);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $listing =BuyListing::find($id);
        return view('editbuylisting')->with('listing',$listing);
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
        $this->validate($request,[
            'product_name'=>'required|min:2',
            'product_price'=>'required|numeric',
            'person_name'=>'required|min:2',
            'payment_method'=>'required',
            'payment_amount'=>'required|numeric',
            'date'=>'required|date_format:Y-m-d',
            'note'=>'required',
        ]);
        $product=BuyListing::find($id);

        $product->product_name=$request->product_name;
        $product->product_price=$request->product_price;
        $product->person_name=$request->person_name;
        $product->payment_method=$request->payment_method;
        $product->payment_amount=$request->payment_amount;
        $product->date=$request->date;
        $product->note=$request->note;
            $product->save();


        return redirect('/buylistings')->with('success', 'Product Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product=BuyListing::find($id);
        $product->delete();

        return redirect('/buylistings')->with('success', 'Product Deleted');
    }
}
