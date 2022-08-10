<?php $dash.='-- '; ?>
@foreach($subcategories as $subcategory)
    @if($category->id != $subcategory->id )
        <option value="{{$subcategory->id}}" @if($category->parent_id == $subcategory->id ) selected @endif >
        	{{$dash}}{{$subcategory->title}}
        </option>
    @endif
    @if(count($subcategory->childCategories))
        @include('admin.partials.sub-category-list-option-for-update',['subcategories' => $subcategory->childCategories])
    @endif
@endforeach
