@extends('layouts.site')

@section('content')
    <div class="container">
        <div class="row">
            <subscription-create
                    :plan="{{json_encode($plan->toArray())}}"
                    csrf-token="{{csrf_token()}}"
                    action="{{route('site.subscriptions.store')}}"
            >

            </subscription-create>
        </div>
    </div>
@endsection