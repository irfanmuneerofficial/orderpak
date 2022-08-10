@foreach($subcategories as $subcategory)
    <option value="{{$subcategory->id}}" {{$subcategory->id == $subcategory->parent_id ? 'selected' : ''}}>{{$dashes}} {{(isset($subcategory->title)) ? $subcategory->title : ''}}</option>
    @if(count((array)$subcategory->childCategories))
        @php $newDashes = $dashes . '--' @endphp
        @include('admin.partials.subcategoryListOption',['subcategories' => $subcategory->childCategories, 'dashes' => $newDashes])
    @endif
@endforeach
