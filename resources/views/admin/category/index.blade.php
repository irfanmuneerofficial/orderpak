@extends('admin.layouts.master')

@section('page-title')
    Categories List
@endsection

@section('mainContent')
<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-12">
                    @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <span>{{ $message }}</span>
                    </div>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 margin-tb mt-3">
                    <div class="pull-right mb-2">
                        <a class="btn btn-primary" href="{{route('category.create')}}"> Add New</a>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card card-dark">
                        <h5 class="card-header">Categories List</h5>
                        <div class="card-body">
                            <table id="categories_table" class="table table-bordered table-striped table-hover datatable datatable-ProductCategory">
                                <thead>
                                    <tr>
                                        <th>
                                            ID
                                        </th>
                                        <th>
                                            Title
                                        </th>
                                        <th>
                                            Category Image
                                        </th>
                                        <th>
                                            Category Icon
                                        </th>
                                        <th>
                                            Parent
                                        </th>
                                        <th>
                                            Slug
                                        </th>
                                        <th>
                                            Actions
                                        </th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @php $newDashes = '' @endphp
                                    @foreach($categories as $key => $productCategory)
                                        @include('admin.partials.subcategoryList', compact('productCategory'))

                                        @if(count((array)$productCategory->childCategories))


                                            {{-- @foreach($productCategory->childCategories as $childCategory) --}}
                                                @include('admin.partials.childCategoriesIterates', ['subcategories' => $productCategory->childCategories, 'prefix' => '---'])
                                            {{-- @endforeach --}}
                                        @endif
                                            {{-- @foreach($childCategory->childCategories as $childCategory)
                                                @include('backend.admin.partials.subcategoryList', ['productCategory' => $childCategory, 'prefix' => '----'])
                                                    @foreach($childCategory->childCategories as $childCategory)
                                                        @include('backend.admin.partials.subcategoryList', ['productCategory' => $childCategory, 'prefix' => '----'])
                                                    @endforeach
                                            @endforeach --}}

                                    @endforeach
                                </tbody>
                            </table>
                            {{-- {!! $categories->render() !!} --}}


                        </div>
                    </div>
                </div>
            </div>
                
        </div>
    </section>
</div>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
@endsection

@push('category_list-page-script')
<script>

    $("#categories_table").DataTable({
        "responsive": true,
        "autoWidth": false,
        "ordering": false,
    });
    
</script>
@endpush
