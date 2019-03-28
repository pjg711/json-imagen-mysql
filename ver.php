<?php
include "conector.php";
$id = $_GET['id'];
$query = "SELECT id, resumen FROM `resumenes` WHERE id={$id}";
if( @sql_select( $query, $consulta ) )
{
    $fotito = @$consulta->fetch(\PDO::FETCH_ASSOC);
    if( isset( $fotito["resumen"] ) )
    {
        $json = json_decode( $fotito["resumen"], true );
        $tipo = $json["tipo"];
        //$peso = $json["peso"];
        $contenido = base64_decode( $json["contenido"] );
        $peso2 = strlen($contenido);
        //echo "peso-->{$peso}--->peso2---->{$peso2}<br>";
        header("Content-type: $tipo");
        header("Content-length: $peso2");
        echo $contenido;
    }
}

?>
