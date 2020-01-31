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
                    <select class="form-control" id="select_type" name="client_id">
                        @foreach($clients as $client)
                          <option value="{{$client->id}}" @if(old('client_id') == $client->id || $product->client_id == $client->id)  selected="selected" @endif>{{$client->name}}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('client'))
                        <div class="form-control-feedback error">
                          {{$errors->get('client')[0]}}
                        </div>
                    @endif
                </div>
                <div class="order-search-input-wrapper">
                    <input type="text" class="form-control" id="product" value="{{old('product') ?? $product->product }}" name="product" aria-describedby="Enter Product Name" placeholder="Enter Product Name">
                    @if ($errors->has('product'))
                        <div class="form-control-feedback error">
                          {{$errors->get('product')[0]}}
                        </div>
                    @endif
                </div>
                 <div class="order-search-input-wrapper">
                    <input type="text" class="form-control" id="total" value="{{old('total') ?? $product->total }}" name="total" aria-describedby="Enter Total" placeholder="Enter Total">
                    @if ($errors->has('total'))
                        <div class="form-control-feedback error">
                          {{$errors->get('total')[0]}}
                        </div>
                    @endif
                </div>              

                <div class="order-search-input-wrapper">
                    <input class="form-control" type="text" name="date" id="datepicker" value="{{old('date') ?? \Carbon\Carbon::parse($product->date)->format('d/m/Y') }}"></p>
                    @if ($errors->has('date'))
                        <div class="form-control-feedback error">
                          {{$errors->get('date')[0]}}
                        </div>
                    @endif
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

            // init datepicker 
            $('#datepicker').datepicker({
                dateFormat: 'dd/mm/yy'
            });
        });
    </script>
@endsection