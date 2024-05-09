@if(!empty(session('success')))
    <div id="successAlert" class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(!empty(session('error')))
    <div id="errorAlert" class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

@if(!empty(session('success_reset')))
    <div id="successAlert" class="alert alert-success">
        {{ session('success_reset') }}
    </div>
@endif

@if(!empty(session('error_reset')))
    <div id="errorAlert" class="alert alert-danger">
        {{ session('error_reset') }}
    </div>
@endif

@if ($errors->any())
    <div id="validateAlert" class="alert alert-danger" style="height: auto">
        <ul>
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </ul>
    </div>
@endif