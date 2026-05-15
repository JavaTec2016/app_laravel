@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    @include('indexContent')
@stop

@section('css')
    {{-- Extra CSS here --}}
@stop

@section('js')
    <script>
        console.log("AdminLTE dashboard loaded.");
    </script>
@stop
{{-- Hidden logout form --}}
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none">
    @csrf
</form>

{{-- Intercept the sidebar link click --}}
@push('js')
<script>
    document.querySelector('.logout-menu-item').addEventListener('click', function(e) {
        e.preventDefault();
        document.getElementById('logout-form').submit();
    });
</script>
@endpush
