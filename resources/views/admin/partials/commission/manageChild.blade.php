<ul>
    @foreach($childs as $child)
        <li>
            @if($child->commission)
                {{ $child->title }} {{ $child->commission->rate }}
            @else
                {{ $child->title }}
            @endif
        @if(count($child->childCategories))
                @include('admin.partials.commission.manageChild',['childs' => $child->childCategories])
            @endif
        </li>
    @endforeach
</ul>