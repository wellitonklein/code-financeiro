@extends('layouts.site')

@section('content')
    <div class="container">
        <div class="row">
            <subscription-create
                    :plan="{{json_encode($plan->toArray())}}"
            >

            </subscription-create>
        </div>
    </div>
@endsection