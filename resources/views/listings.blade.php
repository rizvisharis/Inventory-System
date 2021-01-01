@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" >{{ ('Latest Products') }}

                    <div class="card-body">
                        <h3>Users Products</h3>
                        @if(count($listings))
                            <ul class="list-group">
                                @foreach($listings as $listing)
                                   <li class="list-group-item"><a href="/listings/{{$listing->id}}">{{$listing->product_name}}</a> </li>
                                @endforeach
                            </ul>
                        @else
                            <p>No Products found</p>

                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
