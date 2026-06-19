<?php

namespace CristianoMzn\Bbb;

use InvalidArgumentException;
use RuntimeException;

class Bbb
{
    private const BASE_PATH = 'brasao-de-armas-municipal';

    private const VALID_UFS = [
        'AC', 'AL', 'AM', 'AP', 'BA', 'CE', 'DF', 'ES', 'GO',
        'MA', 'MG', 'MS', 'MT', 'PA', 'PB', 'PE', 'PI', 'PR',
        'RJ', 'RN', 'RO', 'RR', 'RS', 'SC', 'SE', 'SP', 'TO',
    ];

    public static function get(string $uf, string $ibgeCode): string|false
    {
        $uf = strtoupper(trim($uf));

        if (!in_array($uf, self::VALID_UFS, true)) {
            throw new InvalidArgumentException(
                "UF '{$uf}' inválida. Use uma sigla válida: AC, AL, AM, ..."
            );
        }

        if (!preg_match('/^\d{7}$/', $ibgeCode)) {
            throw new InvalidArgumentException(
                "Código IBGE '{$ibgeCode}' inválido. Deve conter exatamente 7 dígitos."
            );
        }

        $basePath = dirname(__DIR__, 1) . '/' . self::BASE_PATH;
        $ufDir = $basePath . '/' . $uf;

        if (!is_dir($ufDir)) {
            throw new RuntimeException(
                "Diretório da UF '{$uf}' não encontrado. A lib pode estar corrompida."
            );
        }

        $path = $ufDir . "/{$ibgeCode}.jpg";

        if (!file_exists($path)) {
            return false;
        }

        return $path;
    }
}
