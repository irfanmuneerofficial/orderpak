<!DOCTYPE html>
<html lang="en">
  <head>
    <title>OrderPak | Email</title>
    <style>
      
    @import url('https://fonts.googleapis.com/css2?family=Roboto&display=swap');
html, body, div, span, applet, object, iframe,
h1, h2, h3, h4, h5, h6, p, blockquote, pre,
a, abbr, acronym, address, big, cite, code,
del, dfn, em, img, ins, kbd, q, s, samp,
small, strike, strong, sub, sup, tt, var,
b, u, i, center,
dl, dt, dd, ol, ul, li,
fieldset, form, label, legend,
table, caption, tbody, tfoot, thead, tr, th, td,
article, aside, canvas, details, embed, 
figure, figcaption, footer, header, hgroup, 
menu, nav, output, ruby, section, summary,
time, mark, audio, video {
    margin: 0;
    padding: 0;
    border: 0;
    font-size: 100%;
    font: inherit;
    vertical-align: baseline;
}
article, aside, details, figcaption, figure, 
footer, header, hgroup, menu, nav, section {
    display: block;
}
body {
    line-height: 1;
}
ol, ul {
    list-style: none;
}
blockquote, q {
    quotes: none;
}
blockquote:before, blockquote:after,
q:before, q:after {
    content: '';
    content: none;
}
table {
    border-collapse: collapse;
    border-spacing: 0;
}
/* Clearfix END */
body{
    font-family: 'Roboto', sans-serif;
}
    /*EMAIL-VENDOR*/
.vendor-con
{
  max-width: 600px;
  margin: auto;
}
/*EMAIL-RESET*/
.email-reset
{
  margin-top: 30px;
}
.email-reset img
{
  margin: auto;
  display: block;
  width: 350px;
}
.email-reset h4
{
  text-align: center;
  font-weight: 600;
  margin-top: 20px;
}
.reset-text
{
  margin-top: 40px;
}
.reset-text h4
{
  color: #1b455f;
  font-weight: 600;
  font-size: 24px;
  margin-bottom: 10px;
}
.reset-text p
{
  color: #000406;
opacity: 1;
line-height: 22px;
}
.reset-text h6
{
  text-align: center;
  font-weight: 600;
  margin-top: 40px;
}
.reset-text button,.reset-text button:focus
{
  margin: auto;
  display: block;
  margin-top: 30px;
  width: 160px;
  color: #fff !important;
height: 46px;
border-radius: 30px;
background: #1b455f;
border:none;
outline: none;
box-shadow: none;
font-size: 16px;
font-weight: 400;
letter-spacing: 1px;
}
.reset-text button:hover
{

  color: #fff;
  transition: 0.5s;
  background-color:#1b455fa3;
}

.footer-box
{
  background-color: #f5f5f5;
  padding: 10px;
  margin-top: 20px;
  height: 170px;
}
.email-footer h3
{
  margin-left: 35px;
  font-weight: 600;
  margin-bottom: 6px;
}
.email-footer p
{
  margin-left: 35px;
}
.social-icons-2
{
  line-height:1px;
}
.follow-section 
{
  float: right;
  width: 40%;
  margin-top: 36px;
}
.follow-section h6
{
  margin-bottom: 10px;
  font-size: 14px;
}
.follow-section h3 {
    color: #024990;
    font-size: 22px;
    font-weight: 600;
    margin-left: 0px;
}
.social-icons-2 a img
{
  margin-right: 10px;
  cursor: pointer;
}
.follow-section p
{
  margin-bottom: 10px;
  font-size: 14px;
  margin-top: 10px;
  margin-left: 0px;
}
.footer-detail
{
  width: 50%;
  float: left;
}
.order-detail
{
  margin-top: 30px;
  height: 200px;
  padding-bottom: 20px;
  /*border-bottom: 1px solid #000;*/
}
.order-info-img 
{
 width: 40%;
 float: left;
}
.order-info-img img
{
 width: 190px;
 height: 190px;
}
.order-info
{
  width: 60%;
  float: left;
}
.order-info h6
{
  margin-bottom: 10px;
}
.order-payment
{
 margin-top: 20px;
 height: 100px;
}
.payment-shiping h6
{
  margin-bottom: 10px;
}
.payment-shiping h6 span
{
  float: right;
}
@media (max-width: 599px) {
   .email-reset img
   {
    width: 280px;
   }
   .reset-text
   {
    padding: 10px;
   }
   .footer-detail img
   {
    margin: auto;
    display: block;
    margin-bottom: 14px;
    margin-top: -10px;
   }
   .email-footer h3
   {
    margin-left: 0px;
   }
   .email-footer p {
    margin-left: 0px; 
   }
   .follow-section {
    float: left;
    width: 100%;
    margin-top: 26px;
   }
   .footer-detail {
    width: 100%;
    float: left;
   }
   .footer-box
   {
    height: 280px;
   }
   .order-info-img img {
    width: 170px;
    height: 170px;
   }
}

