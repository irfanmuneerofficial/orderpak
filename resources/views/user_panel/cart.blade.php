@extends('user_panel.layouts.master')
@section('title')
Cart
@endsection
@section('mainContent')
  
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table  id="myTable">
                <thead class="text-primary" style="width: 100%">
                  <th>ID</th>
                  <th>Name</th>
                  <th>Image</th>
                  <th>Quantity </th>
                  <th>Price</th>
                  <th>Status</th>
                </thead>
                <tbody>
                  @foreach($products as $key =>  $product)
                  @foreach($carts as $cart)
                  @if($product->id == $cart->product_id)
                  <tr>
                    <td>{{$key}}</td>
                    <td>{{$product->title}}</td>
                    <td><img src="/uploads/product_images/{{$product->image_1}}" width="100" alt=""></td>
                    <td>{{$cart->quantity}}</td>
                    <td>
                      @if($product->sale_price)
                      {{$product->sale_price}}</td>
                      @else
                      {{$product->price}}</td>
                      @endif
                    <td>
                      <i class="fa fa-trash" onClick="deleteclick(this.id)" id="{{$cart->id}}"></i> | 
                      <a href="/checkout"><i class="fa fa-shopping-bag"></i></a></td>
                  </tr>
                  @endif
                  @endforeach                  
                  @endforeach                  
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  function deleteclick(clicked_id){

  var id = clicked_id;

  $.get('/cart/'+clicked_id, 
    function( data ) 
    {
      window.location.reload(true);

    }
  );
}
</script>
@endsection