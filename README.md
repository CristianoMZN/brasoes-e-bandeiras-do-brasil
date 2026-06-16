# Brasões e Bandeiras do Brasil

![Visualizações](https://hits.seeyoufarm.com/api/count/incr/badge.svg?url=github.com/cristianomzn/brasoes-e-bandeiras-do-brasil&count_bg=%2379C83D&title_bg=%23555555&title=views)
![npm](https://img.shields.io/npm/v/@cristianomzn/brasoes-e-bandeiras-do-brasil?color=79C83D&logo=npm)
![Packagist](https://img.shields.io/packagist/v/cristianomzn/brasoes-e-bandeiras-do-brasil?color=79C83D&logo=packagist)
![License](https://img.shields.io/github/license/cristianomzn/brasoes-e-bandeiras-do-brasil?color=79C83D)
![Cobertura](https://img.shields.io/badge/cobertura-58.6%25-79C83D?style=flat)

Acervo de imagens dos brasões de armas dos municípios brasileiros, destinado ao uso na DANFSE (Documento Auxiliar Nota fiscal de serviço eletrônica) e em outros documentos que exigem a identificação visual dos municípios.

## Início rápido

### PHP

```bash
composer require cristianomzn/brasoes-e-bandeiras-do-brasil
```

```php
<?php
require 'vendor/autoload.php';

use CristianoMzn\Bbb\Bbb;

echo Bbb::get('SP', '3550308');
// /caminho/do/projeto/vendor/cristianomzn/brasoes-e-bandeiras-do-brasil/brasao-de-armas-municipal/SP/3550308.jpg
```

### Node.js

```bash
npm install @cristianomzn/brasoes-e-bandeiras-do-brasil
```

```js
import { Bbb } from '@cristianomzn/brasoes-e-bandeiras-do-brasil';

console.log(Bbb.get('SP', '3550308'));
// /caminho/do/projeto/node_modules/@cristianomzn/brasoes-e-bandeiras-do-brasil/brasao-de-armas-municipal/SP/3550308.jpg
```

## Requisitos

| Plataforma | Versão mínima |
|------------|---------------|
| PHP | 8.0+ |
| Node.js | 18+ |

## API

### `Bbb.get(uf, ibgeCode)`

Retorna o caminho absoluto para a imagem do brasão de armas de um município brasileiro, ou `false`/`null` se a imagem não existir no acervo.

| Parâmetro | Tipo | Descrição |
|-----------|------|-----------|
| `uf` | `string` | Sigla da unidade federativa (ex: `'SP'`, `'RJ'`, `'MG'`) |
| `ibgeCode` | `string \| number` | Código IBGE do município com exatamente 7 dígitos (ex: `'3550308'` ou `3550308`) |

**Retorno:** `string | false` (PHP) ou `string | null` (Node.js) —
caminho absoluto para o arquivo `.jpg` ou `false`/`null` se a imagem não existir no acervo.

**Exceções (lançadas em caso de erro na lib):**

| Exceção | PHP | Node.js | Motivo |
|---------|-----|---------|--------|
| UF inválida | `InvalidArgumentException` | `Error` | Sigla de estado não existe |
| Código IBGE inválido | `InvalidArgumentException` | `Error` | Não contém exatamente 7 dígitos |
| Diretório da UF não encontrado | `RuntimeException` | `Error` | Lib instalada incorretamente ou corrompida |

**UFs válidas:** `AC`, `AL`, `AM`, `AP`, `BA`, `CE`, `DF`, `ES`, `GO`, `MA`, `MG`, `MS`, `MT`, `PA`, `PB`, `PE`, `PI`, `PR`, `RJ`, `RN`, `RO`, `RR`, `RS`, `SC`, `SE`, `SP`, `TO`

#### Exemplo: renderização HTML

**PHP:**

```php
<?php
require 'vendor/autoload.php';

use CristianoMzn\Bbb\Bbb;

$uf = 'SP';
$codigoIbge = '3550308';
$brasao = Bbb::get($uf, $codigoIbge);

if ($brasao !== false) {
    $img = base64_encode(file_get_contents($brasao));
    $html = "<img src='data:image/jpeg;base64,{$img}' alt='Brasão de {$uf}'>";
} else {
    $html = "<span class='placeholder'>Brasão não disponível</span>";
}

echo $html;
```

**Node.js:**

```js
import { Bbb } from '@cristianomzn/brasoes-e-bandeiras-do-brasil';
import { readFileSync } from 'fs';

const uf = 'SP';
const codigoIbge = '3550308';
const brasao = Bbb.get(uf, codigoIbge);

let html;

if (brasao !== null) {
    const img = readFileSync(brasao);
    const base64 = img.toString('base64');
    html = `<img src="data:image/jpeg;base64,${base64}" alt="Brasão de ${uf}">`;
} else {
    html = `<span class="placeholder">Brasão não disponível</span>`;
}

console.log(html);
```

#### Exemplo: geração de PDF

**PHP com TCPDF:**

```php
<?php
require 'vendor/autoload.php';
require 'vendor/tcpdf/tcpdf.php';

use CristianoMzn\Bbb\Bbb;

$uf = 'SP';
$codigoIbge = '3550308';
$brasao = Bbb::get($uf, $codigoIbge);

$pdf = new TCPDF();
$pdf->AddPage();

if ($brasao !== false) {
    $pdf->Image($brasao, 10, 10, 30);
} else {
    $pdf->Cell(0, 10, 'Brasão não disponível para este município.', 0, 1, 'C');
}

$pdf->Output('documento.pdf');
```

**Node.js com PDFKit:**

```js
import { Bbb } from '@cristianomzn/brasoes-e-bandeiras-do-brasil';
import PDFDocument from 'pdfkit';
import { createWriteStream } from 'fs';

const uf = 'SP';
const codigoIbge = '3550308';
const brasao = Bbb.get(uf, codigoIbge);

const doc = new PDFDocument();
doc.pipe(createWriteStream('documento.pdf'));

if (brasao !== null) {
    doc.image(brasao, 10, 10, { width: 30 });
} else {
    doc.fontSize(12).text('Brasão não disponível para este município.', 10, 20);
}

doc.end();
```

#### Tratamento de erros

A função lança erro quando:
- A UF fornecida não é válida
- O código IBGE não contém exatamente 7 dígitos
- O diretório da UF não existe (lib corrompida)

**PHP:**

```php
<?php
require 'vendor/autoload.php';

use CristianoMzn\Bbb\Bbb;

try {
    $path = Bbb::get('XX', '1234567');
} catch (InvalidArgumentException $e) {
    // UF ou código IBGE com formato inválido
    echo "Erro de validação: " . $e->getMessage();
} catch (RuntimeException $e) {
    // Diretório não existe — lib corrompida
    echo "Erro de instalação: " . $e->getMessage();
}
```

**Node.js:**

```js
import { Bbb } from '@cristianomzn/brasoes-e-bandeiras-do-brasil';

try {
    const path = Bbb.get('XX', '1234567');
} catch (e) {
    console.error(`Erro: ${e.message}`);
}
```

## Estrutura do projeto

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

## Formato das imagens

| Propriedade | Valor |
|-------------|-------|
| Formato | JPEG |
| Resolução | 192 × 192 px |
| Fundo | Branco |

As imagens seguem o layout sugerido para inserção na DANFSE.

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

| UF | Cobertos | Total | Cobertura | |
|----|----------|-------|-----------|--|
| RR | 15 | 15 | 100% | █████████████ |
| RS | 433 | 497 | 87,1% | ███████████░░ |
| SP | 554 | 645 | 85,9% | ███████████░░ |
| RJ | 75 | 92 | 81,5% | ██████████░░░ |
| PB | 180 | 223 | 80,7% | ██████████░░░ |
| SC | 214 | 295 | 72,5% | █████████░░░░ |
| MG | 607 | 853 | 71,2% | █████████░░░░ |
| RO | 34 | 52 | 65,4% | ████████░░░░░ |
| ES | 51 | 78 | 65,4% | ████████░░░░░ |
| RN | 106 | 167 | 63,5% | ████████░░░░░ |
| CE | 100 | 184 | 54,3% | ███████░░░░░░ |
| AL | 49 | 102 | 48,0% | ██████░░░░░░░ |
| AC | 10 | 22 | 45,5% | ██████░░░░░░░ |
| AM | 28 | 62 | 45,2% | ██████░░░░░░░ |
| SE | 34 | 75 | 45,3% | ██████░░░░░░░ |
| MS | 35 | 79 | 44,3% | █████░░░░░░░░ |
| GO | 107 | 246 | 43,5% | █████░░░░░░░░ |
| MT | 60 | 142 | 42,3% | █████░░░░░░░░ |
| PA | 60 | 144 | 41,7% | █████░░░░░░░░ |
| PR | 196 | 399 | 49,1% | ██████░░░░░░░ |
| BA | 146 | 417 | 35,0% | █████░░░░░░░░ |
| PE | 58 | 184 | 31,5% | ████░░░░░░░░░ |
| AP | 5 | 16 | 31,3% | ████░░░░░░░░░ |
| MA | 45 | 217 | 20,7% | ███░░░░░░░░░░ |
| TO | 23 | 139 | 16,5% | ██░░░░░░░░░░░ |
| PI | 40 | 224 | 17,9% | ██░░░░░░░░░░░ |
| DF - Brasília | 1 | 1 | 100% | █████████████ |

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

## Licença

Este projeto está licenciado sob a [Licença MIT](LICENSE).
