<?php

namespace App\Validators;

class MedicamentoValidator
{
    public static function validate(array $data): array
    {
        $errors = [];

        $nomeMedicamento = trim($data['nome_medicamento'] ?? '');
        $dosagem = trim($data['dosagem'] ?? '');
        $horario = trim($data['horario'] ?? '');
        $frequencia = trim($data['frequencia'] ?? '');
        $idUsuario = (int) ($data['id_usuario'] ?? 0);

        if ($nomeMedicamento === '') {
            $errors['nome_medicamento'] = 'Informe o nome do medicamento.';
        } elseif (mb_strlen($nomeMedicamento) > 100) {
            $errors['nome_medicamento'] = 'O nome do medicamento deve ter no máximo 100 caracteres.';
        }

        if ($dosagem === '') {
            $errors['dosagem'] = 'Informe a dosagem.';
        } elseif (mb_strlen($dosagem) > 50) {
            $errors['dosagem'] = 'A dosagem deve ter no máximo 50 caracteres.';
        }

        if ($horario === '') {
            $errors['horario'] = 'Informe o horário do medicamento.';
        }

        if ($frequencia === '') {
            $errors['frequencia'] = 'Informe a frequência.';
        } elseif (mb_strlen($frequencia) > 50) {
            $errors['frequencia'] = 'A frequência deve ter no máximo 50 caracteres.';
        }

        if ($idUsuario <= 0) {
            $errors['id_usuario'] = 'Selecione um usuário válido.';
        }

        return $errors;
    }
}