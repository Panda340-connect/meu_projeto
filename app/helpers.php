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