<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{__('email.acc_notifyTittle')}}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
</head>
<body>
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">{{__('email.account_notify-heading')}}</h2>
        </div>
        <div class="card-body">
            <p class="card-text">{{__('email.account_notify-des')}}</p>
            <ul class="list-group">
                <li class="list-group-item"><strong>{{__('email.account_notify-id')}}</strong>{{$user->email}}</li>
                <li class="list-group-item"><strong>{{__('email.account_notify-pw')}}</strong> {{$user->password}}</li>
            </ul>
            <p>{{__('email.account_notify-wn')}}</p>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-KyZXEAg3QhqLMpG8r+Knujsl5+z7Gt1x6I8PLy+1vrcZ5o+q0c5j2rTBm+Jh1Q6J"
        crossorigin="anonymous"></script>
</body>
</html>
