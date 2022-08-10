

{{-- @foreach($subcategories as $subcategory)
        <tr>
            <td data-column="name">{{$subcategory->name}}</td>
        </tr>
	    @if(count($subcategory->childCategories))
            @include('backend.admin.partials.subcategoryList',['subcategories' => $subcategory->childCategories, 'dataParent' => $subcategory->id, 'dataLevel' => $dataLevel ])
        @endif
@endforeach --}}

<tr>
    <td>
        {{ $productCategory->id ?? '' }}
    </td>
    <td>
        {{ $prefix ?? '' }} {{ $productCategory->title ?? '' }}
    </td>
    {{-- <td>
        {{ $productCategory->description ?? '' }}
    </td> --}}
    <td>
        @if($productCategory->category_img)
            @if(App\Models\Categories::fileExit('uploads/category', $productCategory->category_img))
            {{-- @if( file_exists( "{{ asset('uploads/category').'/'.$productCategory->category_img }}"  ) ) --}}
                <img src="{{ asset('uploads/category').'/'.$productCategory->category_img }}" width="70px">
            @endif
        @endif
    </td>
    <td>
        @if($productCategory->category_icon)
            @if(App\Models\Categories::fileExit('uploads/category', $productCategory->category_icon))
            {{-- @if( file_exists( "{{ asset('uploads/category').'/'.$productCategory->category_icon }}"  ) ) --}}
                <img src="{{ asset('uploads/category').'/'.$productCategory->category_icon }}" width="70px">
            @endif
        @endif
    </td>
    <td>
        {{ $productCategory->parentCategory->name ?? '' }}
    </td>
    <td>
        {{ $productCategory->slug ?? '' }}
    </td>
    <td>
        {{-- @can('product_category_show')
            <a class="btn btn-xs btn-primary" href="{{ route('admin.product-categories.show', $productCategory->id) }}">
                {{ trans('global.view') }}
            </a>
        @endcan --}}

        {{-- @can('product_category_edit') --}}
            <a class="btn btn-sm btn-info" href="/admin/category/{{ $productCategory->id }}/edit">
                Edit
            </a>
        {{-- @endcan --}}

        {{-- @can('product_category_delete') --}}
            {{-- <form action="{{ route('admin.categories.destroy', $productCategory->id) }}" method="POST" onsubmit="return confirm('{{ trans('Are you sure?') }}');" style="display: inline-block;">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="submit" class="btn btn-sm btn-danger" value="Delete">
            </form> --}}
            <form method="post" action="/admin/category/{{ $productCategory->id }}/">
                {{ csrf_field() }}
                {{ method_field('delete') }}
                <button type="submit" onclick="return confirm('Are you sure want to delete this?')" class="btn btn-danger btn-sm" style="font-size: 0.8em;">Delete</button>
              </form>
        {{-- @endcan --}}

    </td>

</tr>
