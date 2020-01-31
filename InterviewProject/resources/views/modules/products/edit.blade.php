@extends('layout.app')

@section('content_header')
    <div class="header-wrapper">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{route('orders')}}">Orders</a></li>
            <li class="breadcrumb-item active">Order Edit</li>
        </ol>
        <div class="title-wrapper">Edit Order</div>    
    </div> 
@endsection

@section('content')
    <div class="content-wrapper"> 

        <div class="edit-product-wrapper">
            <form class="edit-product-wrapper" method="post" action="{{route('orders.update',$product->id)}}">
                @csrf
                <div class="order-search-input-wrapper">
                    <select class="form-control" id="select_type" name="type">
                        @foreach($clients as $client)
                          <option value="{{$client->id}}" @if(old('client') == $client->id || $product->client->id == $client->id)  selected="selected" @endif>{{$client->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="order-search-input-wrapper">
                    <input type="text" class="form-control" id="product" value="{{old('product')}}" name="product" aria-describedby="Enter Product Name" placeholder="Enter Product Name">
                </div>
                 <div class="order-search-input-wrapper">
                    <input type="text" class="form-control" id="total" value="{{old('total')}}" name="total" aria-describedby="Enter Total" placeholder="Enter Total">
                </div>              

                <div class="order-search-input-wrapper">
                    <div class='input-group date' id='datetimepicker1'>
                        <input type='text' class="form-control" />
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div>  
                <button type="submit" class="btn btn-success search-btn">Save</button>
            </form>
        </div>
        
        </br>

       
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            // select 2 
            $('#select_type').select2();

            // init dateTimtePicker 
            $('#datetimepicker1').datetimepicker();            
        });
    </script>
@endsection