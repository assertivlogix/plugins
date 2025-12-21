@extends('layouts.frontend')

@section('title', 'Test Page')

@section('content')
<div class="container">
    <h1>Test Page</h1>
    <p>If you can see this, the basic routing works.</p>
    @if(isset($plugin))
        <h2>Plugin Data Found:</h2>
        <pre>{{ print_r($plugin, true) }}</pre>
    @else
        <h2>No plugin data found</h2>
    @endif
</div>
@endsection
