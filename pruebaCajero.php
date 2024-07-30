<?php
$cuenta = ["123456" => ["Usuario" => "Dario", "Saldo" => 500000, "Contraseña" => "1234"], "232323" => ["Usuario" => "Juan", "Saldo" => 500000, "Contraseña" => "0000"]];
function mostrarMenu()
{
    return "Escriba (R) para retirar\nEscriba (T) para transferir a otra cuenta\nEscriba (S) para salir\nEscriba (C) para cambiar de cuenta\nEscriba (V) para ver saldo de la cuenta actual\n";
}
function mostrarMontos()
{
    return "[1. 10000]\n[2. 20000]\n[3. 50000]\n[4. 100000]\n[5. 250000]\n[6. Valor diferente]\n";
}

$cuentaActual = readline("Ingrese su numero de cuenta: \n");
$contraseña = readline("Ingrese su contraseña: \n");

if ($cuenta[$cuentaActual] && $cuenta[$cuentaActual]["Contraseña"] == $contraseña) {
    echo "Bienvenido " . $cuenta[$cuentaActual]["Usuario"] . "\n";
    do {
        echo mostrarMenu();
        $montos = [10000, 20000, 50000, 100000, 250000];
        $opcion = readline("Ingrese una opcion: \n");
        switch ($opcion) {
            case "V":
                echo "Su saldo es: " . $cuenta[$cuentaActual]["Saldo"]."\n";
                break;
            case "R":
                echo mostrarMontos();
                $opcionMonto = readline("Seleccione un monto: \n");
                if ($opcionMonto >= 1 && $opcionMonto <= 5) {
                    $monto = $montos[$opcionMonto - 1];
                } elseif ($opcionMonto == 6) {
                    $monto = readline("Ingrese el monto: \n");
                } else {
                    echo "Opcion no valida\n";
                    break;
                }
                if ($cuenta[$cuentaActual]["Saldo"] >= $monto) {
                    $cuenta[$cuentaActual]["Saldo"] -= $monto;
                    echo "Retiro exitoso.\nSu nuevo saldo es: " . $cuenta[$cuentaActual]["Saldo"] . "\n";
                } else {
                    echo "Saldo insuficiente";
                }
                break;
            case "C":
                $cuentaActual = readline("Ingrese la cuenta a la que desea ingresar: \n");
                if ($cuenta[$cuentaActual]) {
                    echo "Ingrese la contraseña: \n";
                    $contraseña = readline("Ingrese la contraseña: \n");
                    if ($contraseña == $cuenta[$cuentaActual]["Contraseña"]) {
                        echo "Bienvenido usuario\n";
                    } else {
                        echo "Contraseña incorrecta\n";
                    }
                } else {
                    echo "Cuenta no encontrada\n";
                }
                break;
            case "T":
                $cuentaDestino = readline("Ingrese la cuenta a la que desea transferir: \n");
                if ($cuenta[$cuentaDestino]) {
                    echo mostrarMontos();
                    $opcionMonto = readline("Seleccione un monto: \n");
                    if ($opcionMonto >= 1 && $opcionMonto <= 5) {
                        $monto = $montos[$opcionMonto - 1];
                    } elseif ($opcionMonto == 6) {
                        $monto = readline("Ingrese el monto: \n");
                    } else {
                        echo "Opcion no valida\n";
                        break;
                    }
                    if ($cuenta[$cuentaActual]["Saldo"] >= $monto) {
                        $cuenta[$cuentaActual]["Saldo"] -= $monto;
                        $cuenta[$cuentaDestino]["Saldo"] += $monto;
                        echo "Transferencia exitosa.\nSu nuevo saldo es: " . $cuenta[$cuentaActual]["Saldo"] . "\n";
                    } else {
                        echo "Saldo insuficiente";
                    }
                    break;
                } else {
                    echo "Cuenta no encontrada\n";
                }
                break;
            case "S":
                echo "Adios usuario\n";
                break;
        }
    } while ($opcion != "S");
} else {
    echo "Cuenta o contraseña incorrecta.\n";
}
