<?php

/**
 * Standard view template to generate a simple web page, or part of a web page.
 */

declare(strict_types=1);

?><!doctype html>
<html>
    <meta charset="utf-8">
    <title><?= $title ?? "No title" ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('favicon.ico') }}" >
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
</head>

<body>

<header>
    <nav>
        <a href="<?= url("/") ?>">Home</a> |

        <a href="<?= url("/info") ?>">Info</a> |
        <a href="<?= url("/dice") ?>">Dice</a> |
        <a href="<?= url("/game21") ?>">Game 21</a> |
        <a href="<?= url("/yatzy") ?>">Yatzy</a> |
        <a href="<?= url("/books") ?>">Books</a> |
        <a href="<?= url("/highscore") ?>">Highscore</a>
    </nav>
</header>
<main>
