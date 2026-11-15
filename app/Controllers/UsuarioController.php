<?php

namespace App\Controllers;

use App\Models\Usuario;
use App\Validators\UsuarioValidator;

require_once __DIR__ . '/../models/Usuario.php';
require_once __DIR__ . '/../validators/UsuarioValidator.php';

class UsuarioController
{
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
        $this->render('usuarios/index', [
            'title'    => 'Usuários Cadastrados',
            'usuarios' => $usuarios
        ]);
    }

    public function create(): void
    {
        $this->render('usuarios/form', [
            'title'  => 'Novo Usuário',
            'errors' => [],
            'old'    => []
        ]);
    }

    public function store(): void
    {
        $data = $_POST;
        $errors = UsuarioValidator::validate($data);

        if (!empty($errors)) {
            $this->render('usuarios/form', [
                'title'  => 'Novo Usuário',
                'errors' => $errors,
                'old'    => $data
            ]);
            return;
        }

        Usuario::create($data);
        header('Location: ' . url('usuario/index'));
        exit;
    }

    public function edit(int $id = 0): void
    {
        $id = $id ?: (int) ($_GET['id'] ?? 0);
        $usuario = Usuario::find($id);

        $this->render('usuarios/edit', [
            'title'   => 'Editar Usuário',
            'usuario' => $usuario,
            'errors'  => []
        ]);
    }

    public function update(int $id = 0): void
    {
        $id = $id ?: (int) ($_POST['id'] ?? $_GET['id'] ?? 0);
        $data = $_POST;
        Usuario::update($id, $data);
        header('Location: ' . url('usuario/index'));
        exit;
    }

    public function delete(int $id = 0): void
    {
        $id = $id ?: (int) ($_POST['id'] ?? $_GET['id'] ?? 0);
        if ($id > 0) {
            Usuario::delete($id);
        }
        header('Location: ' . url('usuario/index'));
        exit;
    }
}