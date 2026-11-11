<?php

namespace App\Controllers;

use App\Models\Consulta;

class ConsultaController
{
    public function index(): void
    {
        $this->render('consultas/index', [
            'title' => 'Consultas Médicas',
        ]);
    }

    private function render(string $view, array $data = []): void
    {
        $base = __DIR__ . '/../Views/';
        $renderFile = static function (string $file, array $data): string {
            extract($data, EXTR_SKIP);
            ob_start();
            require $file;
            return ob_get_clean();
        };

        $content = $renderFile($base . $view . '.php', $data);
        $vars = $data + ['content' => $content];
        echo $renderFile($base . 'layouts/main.php', $vars);
    }
}