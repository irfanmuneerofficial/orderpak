@extends('user_panel.layouts.master')
@section('title')
Wishlist Product
@endsection
@section('mainContent')
  
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title ">Wishlist Product</h4>
            <!--<p class="card-category"> Here is a subtitle for this table</p>-->
          </div>
          <div class="card-body">
            <div class="table table-hover">
              <table  id="myTable">
                <thead class="text-primary" style="width: 100%">
                  <th>ID</th>
                  <th>Product Name</th>
                  <th>Sku</th>
                  <th>Price</th>
                  <th>Product Image</th>
                  <th>Description</th>
                  <th>Action</th>
                </thead>
                <tbody>
                  @foreach($products as  $product)
                  @foreach($wishlists as $key=>  $wishlist)
                  @if($product->id == $wishlist->product_id)
                  <tr>
                    <td>{{$key}}</td>
                    <td>{{$product->title}}</td>
                    <td>{{$product->vendor_id}}-{{$product->category_id}}-{{$product->product_sku}}</td>
                    <td>
                        @if($product->sale_price > 0)
                            {{$product->sale_price}}
                        @else
                            {{$product->price}}
                        @endif
                        
                        </td>
                    <td><img src="/uploads/product_images/{{$product->image_1}}" width="100" alt=""></td>
                    <td>{{ str_limit($product->short_description, 50) }}</td>
                    <td>
                        @if($product->slug)
                        <a href="/product/{{$product->slug}}" class="btn btn-primary">View</a>
                        @else
                        <a href="/product_inside/{{$product->id}}" class="btn btn-primary">View</a>
                        @endif
                        <button onclick="unwishlist(this.id)" class="btn btn-primary" id="{{$product->id}}">Remove</button></td>
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
  function unwishlist(id) {

  $.get('/unwishlist/'+id, 
    function( data ) 
    {
      location.reload();
    }
  );
}
</script>
@endsection