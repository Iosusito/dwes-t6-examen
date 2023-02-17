<?php
echo "<div class='container'>";
if (!$datosParaVista['datos']) {
    echo <<<END
    <div class="alert alert-primary" role="alert">
        No hay entradas publicadas para hacer el top
    </div>
    END;
} else {
    echo "<h1>Top 3 Entradas</h1>";
    echo "<hr>";
    foreach ($datosParaVista['datos'] as $dato) {
        echo "<div>";
            $texto = $dato->getEntrada()->getTexto();
            $usuarios = $dato->getUsuarios();

            echo "<p>" . $texto . "</p>";
            echo "<div>"; //usuarios que han dado me gusta
                foreach ($usuarios as $usuario) {
                    $nombre = $usuario->getNombre();
                    $rutaAvatar = $usuario->getAvatar();
                    if ($rutaAvatar === null) {
                        $rutaAvatar = "assets/img/bender.png";
                    }
                    
                    echo "<div>";
                        echo "<img class=\"rounded float-start me-2\" width=\"32px\" src=\"$rutaAvatar\">";
                        echo "<p>$nombre</p>";
                    echo "</div>";
                }
            echo "</div>";
        echo "</div>";
        echo "<hr>";
    }
}
echo "</div>";
