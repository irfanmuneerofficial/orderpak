<div>
    <div class="alert alert-{{ $type }} alert-dismissible fade show cs-admin_alert" role="alert">
        @if($type == "danger")
            <p><strong>Sorry! </strong> There were more problems.</p>
            <ul>
                @foreach ($message->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @elseif($type == "success")
            {{ session('success') }}
        @endif
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
</div>