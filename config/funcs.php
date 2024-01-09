<?php


function dump($data)
{
    echo '<pre>';
    var_dump($data);
    '</pre>';
}
function dd($data)
{
    dump($data);
    die;
}

function printR($data)
{
    echo '<pre>';
    print_r($data);
    '</pre>';
}


function validField($fillable): array
{
    $data = [];
    foreach ($_POST as $key => $value) {
        if (in_array($key, $fillable)) {
            $data[$key] = h(trim($value));
        }
    }
    return $data;
}
function h($data): string
{
    return htmlspecialchars($data, ENT_QUOTES);
}
function old($data)
{
    foreach ($_POST as $key => $value) {
        if ($key === $data) {
            return $value;
        }
    }
    return '';
}
