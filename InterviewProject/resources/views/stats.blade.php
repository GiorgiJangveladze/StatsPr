@extends('layout.app')

@section('content_header')
    <div class="header-wrapper">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
            <li class="breadcrumb-item active">Orders</li>
        </ol>
        <div class="title-wrapper">Orders</div>    
    </div> 
@endsection

@section('content')
    <div class="content-wrapper"> 

        <div class="order-search-wrapper">
            <form class="order-search-form" method="get" action="{{route('orders')}}">
                <!-- @csrf -->
                <div class="order-search-input-wrapper">
                    <input type="text" class="form-control" id="keyword" value="{{isset($attr['keyword']) && $attr['keyword'] ? $attr['keyword'] : ''}}" name="keyword" aria-describedby="Enter keyword" placeholder="keyword">
                </div>
                <div class="order-search-input-wrapper">
                    <select class="form-control" id="select_type" name="type">
                          <option value="">All</option>
                        @foreach($types as $type)
                          <option value="{{$type}}" @if(isset($attr['type']) && $attr['type'] == $type)  selected="selected" @endif>{{$type}}</option>
                        @endforeach
                    </select>
                </div>
                <input type="hidden" id="sortedBy" name="sortedBy" value="{{isset($attr['sortedBy']) ? $attr['sortedBy'] : ''}}">
                <button type="submit" class="btn btn-success search-btn">Search</button>
            </form>
        </div>
        
        </br>

        <div class="chart-wrapper">
            {!! $chart->container() !!}
        </div>

        </br>
            <a href="{{route('send_report')}}">Email this report</a>
        </br>

        <div class="table-wrapper">
            <table class="rwd-table" id="myTable">
            <tr>
                <th onclick="sortTable(0)">Client   <span id="arrow-symbol-0"> &#8595 </span></th>
                <th onclick="sortTable(1)">Product  <span id="arrow-symbol-1">&#8595</span></th>
                <th onclick="sortTable(2)">Total    <span id="arrow-symbol-2">&#8595</span></th>
                <th onclick="sortTable(3)">Date     <span id="arrow-symbol-3">&#8595<span></th>
                <th>Actions</th>
            </tr>
            @foreach($products as $product)
            <tr>
                <td data-th="client">{{$product->client}}</td>
                <td data-th="product">{{$product->product}}</td>
                <td data-th="total">{{$product->total}}</td>
                <td data-th="date">{{ date('d/m/Y', strtotime($product->date)) }}</td>
                <td data-th="actions">
                    <a href="{{route('orders.edit',$product->id)}}" class="btn btn-primary btn-icon">
                      <div>Edit</div>
                    </a>
                    @php($deleteURL = route('orders.delete'))
                    <a href="javascript:;" onclick="deletefunction('{{$deleteURL}}',this)" rel="{{$product->id}}" class="btn btn-danger btn-icon">
                      <div>Delete</div>
                    </a>
                </td>
            </tr>
            @endforeach
            </table>    
        </div>
        <p>{{ $products->appends(request()->except('page'))->links() }}</p>
    </div>
    {!! $chart->script() !!}
@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {

            // select 2 
            $('#select_type').select2();

            // For init chart Begin
            var ctx = document.getElementById('myChart').getContext('2d');
            var chart = new Chart(ctx, {
                // The type of chart we want to create
                type: 'line',

                // The data for our dataset
                data: {
                    labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
                    datasets: [{
                        label: 'My First dataset',
                        backgroundColor: 'rgb(255, 99, 132)',
                        borderColor: 'rgb(255, 99, 132)',
                        data: [0, 10, 5, 2, 20, 30, 45]
                    }]
                },

                // Configuration options go here
                options: {}
            });
            // For init chart End
                 
        });
    </script>
@endsection