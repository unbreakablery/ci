<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Game21">
    <meta name="author" content="Benaris Hajduk">
    <meta name="robots" content="noindex, nofollow">

    <title>{{ $pageName }}</title>

    <link rel="shortcut icon" href="{{ asset('/favicon.ico') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('/favicon.ico') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/style.css') }}">
</head>

<body>

<header>
    <nav>
        <a href="{{ route('landing-page') }}" class="@if (isset($menuHomeClass) && $menuHomeClass == 'selected') selected @endif">Home</a>
        <a href="{{ route('game21') }}" class="@if (isset($menuGame21Class) && $menuGame21Class == 'selected') selected @endif">Game 21</a>
        <a href="{{ route('game21-view-history') }}" class="@if (isset($menuHistoryClass) && $menuHistoryClass == 'selected') selected @endif">Game History</a>
        <a href="{{ route('game21-view-highscores') }}" class="@if (isset($menuHighscoresClass) && $menuHighscoresClass == 'selected') selected @endif">High Scores</a>
        <a href="{{ route('books') }}" class="@if (isset($menuBooksClass) && $menuBooksClass == 'selected') selected @endif">Books</a>
    </nav>
</header>
<main>