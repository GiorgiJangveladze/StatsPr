@extends('layout.app')

@section('content_header')
    <div class="header-wrapper">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
            <li class="breadcrumb-item active">Upload File</li>
        </ol>
        <div class="title-wrapper">Upload File</div>    
    </div> 
@endsection

@section('content')
    <div class="content-wrapper"> 

        <div class="edit-product-wrapper">
            <form class="edit-product-wrapper" method="post" action="{{route('upload.store')}}" enctype="multipart/form-data">
                @csrf
                
                <div class="order-search-input-wrapper">
                    <select class="form-control" id="select_type" name="type" >
                        <option value="client" @if(old('type') == "clients")  selected="selected" @endif> For Client Table</option>
                        <option value="products" @if(old('type') == "products")  selected="selected" @endif> For Products Table</option>
                    </select>
                    @if ($errors->has('type'))
                        <div class="form-control-feedback error">
                          {{$errors->get('type')[0]}}
                        </div>
                    @endif
                </div>

                <div class="order-search-input-wrapper">
                    <input type="file" id="file" name="file"  placeholder="Upload File">
                    @if ($errors->has('file'))
                        <div class="form-control-feedback error">
                          {{$errors->get('file')[0]}}
                        </div>
                    @endif
                    <button type="submit" class="btn btn-success search-btn">Upload</button>
                </div>
            </form>
        </div>
        
        </br>

       
    </div>
@endsection