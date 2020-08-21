@extends('layouts.app')
{{----------------------------------------------------------------------------------------------------}}
@push('meta')
    <title>Your Balance</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
@endpush
{{----------------------------------------------------------------------------------------------------}}
@section('content')

    <users-balance :spendings="{{$data}}"></users-balance>

@endsection
{{----------------------------------------------------------------------------------------------------}}
