@extends('user_template.layouts.template')
@section('main-content')
<h1>Add To Cart Page</h1>
@if (session()->has('message'))
          <div class="alert alert-success">
         {{ session()->get('message') }}
          </div>
          
        @endif

        <div class="row">
          <div class="col-lg-12">
            <div class="box_main">
              <div class="table-responsive">
                <table class="table">
                  <tr>
                    <th>Product Name</th>
                    <th>Product Image</th>
                    <th>Quantity </th>
                    <th>Price</th>
                    <th>Action</th>
                  </tr>

                  @foreach ($cartinfo as $carts )
                  <tr>
                    @php
                      $product_name = App\Models\Product::where('id', $carts->product_id)->value('product_name');
                      $img = App\Models\Product::where('id', $carts->product_id)->value('product_img');

                    @endphp
                    <td>{{ $product_name  }}</td>
                    <td><img  src="{{ asset($img) }}" alt="" style="height: 50px"></td>
                    <td>{{ $carts->quantity }}</td>
                    <td>{{ $carts->price }}</td>
                    <td><a href="" class="btn btn-warning">Remove</a></td>
                  </tr>
                  @endforeach
                  
                </table>
              </div>
            </div>
          </div>
        </div>
@endsection()