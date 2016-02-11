<?php
include "conector.php";
$query = "SELECT * FROM `resumenes`";
if( sql_select( $query, $consulta ) )
{
    while( $row = $consulta->fetch(\PDO::FETCH_ASSOC) )
    {
        $json = json_decode( $row['resumen'], true );
        $nombre = $json['archivo2'];
        $contenido = base64_decode( $json['contenido'] );
        file_put_contents("./temp/{$nombre}",$contenido);
    }
}
?>
