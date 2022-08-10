@extends('layouts.master')
@section('mainContent')
          <div class="join-pagination">
            <span><a href="index.html">Home</a> ></span>
            <span>join orderpak</span>
          </div>
  <form  class="form-back">
    <img class="join-logo" src="/frontend/assets/img/Logo.png" alt="Online Shopping in Pakistan with Free Home Delivery">
    <div id="heading" class="order-heading">
      <h1>Register a Buisness account</h1>
      <h4>or</h4>
      <a href="joinuser.html">create personal Account</a>
    </div>
  <div class="join-bullets ">
    <span class="step"></span>
    <span class="step"></span>
  </div>

  
  
  <div class="tab join-input-4">
    <h2>welcome to your next level business journey</h2>
    <img class="animate__animated animate__fadeIn" src="/frontend/assets/img/vender.png">
    <div class="order-buttons">
    <div class="row">
      <div class="col-lg-6 col-md-6 col-sm-12">
        <div class="vender-btn">
          <button type="button" class="btn btn-light">Back to Home</button>
        </div>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-12">
        <div class="vender-btn-2">
         <button type="button" class="btn btn-light">Go to your dashboard</button>
        </div>
      </div>
    </div>
    </div>
  </div>
  <div style="overflow:auto;">
    <div style="text-align: center;">
      {{-- <button type="button" id="prevBtn" class="test" onclick="nextPrev(-1)">Previous</button> --}}
      {{-- <button  type="button" id="nextBtn" onclick="nextPrev(1)">Continue</button> --}}
    </div>
  </div>
</form>  
@endsection

