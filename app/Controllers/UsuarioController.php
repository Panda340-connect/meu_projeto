<?php

namespace App\Controllers;

use App\Models\Usuario;
use App\Validators\UsuarioValidator;

class UsuarioController
{
    public function index(): void
    {
        $usuarios = Usuario::all();
        $title = "Listagem de Usuários";
        
        require __DIR__ . '/../views/usuarios/index.php';
    }

    public function create(): void
    {
        $title = "Novo Usuário";
        $csrf = $_SESSION['csrf'] ?? '';
        $old = $_SESSION['old'] ?? [];
        $errors = $_SESSION['errors'] ?? [];

        unset($_SESSION['old'], $_SESSION['errors']);

        require __DIR__ . '/../views/usuarios/form.php';
    }

    public function store(): void
    {
        $data = $_POST;
        $errors = UsuarioValidator::validate($data);

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

        $title = "Editar Usuário";
        $csrf = $_SESSION['csrf'] ?? '';
        $old = $_SESSION['old'] ?? $usuario;
        $errors = $_SESSION['errors'] ?? [];

        unset($_SESSION['old'], $_SESSION['errors']);

        require __DIR__ . '/../views/usuarios/edit.php';
    }

    public function update(int $id): void
    {
        $data = $_POST;
        $errors = UsuarioValidator::validate($data);

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