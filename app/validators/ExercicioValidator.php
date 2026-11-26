<?php

namespace App\Validators;

class ExercicioValidator
{
    public static function validate(array $dados, bool $isUpdate = false): array
    {
        $erros = [];

        $nome = trim($dados['nome'] ?? '');
        if ($nome === '') {
            $erros['nome'] = 'O nome do exercício é obrigatório.';
        } elseif (mb_strlen($nome) > 100) {
            $erros['nome'] = 'O nome deve ter no máximo 100 caracteres.';
        }

        $idUsuario = $dados['id_usuario'] ?? '';
        if ($idUsuario === '' || !is_numeric($idUsuario) || (int)$idUsuario <= 0) {
            $erros['id_usuario'] = 'Informe um ID de usuário válido.';
        }

        $descricao = trim($dados['descricao'] ?? '');
        if ($descricao === '') {
            $erros['descricao'] = 'A descrição é obrigatória.';
        }

        $frequencia = trim($dados['frequencia'] ?? '');
        if ($frequencia === '') {
            $erros['frequencia'] = 'A frequência é obrigatória.';
        }

        $duracao = trim($dados['duracao'] ?? '');
        if ($duracao === '') {
            $erros['duracao'] = 'A duração é obrigatória.';
        }

        $dataExercicio = trim($dados['data_exercicio'] ?? '');
        if ($dataExercicio === '') {
            $erros['data_exercicio'] = 'A data do exercício é obrigatória.';
        }

        $horario = trim($dados['horario'] ?? '');
        if ($horario === '') {
            $erros['horario'] = 'O horário é obrigatório.';
        }

        return $erros;
    }
}
