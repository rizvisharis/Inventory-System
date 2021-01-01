@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Product') }}<span class="float-right">
                        <a href="/" class="btn btn-outline-dark btn-xs">Back</a></span></div>

                <div class="card-body">
                    {!! Form::open(['action' => ['BuyListingsController@update',$listing->id],'method'=>'POST']) !!}
                    {{Form::bsText('product_name', $listing->product_name, ['placeholder'=> 'Product Name'])}}
                    {{Form::bsText('product_price', $listing->product_price, ['placeholder'=> 'Product Price'])}}
                    {{Form::bsText('person_name', $listing->person_name, ['placeholder'=> 'Person Name'])}}
                    {{Form::label('payment_method', 'Payment Method')}}
                    {{Form::select('payment_method', ['cash' => 'CASH', 'cheque' => 'CHEQUE'])}}
                    {{Form::bsText('payment_amount', $listing->payment_amount, ['placeholder'=> 'Payment amount'])}}
                    {{Form::label('date', 'Date')}}
                    {{Form::date('date', \Carbon\Carbon::parse($listing->date))}}
                    {{Form::bsTextArea('note', $listing->note, ['placeholder'=> 'note'])}}
                    {{Form::hidden('_method','PUT')}}
                    {{Form::bsSubmit('submit')}}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
