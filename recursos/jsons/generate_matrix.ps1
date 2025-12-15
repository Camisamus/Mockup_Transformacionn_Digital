
# PowerShell Script to Generate Matrix (Verified)
$baseDir = "c:\Users\admmuni2\Documents\GitHub\Mockup_Transformacionn_Digital\recursos\jsons"
$tramitesPath = Join-Path $baseDir "categoria_patentes_mapeo_completo.json"
$elementosPath = Join-Path $baseDir "formularios_elementos.json"
$outputPath = Join-Path $baseDir "matriz_tramites.csv"

Write-Host "Reading JSONs..."
$tramitesData = Get-Content -LiteralPath $tramitesPath -Raw -Encoding UTF8 | ConvertFrom-Json
$elementosData = Get-Content -LiteralPath $elementosPath -Raw -Encoding UTF8 | ConvertFrom-Json
Write-Host "DEBUG: Elementos Count: $($elementosData.Count)"

$elementosMap = @{}
$isFirst = $true
foreach ($el in $elementosData) {
    if ($isFirst) {
        Write-Host "First Element JSON:"
        $el | ConvertTo-Json -Depth 2
        $isFirst = $false
    }
    if ($el.ID) {
        $elementosMap[$el.ID] = $el
    }
}
Write-Host "DEBUG: Map Count: $($elementosMap.Count)"

$columns = @()
# New Schema: Root is array
$maestro = $tramitesData
if ($tramitesData.Maestro_Tramites) { $maestro = $tramitesData.Maestro_Tramites }
Write-Host "DEBUG: Maestro Count: $($maestro.Count)"

foreach ($tram in $maestro) {
    $tName = $tram.tramite_base
    $baseIds = [System.Collections.Generic.HashSet[string]]::new()
    # Normalize input which might be object or array depending on usage
    if ($tram.Campos) {
        foreach ($id in $tram.Campos) { [void]$baseIds.Add($id) }
    } elseif ($tram.campos_generales) {
        foreach ($id in $tram.campos_generales) { [void]$baseIds.Add($id) }
    }
    
    $columns += [PSCustomObject]@{
        h1 = $tName
        h2 = "Base / General"
        ids = $baseIds
    }
    
    if ($tram.variaciones_adicionales) {
        foreach ($varItem in $tram.variaciones_adicionales) {
            $varName = $varItem.variacion
            $varIds = [System.Collections.Generic.HashSet[string]]::new()
            if ($varItem.documentos_adicionales) {
                 foreach ($id in $varItem.documentos_adicionales) { [void]$varIds.Add($id) }
            }
            $columns += [PSCustomObject]@{
                h1 = $tName
                h2 = $varName
                ids = $varIds
            }
        }
    }
}

$allIdsSet = [System.Collections.Generic.HashSet[string]]::new()
# Add all defined elements
foreach ($key in $elementosMap.Keys) { [void]$allIdsSet.Add($key) }
# And any from columns (though they should be in map now)
foreach ($col in $columns) { foreach ($id in $col.ids) { [void]$allIdsSet.Add($id) } }

$sortedIds = $allIdsSet | Sort-Object { 
    $el = $elementosMap[$_]
    if ($el) { return $el.GRUPO + $el.NOMBRE }
    return "ZZ" + $_ 
}

$sb = [System.Text.StringBuilder]::new()
[void]$sb.Append([char]0xFEFF)

$row1 = "Grupo;ID Campo;Nombre Campo;" + (($columns | ForEach-Object { $_.h1 }) -join ";")
[void]$sb.AppendLine($row1)

$variacionStr = "VARIACION"
$row2 = ";;" + $variacionStr + ";" + (($columns | ForEach-Object { $_.h2 }) -join ";")
[void]$sb.AppendLine($row2)

foreach ($id in $sortedIds) {
    if ($elementosMap.ContainsKey($id)) {
        $el = $elementosMap[$id]
        $grupo = $el.GRUPO
        $nombre = $el.NOMBRE
    } else {
        $grupo = "Sin Grupo"
        $nombre = "Desconocido (" + $id + ")" 
    }
    if ($grupo) { $grupo = $grupo.Replace(";", ",") }
    if ($nombre) { $nombre = $nombre.Replace(";", ",") }
    
    $rowParts = @()
    $rowParts += $grupo
    $rowParts += $id
    $rowParts += $nombre
    
    foreach ($col in $columns) {
        if ($col.ids.Contains($id)) {
            $rowParts += "X"
        } else {
            $rowParts += ""
        }
    }
    [void]$sb.AppendLine(($rowParts -join ";"))
}

[System.IO.File]::WriteAllText($outputPath, $sb.ToString(), [System.Text.Encoding]::UTF8)
Write-Host ("CSV Generated at " + $outputPath)
