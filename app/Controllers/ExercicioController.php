<?php

namespace App\Controllers;

require_once __DIR__ . '/../models/Exercicio.php';
require_once __DIR__ . '/../validators/ExercicioValidator.php';

use App\Models\Exercicio;
use App\Validators\ExercicioValidator;

class ExercicioController
{
    public function index(): void
    {
        $exercicios = Exercicio::all();
        $title = "Listagem de Exercícios";

        require __DIR__ . '/../views/exercicios/index.php';
    }

    public function create(): void
    {
        $title = "Novo Exercício";
        $csrf = $_SESSION['csrf'] ?? '';
        $old = $_SESSION['old'] ?? [];
        $errors = $_SESSION['errors'] ?? [];

        unset($_SESSION['old'], $_SESSION['errors']);

        require __DIR__ . '/../views/exercicios/form.php';
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
