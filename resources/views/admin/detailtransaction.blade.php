@extends('admin.adminlayout')
@section('transaction','active')
@section('header','Transaction')

@section('content')
<div class="row">
    <div class="col-md-6">
        Date : 
    </div>
    <div class="col-md-6">
        {{ $data->created_at }}
    </div>
</div>
{{--  --}}
@endsection
