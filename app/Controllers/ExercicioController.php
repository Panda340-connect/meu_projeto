<?php

namespace App\Controllers;

require_once __DIR__ . '/../models/Exercicio.php';
require_once __DIR__ . '/../validators/ExercicioValidator.php';

use App\Models\Exercicio;
use App\Validators\ExercicioValidator;

class ExercicioController
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
        $exercicios = Exercicio::all();

        $this->render('exercicios/index', [
            'title' => 'Listagem de Exercícios',
            'exercicios' => $exercicios,
        ]);
    }

    public function create(): void
    {
        $csrf = $_SESSION['csrf'] ?? '';
        $old = $_SESSION['old'] ?? [];
        $errors = $_SESSION['errors'] ?? [];

        unset($_SESSION['old'], $_SESSION['errors']);

        $this->render('exercicios/form', [
            'title' => 'Novo Exercício',
            'csrf' => $csrf,
            'old' => $old,
            'errors' => $errors,
        ]);
    }

    public function store(): void
    {
        $data = $_POST;
        $errors = ExercicioValidator::validate($data);

        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            $_SESSION['old'] = $data;
            header('Location: ' . url('exercicio/create'));
            exit;
        }

        Exercicio::create($data);
        header('Location: ' . url('exercicio/index'));
        exit;
    }
}