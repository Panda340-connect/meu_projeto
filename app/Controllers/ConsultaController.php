<?php

namespace App\Controllers;

use App\Models\Consulta;
use App\Validators\ConsultaValidator;

require_once __DIR__ . '/../models/Consulta.php';
require_once __DIR__ . '/../validators/ConsultaValidator.php';

class ConsultaController
{
    private function render(string $view, array $data = []): void
    {
        extract($data);
        $viewFile = __DIR__ . '/../views/' . $view . '.php';
        ob_start();
        require $viewFile;
        $content = ob_get_clean();
        require __DIR__ . '/../views/layouts/main.php';
    }

    public function index(): void
    {
        $consultas = Consulta::all();
        $this->render('consultas/index', [
            'title'     => 'Consultas Médicas',
            'consultas' => $consultas
        ]);
    }

    public function create(): void
    {
        $usuarios = Consulta::getUsuarios();
        $this->render('consultas/form', [
            'title'    => 'Agendar Consulta',
            'usuarios' => $usuarios,
            'errors'   => [],
            'old'      => []
        ]);
    }

    public function store(): void
    {
        $data = $_POST;
        $errors = ConsultaValidator::validate($data);

        if (!empty($errors)) {
            $usuarios = Consulta::getUsuarios();
            $this->render('consultas/form', [
                'title'    => 'Agendar Consulta',
                'usuarios' => $usuarios,
                'errors'   => $errors,
                'old'      => $data
            ]);
            return;
        }

        Consulta::create($data);
        header('Location: ' . url('consulta/index'));
        exit;
    }
}