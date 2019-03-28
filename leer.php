<?php
/**
 * Lee las imagenes guardadas en mysql
 * y las muestra en una tabla
 */
include "conector.php";
$query = "SELECT * FROM `resumenes`";
if( sql_select( $query, $consulta ) )
{
    echo "<table>";
    while( $row = $consulta->fetch(\PDO::FETCH_ASSOC) )
    {
        echo "<tr><td>";
        $json = json_decode( $row['resumen'], true );
        $peso = $json["peso"];
        //$peso3 = strlen( $json["contenido"] );
        //$contenido = base64_decode( $json["contenido"] );
        //$peso2 = strlen($contenido);
        //echo "peso:{$peso}--->peso2:{$peso2}----->peso3:{$peso3}<br>";
        echo "<img src=\"ver.php?id={$row[id]}\">";
        echo "</td></tr>";
    }
    echo "</table>";
}
?>
