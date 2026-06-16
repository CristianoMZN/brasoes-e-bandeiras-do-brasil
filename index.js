import { fileURLToPath } from 'url';
import path from 'path';
import fs from 'fs';

const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);

const BASE_PATH = 'brasao-de-armas-municipal';

const VALID_UFS = [
  'AC', 'AL', 'AM', 'AP', 'BA', 'CE', 'DF', 'ES', 'GO',
  'MA', 'MG', 'MS', 'MT', 'PA', 'PB', 'PE', 'PI', 'PR',
  'RJ', 'RN', 'RO', 'RR', 'RS', 'SC', 'SE', 'SP', 'TO',
];

export class Bbb {
  static get(uf, ibgeCode) {
    const ufUpper = uf.toUpperCase().trim();

    if (!VALID_UFS.includes(ufUpper)) {
      throw new Error(
        `UF '${uf}' inválida. Use uma sigla válida: AC, AL, AM, ...`
      );
    }

    const codeStr = String(ibgeCode).trim();
    if (!/^\d{7}$/.test(codeStr)) {
      throw new Error(
        `Código IBGE '${ibgeCode}' inválido. Deve conter exatamente 7 dígitos.`
      );
    }

    const basePath = path.join(__dirname, BASE_PATH);
    const ufDir = path.join(basePath, ufUpper);

    if (!fs.existsSync(ufDir)) {
      throw new Error(
        `Diretório da UF '${ufUpper}' não encontrado. A lib pode estar corrompida.`
      );
    }

    const filePath = path.join(ufDir, `${codeStr}.jpg`);

    if (!fs.existsSync(filePath)) {
      return null;
    }

    return filePath;
  }
}
