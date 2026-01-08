@extends('layouts.frontend')

@section('title', $plugin['name'] . ' - Assertivlogix')

@section('content')
@include('plugins.plugin-template', [
    'plugin' => $plugin,
    'hero_color' => '#8b5cf6',
    'hero_color_dark' => '#034f61',
    'hero_color_darker' => '#6d28d9',
    'feature_color' => '#8b5cf6',
    'feature_color_dark' => '#034f61',
    'benefit_color' => '#10b981',
    'benefit_color_dark' => '#059669',
    'plugin_category' => 'Security',
    'cta_action' => 'Secure Your Website'
])
@endsection
