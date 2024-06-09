<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{__('email.reg_remind')}}</title>
</head>
<body>

<div class="container">
    <div class="alert alert-warning" role="alert">
        <h4 class="alert-heading">{{__('email.reg_remind')}}</h4>
        <p>{{__('email.not_reg_subject')}}</p>
        <ul>
            @foreach($student->registeredSubject as $subject)
                @if($subject->pivot->status != 'Registered')
                    <li>{{ $subject->name}}</li>
                @endif
            @endforeach
        </ul>
        <hr>
        <p class="mb-0">{{__('email.reg_link')}}</p>
        <a class="btn btn-success" href="{{route('formLogin')}}">{{__('email.reg_link_to')}}</a>
    </div>
</div>

</body>
</html>
