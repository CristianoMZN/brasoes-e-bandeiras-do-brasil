# Brasões e Bandeiras do Brasil

Acervo de imagens dos brasões de armas dos municípios brasileiros, destinado ao uso na DANFSE (Documento Auxiliar Nota fiscal de serviço eletrônica) e em outros documentos que exigem a identificação visual dos municípios.

## Formato atual

| Propriedade | Valor |
|-------------|-------|
| Formato | JPEG |
| Resolução | 192 × 192 px |
| Fundo | Branco |

As imagens seguem o layout sugerido para inserção na DANFSE.

## Estrutura

```
brasao-de-armas-municipal/
├── AC/
│   ├── 1200054.jpg
│   ├── 1200104.jpg
│   └── ...
├── AL/
│   ├── 2700105.jpg
│   └── ...
├── GO/
│   ├── 5200050.jpg
│   └── ...
└── ...
```

As imagens são organizadas por unidade federativa (UF) e nomeadas pelo código IBGE do município.

## Cobertura atual

### Resumo geral

| Métrica | Valor |
|---------|-------|
| Total de imagens | 3.266 |
| Estados cobertos | 27 |
| Municípios abrangidos | 3.266 |
| Total de municípios no Brasil | 5.569 |
| Cobertura nacional | 58,6% |

### Detalhamento por UF

| UF | Municípios cobertos | Total de municípios | Cobertura |
|----|---------------------|---------------------|-----------|
| AC | 10 | 22 | 45,5% |
| AL | 49 | 102 | 48,0% |
| AM | 28 | 62 | 45,2% |
| AP | 5 | 16 | 31,3% |
| BA | 146 | 417 | 35,0% |
| CE | 100 | 184 | 54,3% |
| DF | 1 | 11 | 9,1% |
| ES | 51 | 78 | 65,4% |
| GO | 107 | 246 | 43,5% |
| MA | 45 | 217 | 20,7% |
| MG | 607 | 853 | 71,2% |
| MS | 35 | 79 | 44,3% |
| MT | 60 | 142 | 42,3% |
| PA | 60 | 144 | 41,7% |
| PB | 180 | 223 | 80,7% |
| PE | 58 | 184 | 31,5% |
| PI | 40 | 224 | 17,9% |
| PR | 196 | 399 | 49,1% |
| RJ | 75 | 92 | 81,5% |
| RN | 106 | 167 | 63,5% |
| RO | 34 | 52 | 65,4% |
| RR | 15 | 15 | 100% |
| RS | 433 | 497 | 87,1% |
| SC | 214 | 295 | 72,5% |
| SE | 34 | 75 | 45,3% |
| SP | 554 | 645 | 85,9% |
| TO | 23 | 139 | 16,5% |

## Como contribuir

Contribuições são muito bem-vindas! Os principais tipos de contribuição esperados são:

- Enviar imagens de brasões de municípios ainda ausentes no acervo.
- Substituir imagens existentes por versões mais legíveis e de maior qualidade.

### Regras obrigatórias

- Formato: **JPEG** (extensão `.jpg`).
- Resolução: **192 × 192 px** exatos.
- Proporção de aspecto original **preservada** — imagens com distorção (esticamento ou compressão) serão rejeitadas.
- Nome do arquivo: código IBGE do município (ex: `1200054.jpg`).
- A imagem deve ser de domínio público ou licenciada para uso livre.
- Incluir a fonte da imagem no pull request (ex: Wikipédia, portal da prefeitura).

### Passo a passo

1. Faça um fork do repositório.
2. Adicione ou substitua a imagem na pasta da UF correspondente.
3. Abra um pull request com a descrição da alteração e a fonte da imagem.

## Fontes

As imagens são obtidas de fontes públicas na internet, como:

- [Wikipédia](https://pt.wikipedia.org/)
- Portais oficiais de prefeituras municipais
- Outras fontes de domínio público

**Importante:** Somente imagens de domínio público ou licenciadas para uso livre serão aceitas neste projeto.

Ao contribuir, informe a origem da imagem utilizada.

## Instalação

### Composer (PHP)

```bash
composer require cristianomzn/brasoes-e-bandeiras-do-brasil
```

### npm (Node.js)

```bash
npm install @cristianomzn/brasoes-e-bandeiras-do-brasil
```

## Uso

### PHP

```php
<?php

require 'vendor/autoload.php';

use CristianoMzn\Bbb\Bbb;

$path = Bbb::get('SP', '3550308');
// Retorna: "/home/user/projeto/vendor/cristianomzn/brasoes-e-bandeiras-do-brasil/brasao-de-armas-municipal/SP/3550308.jpg"
```

### Node.js

```js
import { Bbb } from '@cristianomzn/brasoes-e-bandeiras-do-brasil';

const path = Bbb.get('SP', '3550308');
// Retorna: "/home/user/projeto/node_modules/@cristianomzn/brasoes-e-bandeiras-do-brasil/brasao-de-armas-municipal/SP/3550308.jpg"
```

O path retornado é **absoluto** e já aponta para o arquivo de imagem no sistema de arquivos.

## Licença

Este projeto está licenciado sob a [Licença MIT](LICENSE).
