# AGENTS.md

## What this repo is

Data-only repository: JPEG images of Brazilian municipal coats of arms (brasões de armas) organized by state, named by IBGE municipality code. No code, no build system, no tests.

## Structure

```
brasao-de-armas-municipal/<UF>/<ibge_code>.jpg
```

UF = two-letter Brazilian state abbreviation (AC, AL, AM, ..., TO).

## Image constraints

- Format: JPEG only (`.jpg` extension)
- Resolution: 192x192 px exact
- Background: white
- Aspect ratio must be preserved (no stretching)
- Public domain or freely licensed only
- Source must be cited in PR

## Contributing

PRs add or replace images in the appropriate UF folder. No CI, no automated checks — maintainers verify manually.

## Pending states

Centro-Oeste (DF, GO, MS, MT), Sul (PR, RS, SC), and SP have no coverage. All other states are partially covered (17-80%).

## Useful commands

List images per UF (to update the coverage table):

```bash
for d in brasao-de-armas-municipal/*/; do
    if [ -d "$d" ]; then
        count=$(find "$d" -type f | wc -l)
        printf "%-35s : %d arquivos\n" "$(basename "$d")" "$count"
    fi
done
```

Windows (PowerShell):
```powershell
Get-ChildItem -Path ".\brasao-de-armas-municipal" -Directory | ForEach-Object {
    $itemCount = (Get-ChildItem -Path $_.FullName -Recurse -ErrorAction SilentlyContinue).Count
    [PSCustomObject]@{
        "Subdiretório"     = $_.Name
        "Total de Objetos" = $itemCount
    }
} | Format-Table -AutoSize
```

## Brazilian states (UF codes)

| Região | Estados |
|--------|---------|
| Centro-Oeste | DF, GO, MT, MS |
| Nordeste | AL, BA, CE, MA, PB, PE, PI, RN, SE |
| Norte | AC, AP, AM, PA, RO, RR, TO |
| Sudeste | ES, MG, RJ, SP |
| Sul | PR, RS, SC |
