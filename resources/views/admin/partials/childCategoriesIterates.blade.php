
@foreach($subcategories as $productCategory)
    <tr data-entry-id="{{ $productCategory->id }}">
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
            {{-- @if($productCategory->photo)
                <a href="{{ $productCategory->photo->getUrl() }}" target="_blank">
                    <img src="{{ $productCategory->photo->getUrl('thumb') }}" width="50px" height="50px">
                </a>
            @endif --}}
            @if($productCategory->category_img)
                @if( App\Models\Categories::fileExit('uploads/category', $productCategory->category_img))
                    <img src="{{ asset('uploads/category').'/'.$productCategory->category_img }}" width="70px">
                @endif
            @endif
        </td>
        <td>
            @if($productCategory->category_icon)
                @if( App\Models\Categories::fileExit('uploads/category', $productCategory->category_icon))
                    <img src="{{ asset('uploads/category').'/'.$productCategory->category_icon }}" width="70px">
                @endif
            @endif
        </td>
        <td>
            {{ $productCategory->parentCategory->title ?? '' }}
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
        @if(count($productCategory->childCategories))
            @php $newDashes = $prefix . '--' @endphp
            @include('admin.partials.childCategoriesIterates',['subcategories' => $productCategory->childCategories, 'prefix' => $newDashes ])
        @endif
    @endforeach
