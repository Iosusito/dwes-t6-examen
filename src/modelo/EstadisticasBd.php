<?php
namespace dwesgram\modelo;

use dwesgram\modelo\BaseDatos;

class EstadisticasBd
{
    use BaseDatos;

    public static function TresEntradasMasGustadas(): array|null
    {
        try {
            $conexion = BaseDatos::getConexion();
            $resultado = $conexion->query("
                select entrada, count(*) as numeroMeGusta
                from megusta
                group by entrada
                order by numeroMeGusta
                limit 3
            ");
            if ($resultado === false) {
                return null;
            }

            $datos = [];
            while (($fila = $resultado->fetch_assoc()) !== null) {
                $entrada = EntradaBd::getEntrada($fila['entrada']);
                if ($entrada === null) {
                    return null;
                }

                $idsUsuarios = MegustaBd::getUsuarios($entrada->getId());
                if ($idsUsuarios === null) {
                    return null;
                }

                $usuarios = [];
                foreach ($idsUsuarios as $id) {
                    $usuario = UsuarioBd::getUsuarioPorId($id);
                    if ($usuario === null) {
                        return null;
                    }
                    $usuarios[] = $usuario;
                }

                $dato = new Estadisticas(
                    entrada: $entrada,
                    numeroMeGusta: $fila['numeroMeGusta'],
                    usuarios: $usuarios
                );
                $datos[] = $dato;
            }
            return $datos;
        } catch (\Exception $e) {
            return null;
        }
    }
}
