@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center"><span class="float-right">
                        <a href="/" class="btn btn-outline-dark btn-xs">Back</a></span><h3>Sell Product</h3></div>

                <div class="card-body">
                    {!! Form::open(['action' => 'ListingsController@store','method'=>'POST']) !!}
                    {{Form::bsText('product_name', '', ['placeholder'=> 'Product Name'])}}
                    {{Form::bsText('product_price', '', ['placeholder'=> 'Product Price'])}}
                    {{Form::label('payment_method', 'Payment Method')}}
                    <div class="form-control">
                    {{Form::select('payment_method', ['cash' => 'CASH', 'cheque' => 'CHEQUE'])}}
                    </div>
                    {{Form::bsText('payment_amount', '', ['placeholder'=> 'Payment amount'])}}
                    {{Form::label('date', 'Date')}}
                    {{Form::date('date', \Carbon\Carbon::now())}}
                    {{Form::bsTextArea('note', '', ['placeholder'=> 'note'])}}
                    {{Form::bsSubmit('submit')}}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