@media (max-width: 476px) {
   .email-reset img
   {
    width: 280px;
   }
   .reset-text
   {
    padding: 10px;
   }
   .footer-detail img
   {
    margin: auto;
    display: block;
    margin-bottom: 14px;
    margin-top: -10px;
   }
   .email-footer h3
   {
    margin-left: 0px;
   }
   .email-footer p {
    margin-left: 0px; 
   }
   .follow-section {
    float: left;
    width: 100%;
    margin-top: 26px;
   }
   .footer-detail {
    width: 100%;
    float: left;
   }
   .footer-box
   {
    height: 280px;
   }
   .order-detail {
    height: 400px;
    padding-bottom: 20px;
    border-bottom: 1px solid #000;
    padding: 10px;
    margin-top: 0px;
   }
   .order-info-img
   {
    width: 100%;
   }   
   .order-info
   {
    margin-top: 12px;
    width: 100%;
   }
   .order-info-img img
   {
    margin: auto;
    display: block;
   }
   .order-payment
   {
    padding: 10px;
   }
}

    </style>
  </head>
  <body>

    <header>
      <div class="vendor-con">
        <div class="email-reset">
          <img src="https://orderpak.com/email_img/Logo.png" alt="">
          <h4>You have a New Order to process!</h4>
        </div>
      </div>
    </header>

    <section>
      <div class="vendor-con">
        <div class="reset-text">
          <h4>Dear Dealer,</h4>
          <p>You have received a new order in your seller account. Please process it now!</p>
        </div>
      </div>
    </section>
&nbsp;
<section>
      <div class="vendor-con">
        <div class="clearfix">
            <?php 
            $tprice=0;
            $tsprice=0;
            ?>
            
      @foreach($orders as $data)
      <div class="order-detail">
        <div class="order-info-img">
        <img src="https://orderpak.com/uploads/product_images/{{$data->product_img}}">
        </div>
        <div class="order-info">
          <h6>Order ID : <span>{{$data->order_id}}</span></h6>
          <h6>Product Name : <span>{{$data->product_name}}</span></h6>
          <h6>SKU : <span style="text-transform:uppercase">{{$data->vendor_id}}-{{$data->category_id}}-{{$data->product->product_sku}}</span></h6>
          @if($data->product_sale_price > 0)
          <?php $tprice += $data->product_sale_price * $data->quantity ?>
          <?php $tsprice += $data->product_sale_price * $data->quantity ?>
          <h6>Rs : <span>{{number_format($data->product_sale_price) }}</span></h6>
          @else
          <?php $tprice += $data->product_price * $data->quantity ?>
          <?php $tsprice += $data->product_price * $data->quantity ?>
          <h6>Rs : <span>{{number_format($data->product_price)}}</span></h6>
          @endif
          <h6>Qty : <span>{{$data->quantity}}</span></h6>
          @if($data->size != 'undefined')
          <h6>size : <span>{{$data->size}}</span></h6>
          @endif
          @if($data->color != 'undefined')
          <h6>color : <span>{{$data->color}}</span></h6>
          @endif
          <h6>Status : <span>{{$data->status}}</span></h6>
          <!--<h6>Address : <span>{{$data->address}}</span></h6>-->
          <!--@if($data->message)-->
          <!--<h6>Message : <span>{{$data->message}}</span></h6>-->
          <!--@endif-->
        </div>
      </div> 
      <hr>
      @endforeach
      <div class="order-payment">
        <div class="payment-shiping">
          <!--<h6>Shipping <span>Rs :{{$shipprice}}</span></h6>-->
          <h6>Subtotal <span>Rs : {{number_format($tprice)}}</span></h6>
          <h6>Total Amount <span>Rs : {{number_format($tsprice )}}</span></h6>
          <h6>Payment Method <span>Cash On Delivery</span></h6>
        </div>
      </div>
       </div>
      </div>
    </section>
    <footer>
     <div class="vendor-con">
       <div class="footer-box">
         <div class="clearfix">
           <div class="email-footer">
             <div class="footer-detail">
	           <img src="https://orderpak.com/email_img/Untitled-3-01.png" alt="">
	           <h3>Need more help? 24/7</h3>
	           <p>Call: 021 372 900 73</p>
	           <p>Email: info@orderpak.com</p>
             </div>
             <div class="follow-section">
              <h3>Follow Us</h3>
              <p>Office # 105, 1st Floor Asia Pacific Trade Center, Block 19 Gulistan e Johar, Karachi.</p>
              <div class="social-icons-2 mt-1">
                <a href="https://www.facebook.com/orderpak"><img src="https://orderpak.com/email_img/facebook.jpeg" alt=""></a>
                <a href="https://twitter.com/Orderpak1"><img src="https://orderpak.com/email_img/twitter.jpeg" alt=""></a>
                <a href="https://www.instagram.com/orderpak/"><img src="https://orderpak.com/email_img/instagram.jpeg" alt=""></a>
                <a href="https://www.linkedin.com/company/orderpak/"><img src="https://orderpak.com/email_img/linkedin.jpeg" alt=""></a>
                <a href="https://www.youtube.com/channel/UCyDqPl4IFrU74eboSa3h7rw"><img src="https://orderpak.com/email_img/youtube.jpeg" alt=""></a>
              </div>
            </div>
           </div>
         </div>
       </div>
     </div> 
    </footer>
  </body>
</html>