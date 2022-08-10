<ul>
    @foreach($childs as $child)
        <li>
            {{ $child->title }}
        @if(count($child->parents))
                @include('admin.partials.shipping.manageChild',['childs' => $child->parents])
            @endif
        </li>
    @endforeach
    </ul>