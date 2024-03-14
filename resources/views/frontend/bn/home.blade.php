@extends('frontend.bn.app')

@section('title', cache('bnSiteSettings')->title)

@section('customMeta')
    <meta content="300" http-equiv="refresh">
    <meta name="description" content="{{ Cache::get('bnSiteSettings')->meta_description }}"/>
    <link rel="canonical" href="{{url('/')}}">
    <meta name="keywords" content="{{ Cache::get('bnSiteSettings')->meta_keyword }}">

    <meta property="og:type" content="website"/>
    <meta property="og:url" content="{{ url('/') }}"/>
    <meta property="og:title" content="{{ Cache::get('bnSiteSettings')->title }}"/>
    <meta property="og:image" content="{{ asset(config('appconfig.commonImagePath').Cache::get('bnSiteSettings')->og_image) }}"/>
    <meta property="og:description" content="{{ Cache::get('bnSiteSettings')->meta_description }}"/>

    <meta name="twitter:title" content="{{ Cache::get('bnSiteSettings')->title }}">
    <meta name="twitter:description" content="{{ Cache::get('bnSiteSettings')->meta_description }}">
    <meta name="twitter:image" content="{{ asset(config('appconfig.commonImagePath').Cache::get('bnSiteSettings')->og_image) }}">

    <script type="application/ld+json" data-schema="Organization">{
        "@context":"https://schema.org",
        "@type":"Organization",
        "name":"DhakaProkash24.com",
        "alternateName":"Dhaka Prokash",
        "description": "{{ C