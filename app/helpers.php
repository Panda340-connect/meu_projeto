<?php

function base_url(): string
{
    $scriptDir = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? ''));
    $base = preg_replace('#/public$#', '', rtrim($scriptDir, '/'));
    return $base === '' ? '' : $base;
}

function url(string $path = ''): string
{
    $base = base_url();
    $path = ltrim($path, '/');
    return $path === '' ? ($base ?: '/') : "$base/$path";
}

function asset(string $path = ''): string
{
    $base = base_url();
    $path = ltrim($path, '/');
    return "$base/public/$path";
}

function e(?string $value): string
{
    return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
}

function format_date(?string $date): string
{
    if (empty($date)) {
        return '';
    }
    $timestamp = strtotime($date);
    return $timestamp ? date('d/m/Y', $timestamp) : e($date);
}

function format_time(?string $time): string
{
    if (empty($time)) {
        return '';
    }
    return substr($time, 0, 5);
}

function format_cpf(?string $cpf): string
{
    $digits = preg_replace('/\D/', '', (string) $cpf);
    if (strlen($digits) !== 11) {
        return e($cpf);
    }
    return preg_replace('/(\d{3})(\d{3})(\d{3})(\d{2})/', '$1.$2.$3-$4', $digits);
}

function view(string $view, array $data = []): void
{
    extract($data);
    $viewFile = __DIR__ . '/views/' . $view . '.php';
    ob_start();
    if (file_exists($viewFile)) {
        require $viewFile;
    }
    $content = ob_get_clean();
    require __DIR__ . '/views/layouts/main.php';
}