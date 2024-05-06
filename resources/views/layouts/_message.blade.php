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

@if ($errors->any())
    <div id="validateAlert" class="alert alert-danger" style="height: auto">
        <ul>
            @foreach ($errors->all() as $error)
                <div>
                    <span>{{ __('validation.'.$error) }}</span>
                </div>
            @endforeach
        </ul>
    </div>
@endif
