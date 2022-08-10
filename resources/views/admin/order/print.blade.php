<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="Description" content="Enter your description here"/>
    <link rel="stylesheet" href="/frontend/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/frontend/assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"/>
    <title>OrderPak | Print</title>
  </head>
<style type="text/css">
@media print {
    #printbtn {
        display :  none;
    }
}
</style>
  <body>
      <div class="container">
        <div class="logo d-block m-auto">
            <img src="/frontend/assets/img/Logo.png">
        </div>
        <button class="btn btn-default" id="printbtn" onClick="window.print()">Print</button>
        <table class="table table-bordered mt-5">
            <thead>
              <tr>
                <th scope="col">Order id</th>
                <th scope="col">Product Name</th>
                <th scope="col">SKU</th>
                <th scope="col">Color</th>
                <th scope="col">Size</th>
                <th scope="col">Quantity</th>
                <th scope="col">Product Image</th>
                <th scope="col">Price</th>
              </tr>
            </thead>
            <tbody>
                    <?php $sum_tot_Price = 0 ?>
                    <?php $sum_tot_Price1 = 0 ?>
                    @foreach($orders as $order)
                    <tr>
                      <td>{{$order->order_id}}</td>
                      <td>{{$order->product_name}}</td>
                      <td style="text-transform:uppercase;">{{ (Auth::guard('vendor')->check()) ? $order->product_sku : $order->systematic_sku }}</td>
                      <td>{{$order->color}}</td>
                      <td>{{$order->size}}</td>
                      <td>{{$order->quantity}}</td>
                      <td><img src="/uploads/product_images/{{$order->product_img}}" alt="{{$order->product_name}}" width="100"></td>
                      <td>
                        @if($order->product_sale_price > 0 )
                        {{number_format($order->product_sale_price)}}
                        @else
                        {{number_format($order->product_price)}}
                        @endif


                        @if($order->product_sale_price > 0 )
                      <?php $sum_tot_Price1 += $order->product_sale_price * $order->quantity; ?>
                      @else
                        <?php $sum_tot_Price1 += $order->product_price * $order->quantity; ?>
                      @endif
                      </td>
                    </tr>
                    @endforeach
                    <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><b>Sub Total: </b></td>
                    <td>
                        {{number_format($sum_tot_Price1)}}
                    </td>
                  </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><b>Shipping Price: </b></td>
                        <td>
                          <?php echo number_format($order->shipping) ?>
    
                          
    
                        </td>
                  </tr>
                  <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><b>Total: </b></td>
                    <td>{{($sum_tot_Price1 > 0 ) ? number_format($sum_tot_Price1 + $order->shipping) : number_format($sum_tot_Price + $order->shipping)  }}</td>
                  </tr>
            </tbody>
          </table>
          <div class="shipp-info">
              <ul class="list-group list-group-flush">
                  <li class="list-group-item"><p><b>Shipping Address:</b> {{$order->address}}</p></li>
                  <li class="list-group-item"><p><b>User Name:</b> {{$order->name}}</p></li>
                  <li class="list-group-item"><p><b>User Number:</b> {{$order->phone}}</p></li>
                  <li class="list-group-item"><p><b>User Email:</b> {{$order->email}}</p></li>
              </ul>
          </div>
      </div>
  
    <script src="/frontend/assets/js/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="/frontend/assets/js/bootstrap.min.js"></script>
  </body>
</html>