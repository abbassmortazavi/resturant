@extends('layouts.app')

@section('content')
<div class="container">
    <menu-container :items="{{{ json_encode($categories) }}}"></menu-container>
</div>
@endsection
