<?php

namespace CristianoMzn\Bbb;

use InvalidArgumentException;

class Bbb
{
    private const BASE_PATH = 'brasao-de-armas-municipal';

    private const VALID_UFS = [
        'AC', 'AL', 'AM', 'AP', 'BA', 'CE', 'DF', 'ES', 'GO',
        'MA', 'MG', 'MS', 'MT', 'PA', 'PB', 'PE', 'PI', 'PR',
        'RJ', 'RN', 'RO', 'RR', 'RS', 'SC', 'SE', 'SP', 'TO',
    ];

    public static function get(string $uf, string $ibgeCode): string
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

        return dirname(__DIR__, 2) . '/' . self::BASE_PATH . "/{$uf}/{$ibgeCode}.jpg";
    }
}
