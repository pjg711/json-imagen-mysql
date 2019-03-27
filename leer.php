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
        echo "<img src=\"ver.php?id={$row[id]}\">";
        echo "</td></tr>";
    }
    echo "</table>";
}
?>
