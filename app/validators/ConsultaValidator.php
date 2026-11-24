<?php

namespace App\Validators;

use DateTime;

class ConsultaValidator
{
    public static function validate(array $data): array
    {
        $errors = [];

        $idUsuario = (int) ($data['id_usuario'] ?? 0);
        if ($idUsuario <= 0) {
            $errors['id_usuario'] = 'Selecione o usuário da consulta.';
        }

        $especialidade = trim((string) ($data['especialidade'] ?? ''));
        if ($especialidade === '') {
            $errors['especialidade'] = 'A especialidade médica é obrigatória.';
        } elseif (strlen($especialidade) > 100) {
            $errors['especialidade'] = 'A especialidade deve ter no máximo 100 caracteres.';
        }

        $nomeMedico = trim((string) ($data['nome_medico'] ?? ''));
        if ($nomeMedico === '') {
            $errors['nome_medico'] = 'Informe o nome do profissional de saúde.';
        } elseif (strlen($nomeMedico) > 100) {
            $errors['nome_medico'] = 'O nome do médico deve ter no máximo 100 caracteres.';
        }

        $dataConsulta = trim((string) ($data['data_consulta'] ?? ''));
        $dt = DateTime::createFromFormat('Y-m-d', $dataConsulta);
        if ($dataConsulta === '' || !$dt || $dt->format('Y-m-d') !== $dataConsulta) {
            $errors['data_consulta'] = 'Informe uma data válida para a consulta.';
        }

        $horario = trim((string) ($data['horario'] ?? ''));
        if ($horario === '' || !preg_match('/^\d{2}:\d{2}(:\d{2})?$/', $horario)) {
            $errors['horario'] = 'Informe um horário válido para a consulta.';
        }

        $local = trim((string) ($data['local'] ?? ''));
        if ($local === '') {
            $errors['local'] = 'Informe o local de atendimento.';
        } elseif (strlen($local) > 150) {
            $errors['local'] = 'O local deve ter no máximo 150 caracteres.';
        }

        return $errors;
    }
}