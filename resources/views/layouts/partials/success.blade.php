@if(Session::has('success'))
    <div class="alert alert-success">
        <h4>
            Awesome!
        </h4>

        <ul>
            @foreach(Session::get('success') as $message)
                <li>
                    {{ $message }}
                </li>
            @endforeach
        </ul>
    </div>
@endif