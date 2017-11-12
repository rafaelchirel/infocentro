@if (count($errors) > 0 )
<ul>
    <div class="alert alert-danger">
        @foreach($errors->all() as $error)
        <li class="text-left">
            {{ $error }}
        </li>
        @endforeach
    </div>
</ul>
@endif