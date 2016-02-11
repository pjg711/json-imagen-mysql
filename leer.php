<?php
/**
 * Lee las imagenes guardadas en mysql
 * y las muestra en una tabla
 */
include "conector.php";
$query = "SELECT * FROM `resumenes`";
if( sql_select( $query, $consulta ) )
{
    echo "<table border=\"1\">";
    while( $row = $consulta->fetch(\PDO::FETCH_ASSOC) )
    {
        $json = json_decode( $row['resumen'], true );
        //$peso = $json["peso"];
        //$peso3 = strlen( $json["contenido"] );
        //$contenido = base64_decode( $json["contenido"] );
        //$peso2 = strlen($contenido);
        //echo "peso:{$peso}--->peso2:{$peso2}----->peso3:{$peso3}<br>";
        echo "<tr>";
        echo "<td colspan=\"2\">";
        echo "<img src=\"ver.php?id={$row['id_resumen']}\">";
        echo "</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td>";
        echo $json['titulo'][1]. "|";
        echo "</td>";
        echo "<td>";
        echo $json['archivo_nombre'];
        echo "</td>";
        echo "</tr>";
        echo "<tr><td><hr></td></tr>";
    }
    echo "</table>";
}
?>
