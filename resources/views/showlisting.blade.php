@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div >
            <div class="card">
                <div class="card-body">
                    <div class ="card-header text-center"><span class="float-right">
                        <a href="/" class="btn btn-outline-dark btn-xs">Back</a></span><h3>Sell Products</h3></div>
                        {!! Form::open(['action' => 'ListingsController@index','method'=>'GET']) !!}
                        {{Form::bsText('common_search', '', ['placeholder'=> 'common search'])}}
                    <div class="row">
                    <div class="col-md-4">
                        {{Form::bsText('product_name', '', ['placeholder'=> 'Search by Product Name'])}}
                    </div>
                        <div class="col-md-4">
                        {{Form::bsText('person_name', '', ['placeholder'=> 'Search by Person Name'])}}
                    </div>
                    <div class="text-center col-md-4">
                        {{Form::label('payment_method', 'Payment Method')}}
                        {{Form::select('payment_method', ['non'=>'None','cash' => 'CASH', 'cheque' => 'CHEQUE'])}}
                    </div>
                    </div>
                    <div class="row">
                    <div class="col-md-4">
                        {{Form::bsText('start_date', '', ['placeholder'=> 'YYYY-MM-DD'])}}
                    </div>
                        <div class="col-md-4"
                        {{Form::bsText('end_date', '', ['placeholder'=> 'YYYY-MM-DD'])}}
                    </div>
                    </div>

                        {{Form::submit('Search',['class'=>'btn btn-primary'])}}
                        {!! Form::close() !!}
                    @if(count($listings))
                    <div class="table-responsive">
                        <table class ='table table-hover mx-auto w-auto'>
                            <thead>
                            <tr >
                                <th class="text-center">Product Name</th>
                                <th class="text-center">Product Price</th>
                                <th class="text-center">Person Name</th>
                                <th class="text-center">Payment Method</th>
                                <th class="text-center">Payment Amount</th>
                                <th class="text-center align-middle" width=11%>Date</th>
                                <th class="text-center align-middle" width=15%>Note</th>
                                <th class="text-center"></th>
                                <th class="text-center"></th>
                            </tr>
                            </thead>
                            @foreach($listings as $listing)
                                <tbody class="text-center">
                                <tr>
                                    <td class="align-middle" >{{($listing->product_name)}}</td>
                                    <td class="align-middle">{{$listing->product_price}}</td>
                                    <td class="align-middle">{{$listing->person_name}}</td>
                                    <td class="align-middle">{{$listing->payment_method}}</td>
                                    <td class="align-middle">{{$listing->payment_amount}}</td>
                                    <td class="align-middle">{{\Carbon\Carbon::parse($listing->date)->toDateString()}}</td>
                                    <td class="align-middle">{{$listing->note}}</td>
                                    <td class="align-middle"><a class="pull-right btn btn-outline-primary" href="/listings/{{$listing->id}}/edit">Edit</a></td>
                                    <td class="align-middle">
                                        {!! Form::open(['action' => ['ListingsController@destroy',$listing->id],
                                        'method'=>'POST','class'=>'pull-left','onsubmit'=>'return confirm("Are you sure")']) !!}
                                        {{Form::hidden('_method','DELETE')}}
                                        {{Form::submit('Delete',['class'=>'btn btn-outline-danger'])}}
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                                </tbody>
                            @endforeach
                        </table>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
