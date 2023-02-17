<?php

namespace dwesgram\controlador;

use dwesgram\modelo\EstadisticasBd;

class EstadisticasControlador extends Controlador
{
    public function mejorEntrada(): array|null
    {
        $tresMejoresEntradas = EstadisticasBd::TresEntradasMasGustadas();
        if ($tresMejoresEntradas === null) {
            $this->vista = "error/500";
            return null;
        }
        
        $this->vista = "estadisticas/mejoresEntradas";
        return $tresMejoresEntradas;
    }
}
