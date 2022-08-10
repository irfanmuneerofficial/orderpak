@extends('layouts.master')
@section('title')
Tracking
@endsection
@section('mainContent')

<style>
    .table-bordered td {
        text-align: center;
    }
    .shipment-table td.title {
        color: #f26522 !important;
    }
</style>

<section>
      <div class="container">
        <div class="order-aboutus">
          <div class="col-md-12">
            <h1>Tracking Result</h1>
          </div>
        </div>
        <nav aria-label="breadcrumb">
          <ol itemscope itemtype="https://schema.org/BreadcrumbList" class="breadcrumb custom-breadcrumb justify-content-center">
            <li itemprop="itemListElement" itemscope
              itemtype="https://schema.org/ListItem" class="breadcrumb-item breadcrumb-item1">
              <a itemprop="item" href="{{ url('/') }}">
                <span itemprop="name">Home</span>
              </a>
              <meta itemprop="position" content="1" />
            </li>
            <li itemprop="itemListElement" itemscope
              itemtype="https://schema.org/ListItem" class="breadcrumb-item breadcrumb-item1 active" aria-current="page">
              <span itemprop="name">Tracking Result</span>
              <meta itemprop="position" content="2" />
            </li>
          </ol>
        </nav>
      </div>
    </section>
  
    &nbsp;
<section>
<div class="container">
 
  @if($tracking[0]->isSuccess == 'true')
        <div class="row">
            <div class="col-md-12">
          
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered ">
                            <tbody>
                                <tr>
                                    <td data-title="Booking" class="title">
                                        <strong> Booking Date :</strong>
                                    </td>
                                    <td data-title="Date">
                                        {{ $tracking[0]->tracking_Details[0]->BookingDate }}                          
                                    </td>
                                    <td data-title="consignmentNumber" class="title">
                                        <strong> Consignment Number:</strong>
                                    </td>
                                    <td data-title="Cn">
                                        {{ $tracking[0]->tracking_Details[0]->CN }}                          
                                    </td>
                                    <td data-title="From -> To" class="title">
                                        <strong> From -&gt; To </strong>
                                    </td>
                                    <td data-title="destination" class="numeric">
                                    {{ $tracking[0]->tracking_Details[0]->Origin }} -&gt; {{ $tracking[0]->tracking_Details[0]->Destination }}                         
                                    </td>
                                </tr>
                                <tr>
                                    <td data-title="Booking" class="title">
                                        <strong> International Tracking No :</strong>
                                    </td>
                                    <td data-title="Date"></td>
                                </tr>
                            </tbody>
                            </table>
                        </div>
                    </div>
                </div>
    

        <div class="row">
            <div class="col-md-12">
           
                        <div class="table-responsive shipment-details">
                            <h4>Shipment Details</h4>
                            <table class=" table table-hover  table-bordered cf shipment-table">
                                <tbody>
                                <tr class="fact_table_row dark">
                                    <td data-title="shipper" class="title">Shipper:</td>
                                    <td data-title="shipper-name">
                                        {{ $tracking[0]->tracking_Details[0]->Shipper }}                        
                                    </td>
                                    <td data-title="consignee" class="title" >Shipper Address:</td>
                                    <td data-title="consignee-name" colspan="5">
                                        {{ $tracking[0]->tracking_Details[0]->ShipperAdd ? $tracking[0]->tracking_Details[0]->ShipperAdd : 'Plot No. 219, Street No. 7, Sector i-9/2, Industrial Area, Islamabad' }}                        
                                    </td>

                                </tr>
                                <tr class="fact_table_row dark">
                                    <td data-title="shipper" class="title">Consignee:</td>
                                    <td data-title="shipper-name">
                                        {{ $tracking[0]->tracking_Details[0]->Consignee }}                        
                                    </td>

                                    <td data-title="consignee" class="title">Weight</td>
                                    <td data-title="consignee-name">
                                        {{ $tracking[0]->tracking_Details[0]->weight }} KG                       
                                    </td>
                                    <td data-title="consignee" class="title">Pieces</td>
                                    <td data-title="consignee-name">
                                        {{ $tracking[0]->tracking_Details[0]->pieces }}                       
                                    </td>
                                    <td data-title="consignee" class="title">Service Type</td>
                                    <td data-title="consignee-name">
                                        {{ $tracking[0]->tracking_Details[0]->ServiceType }}                        
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
            </div>
        </div>

        <div class="row">
          <div class="col-md-12">
     
              <div class="table-responsive">
                <h4>Tracking History</h4>
                <table id="" class="table table-hover table-bordered">
                  <thead>
                  <tr>
                    <th style="background: #f26522;color: #FFF;text-align:center;">Date & Time</th>
                    <th style="background: #f26522;color: #FFF;text-align:center;">Location</th>
                    <th style="background: #f26522;color: #FFF;text-align:center;">Status</th>
                    <th style="background: #f26522;color: #FFF;text-align:center;">Detail Status</th>
                  </tr>
                  </thead>
                  <tbody id="tbody">
                    @foreach($tracking[0]->tracking_Details[0]->Details as $detail)
                    <tr>
                      <td>{{ $detail->DateTime }}</td>
                      <td>{{ $detail->Location }}</td>
                      <td>{{ $detail->Status }}</td>
                      <td>{{ $detail->Detail }}</td>
                    </tr>  
                    @endforeach
                </tbody>
            </table>
                </div>
         
          </div>
          <!-- /.col -->
        </div>
        @else
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <span style="color:red;">{{ $tracking[0]->message }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <a href="{{ url()->previous() }}">
                        <button class="btn btn-info">Back</button>
                    </a>
                </div>
            </div>

        @endif
</div>
</section>
@endsection