<html>
    <body>
<?php
    $numtelefone = $_REQUEST['numtelefone'];
    $instantechamada = $_REQUEST['instantechamada'];
    $nomepessoa = $_REQUEST['nomepessoa'];
    $moradalocal = $_REQUEST['moradalocal'];
    $numprocessosocorro = $_REQUEST['numprocessosocorro'];
    try
    {
        $host = "db.ist.utl.pt";
        $user ="ist181920";
        $password = "metalica10";
        $dbname = $user;
        $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "INSERT INTO EventoEmergencia VALUES (:moradalocal, :instantechamada, :nomepessoa,:numtelefone, :numprocessosocorro)";
        echo("<p>$sql</p>");
                            echo("<a href=\"index.php\">Voltar o index</a>");

        $result = $db->prepare($sql);
        $result->execute([':numprocessosocorro' => $numprocessosocorro, ':numtelefone' => $numtelefone, ':instantechamada' => $instantechamada,':nomepessoa' => $nomepessoa,':moradalocal' => $moradalocal]);
        
        $db = null;
    }
    catch (PDOException $e)
    {
        echo("<p>ERROR: {$e->getMessage()}</p>");
    }
?>    </body>
</html>