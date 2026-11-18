<?php

namespace App\Controllers;

use App\Models\Usuario;
use App\Validators\UsuarioValidator;

require_once __DIR__ . '/../models/Usuario.php';
require_once __DIR__ . '/../validators/UsuarioValidator.php';

class MedicamentoController {
     private function render(string $view, array $data = []): void
    {
        extract($data);
        $viewFile = __DIR__ . '/../views/' . $view . '.php';
        ob_start();
        if (file_exists($viewFile)) {
            require $viewFile;
        }
        $content = ob_get_clean();
        require __DIR__ . '/../views/layouts/main.php';
    }

    public function index(): void
    {
        $usuarios = Usuario::all();

        $this->render('medicamentos/index', [
            'title'    => 'Usuários Cadastrados',
            'usuarios' => $usuarios
        ]);
    }

    public function create(): void
    {
        $usuarios = Usuario::all();

        $this->render('medicamentos/form', [
            'title'    => 'Usuários Cadastrados',
            'usuarios' => $usuarios
        ]);
    }

}