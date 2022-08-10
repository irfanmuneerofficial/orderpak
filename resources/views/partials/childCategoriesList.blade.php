@foreach($subcategories as $prow)

    <li>
        <a href="/category/{{$prow->parentCategory->slug}}/{{ $prow->slug }}">{{ $prow->title }}
        </a>
    </li>
    @if($prow->childCategories->count() > 0)
        @include('partials.childCategoriesList', ['subcategories' => $prow->childCategories])
    @endif
@endforeach