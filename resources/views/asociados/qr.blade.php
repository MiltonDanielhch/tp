@extends('template.print-alt')

@section('page_title', 'QR')
@section('content')
<div class="qr">{!! $qr !!}</div>    
@endsection

@section('css')
<style>
.qr{
    text-align: center;
    padding: 20px 0px;
}
</style>
@endsection
