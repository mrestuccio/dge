::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
:: Descripción : Activa y agrega funcionalidades a salida del PHP Generator
::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
@echo off
set DIRHOME=\\mozart.myc.ar\facturas
PowerShell -ExecutionPolicy Bypass -File %DIRHOME%\activador\activador.ps1 %DIRHOME%
@timeout 10
