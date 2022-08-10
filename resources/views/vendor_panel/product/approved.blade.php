@extends('vendor_panel.layouts.master')
@section('title')
Approved Product
@endsection
@section('mainContent')
<section class="content">
    
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>ID</th>
                <th>Product Title</th>
                <th>Product SKU</th>
                <th>Price</th>
                <th>Approval</th>
                <th>Status</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @foreach($products as $product)
              <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->title }}</td>
                {{-- <td>{{ $product->brand->title }}</td> --}}
                <td style="text-transform:uppercase;">{{$product->vendor_id}}-{{$product->category_id}}-{{ $product->product_sku }}</td>
                <td>{{ $product->price }}</td>
                <td class="project-state">
                  @if($product->admin_status == 'APPROVED')
                  <span class="badge badge-success">{{ $product->admin_status }}</span>
                  @elseif($product->admin_status == 'PENDING')
                  <span class="badge badge-warning">{{ $product->admin_status }}</span>
                  @else
                  <span class="badge badge-danger">{{ $product->admin_status }}</span>
                  @endif
                </td>
                <td class="project-state">
                  @if($product->vendor_status=='DEACTIVE')
                    <a href="/vendor/status/{{$product->id}}" class="badge badge-danger btn-sm">
                      DEACTIVE
                    </a>
                  @else
                  <a href="/vendor/status/{{$product->id}}" class="badge badge-success btn-sm">
                    ACTIVE
                  </a>
                  @endif
                </td>
                <td class="project-actions text-right">
                  <a class="badge badge-success btn-sm" href="/product/{{$product->slug}}" target="blank">
                    <i class="fas fa-eye">
                    </i>
                    View
                  </a>                        
                  <a class="badge badge-info btn-sm" href="/vendor/product/{{ $product->id }}/edit">
                  <i class="fas fa-pen">
                  </i>
                  Edit
                </a>
                <form id="formDelete" name="formDelete" method="post" action="{{ url('/vendor/product/').'/'.$product->id }}/">
                  @csrf
                  {{ @method_field('delete') }}
                  <button type="submit" class="badge badge-danger btn-sm">
                    <i class="fas fa-trash">
                    </i>
                    Delete
                  </button>
                  {{-- <a class="btn btn-danger btn-sm" href="#"> --}}
                  {{-- </a> --}}
                </form>
              </td>
            </tr>
            @endforeach
          </tbody>
          <tfoot>
          <tr>
            <th>ID</th>
            <th>Product Title</th>
            <th>Product SKU</th>
            <th>Price</th>
            <th>Approval</th>
            <th>Status</th>
            <th></th>
          </tr>
          </tfoot>
        </table>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
  <!-- /.col -->
</div>
<!-- /.row -->
</section>

@endsection