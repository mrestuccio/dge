################################################################################
## Descripción : Activa y agrega funcionalidades a salida del PHP Generator
################################################################################
param(
	[string]$dir
)

# Procesa los archivos del directorio seleccionado
Write-Host Procesando el directorio $dir
[system.text.encoding]::GetEncoding('iso-8859-1')
$diract = $dir + "\activador"

# Cambia la hoja de estilos y los datos de conexión a la base
Write-Host Cambiando los estilos CSS y la conexión DB
$origen = $diract + "\main.css"
$destino = $dir + "\components\css"
Copy-Item $origen -Destination $destino -Force
$origen = $diract + "\pgsql_engine.php"
$destino = $dir + "\database_engine"
Copy-Item $origen -Destination $destino -Force

# Se agrega el archivo "general.php" con funciones generales
Write-Host Agregando nuevas funciones PHP
$phpaux = $diract + "\general.php"
$phpfunc = $dir + "\phpgen_settings.php"
if(@( Get-Content $phpfunc | Where-Object { $_.Contains("/* Funciones Generales PHP */") } ).Count -eq 0) {
	Add-Content -path $phpfunc -value (Get-Content $phpaux)
}

# Procesa los archivos PHP generados por el PHP Generator
Write-Host Procesando los archivos PHP
foreach ($arch in Get-Content "$diract\activador.txt") {
	$archori = $dir + "\" + $arch
	Write-Host Procesando $arch

	if (Test-Path $archori) {
		# Se ponen en "true" los permisos que por defecto aparecen el "false" en los PHP
		if(@( Get-Content $archori | Where-Object { $_.Contains("SetExportToExcelAvailable(true)") } ).Count -eq 0) {
			$archtmp = $archori + ".borrar"

			Get-Content $archori | 
				%{$_ -replace 'Available\(false\)', 'Available(true)'} |
				%{$_ -replace 'Navigator\(false\)', 'Navigator(true)'} |
				%{$_ -replace 'SetUseImagesForActions\(false\)', 'SetUseImagesForActions(true)'} |
				%{$_ -replace 'SetHighlightRowAtHover\(false\)', 'SetHighlightRowAtHover(true)'} |
				%{$_ -replace 'SetVisualEffectsEnabled\(false\)', 'SetVisualEffectsEnabled(true)'} |
				%{$_ -replace 'SetAllowDeleteSelected\(true\)', 'SetAllowDeleteSelected(false)'} |
				%{$_ -replace 'AddBand\(', 'AddBandToBegin('} |
				%{$_ -replace 'SetRowsPerPage\(.*\)', 'SetRowsPerPage(100)'} |
				Out-File -Encoding "UTF8" $archtmp

			# Habilitamos los checkbox del "DeleteSelected" para usar en la certificación de facturas
			if ($arch.Equals("factura.php")) {
				$archtmp2 = $archtmp + ".2"
				Get-Content $archtmp |
					%{$_ -replace 'SetAllowDeleteSelected\(false\);$', 'SetAllowDeleteSelected(true);'} |
					Out-File -Encoding "UTF8" $archtmp2
				Move-Item -Path $archtmp2 -Destination $archtmp -Force
			}

			# Convierte la salida de nuevo a ISO-8859-1
			Start-Process -FilePath "$diract\iconv.exe" `
						  -ArgumentList "-f UTF-8 -t ISO-8859-1 -c $archtmp" `
						  -RedirectStandardOutput "$archori" `
						  -RedirectStandardError "iconv_error.txt" `
						  -Wait
			Remove-Item $archtmp
		} else {
			Write-Host -> Ya activado
		}
	} else {
		Write-Host -> El archivo no existe
	}
}

Write-Host Proceso finalizado
