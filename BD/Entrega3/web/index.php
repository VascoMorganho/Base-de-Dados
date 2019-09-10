<html>
    <body>
        <?php
            $host = "db.ist.utl.pt";
            $user ="ist181920";
            $password = "metalica10";
            $dbname = $user;
    
            $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        ?>
        <h3>Index</h3>
<?php
    try
    {
        echo("<p><a href=\"listarprocesso.php\">Processos de Socorro</a></p>\n");
        echo("<p><a href=\"listarlocal.php\">Locais</a></p>\n");
        echo("<p><a href=\"listarevento.php\">Eventos de Emergencia</a></p>\n");
        echo("<p><a href=\"listarmeio.php\">Meios</a></p>\n");
        echo("<p><a href=\"listarmeioc.php\">Meios de Combate</a></p>\n");
        echo("<p><a href=\"listarmeioso.php\">Meios de Socorro</a></p>\n");
        echo("<p><a href=\"listarmeioa.php\">Meios de Apoio</a></p>\n");
        echo("<p><a href=\"listarentidade.php\">Entidades</a></p>\n");
    
    }
    catch (PDOException $e)
    {
        echo("<p>ERROR: {$e->getMessage()}</p>");
    }
?>
    </body>
</html>