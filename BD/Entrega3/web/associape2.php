<html>
    <body>
<?php
    $numprocessosocorro = $_REQUEST['numprocessosocorro'];
    $numtelefone = $_REQUEST['numtelefone'];
    $instantechamada = $_REQUEST['instantechamada'];
    echo("$numprocessosocorro");
    try
    {
        $host = "db.ist.utl.pt";
        $user ="ist181920";
        $password = "metalica10";
        $dbname = $user;
        $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE EventoEmergencia SET numProcessoSocorro = :numprocessosocorro WHERE numTelefone = :numtelefone AND instanteChamada = :instantechamada;";
        echo("<p>$sql</p>");

        $result = $db->prepare($sql);
        $result->execute([':numprocessosocorro' => $numprocessosocorro,':numtelefone' => $numtelefone,':instantechamada' => $instantechamada]);
                    echo("<a href=\"index.php\">Voltar o index</a>");
        
        $db = null;
    }
    catch (PDOException $e)
    {
        echo("<p>ERROR: {$e->getMessage()}</p>");
    }
?>
    </body>
</html>