<?php

namespace App\Controllers;

use App\Models\Usuario;
use App\Validators\UsuarioValidator;

class UsuarioController
{
    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

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
            'title' => 'Listagem de Usuários',
            'usuarios' => $usuarios,
        ]);
    }

    public function create(): void
    {
        $csrf = $_SESSION['csrf'] ?? '';
        $old = $_SESSION['old'] ?? [];
        $errors = $_SESSION['errors'] ?? [];

        unset($_SESSION['old'], $_SESSION['errors']);

        $this->render('usuarios/form', [
            'title' => 'Novo Usuário',
            'csrf' => $csrf,
            'old' => $old,
            'errors' => $errors,
        ]);
    }

    public function store(): void
    {
        $data = $_POST;
        $errors = UsuarioValidator::validate($data, false);

        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            $_SESSION['old'] = $data;
            header('Location: ' . url('usuario/create'));
            exit;
        }

        Usuario::create($data);
        header('Location: ' . url('usuario/index'));
        exit;
    }

    public function edit(int $id): void
    {
        $usuario = Usuario::find($id);

        if (!$usuario) {
            header('Location: ' . url('usuario/index'));
            exit;
        }

        $csrf = $_SESSION['csrf'] ?? '';
        $old = $_SESSION['old'] ?? $usuario;
        $errors = $_SESSION['errors'] ?? [];

        unset($_SESSION['old'], $_SESSION['errors']);

        $this->render('usuarios/edit', [
            'title' => 'Editar Usuário',
            'usuario' => $usuario,
            'csrf' => $csrf,
            'old' => $old,
            'errors' => $errors,
        ]);
    }

    public function update(int $id): void
    {
        $data = $_POST;
        $errors = UsuarioValidator::validate($data, true);

        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            $_SESSION['old'] = $data;
            header('Location: ' . url('usuario/edit/' . $id));
            exit;
        }

        Usuario::update($id, $data);
        header('Location: ' . url('usuario/index'));
        exit;
    }

    public function delete(int $id): void
    {
        Usuario::delete($id);
        header('Location: ' . url('usuario/index'));
        exit;
    }
}