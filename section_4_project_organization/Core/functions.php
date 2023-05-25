<?php

function urlIs($value) {
    return $_SERVER['REQUEST_URI'] === $value;
}

function dd($value) {
    echo "<pre>";
    var_dump($value);
    echo "</pre>";
    die();
}

function authorize(bool $condition, int $status = Response::FORBIDDEN)
{
    if (! $condition) {
        abort($status);
    }
}

function base_path($path)
{
    return BASE_PATH . $path;
}

function view($path, $attributes = [])
{
    //Extrai um array associativo e disponibiliza em forma de variaveis, que podem ser acessadas no momento da carga de um .php
    extract($attributes);
    require base_path('views/' . $path);
}
