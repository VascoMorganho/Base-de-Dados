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
    <div style="float:left; width:50%;">
    <h3>Processos de Socorro</h3>
<?php
    try
    {
    
        $sql = "SELECT numProcessoSocorro FROM ProcessoSocorro;";
    
        $result = $db->prepare($sql);
        $result->execute();
    
        echo("<table border=\"1\">\n");
        echo("<tr><td>numProcessoSocorro</td></tr>\n");
        foreach($result as $row)
        {
            echo("<tr><td>");
            echo($row['numprocessosocorro']);
            echo("<td><a href=\"listameios.php?numprocessosocorro={$row['numprocessosocorro']}\">Listar meios accionados por este processo</a></td>");
            echo("<td><a href=\"removeprocessosocorro.php?numprocessosocorro={$row['numprocessosocorro']}\">Remover</a></td>");
            echo("</td></tr>\n");
        }
        echo("</table>\n");
        echo("<td><a href=\"inserirprocessosocorro.php\">Inserir novo Processo de Socorro</a></td>");
    
    }
    catch (PDOException $e)
    {
        echo("<p>ERROR: {$e->getMessage()}</p>");
    }
?>
    </div>
    <div style="float right; width:50%;">
        <h3>All Meios</h3>
<?php
    try
    {
        $sql = "SELECT numMeio, nomeMeio, nomeEntidade FROM Meio;";
    
        $result = $db->prepare($sql);
        $result->execute();
    
        echo("<table border=\"1\">\n");
        echo("<tr><td>numMeio</td><td>nomeMeio</td><td>nomeEntidade</td></tr>\n");
        foreach($result as $row)
        {
            echo("<tr><td>");
            echo($row['nummeio']);
            echo("</td><td>");
            echo($row['nomemeio']);
            echo("</td><td>");
            echo($row['nomeentidade']);
            echo("</td><td>");
            echo("<a href=\"removemeio.php?nummeio={$row['nummeio']}\">Remover</a>");
            echo("</td></tr>\n");
        $last = ($row['nummeio']);
        }
        $last = $last + 1;
        echo("</table>\n");
        echo("<a href=\"inserirmeio.php?nummeio={$last}\">Inserir novo Meio</a>\n");
    
    }
    catch (PDOException $e)
    {
        echo("<p>ERROR: {$e->getMessage()}</p>");
    }
?>
    </div>
        <div style="float right; width:50%;">
        <h3>Meios de Combate</h3>
<?php
    try
    {
        $sql = "SELECT numMeio, nomeEntidade FROM MeioCombate;";
    
        $result = $db->prepare($sql);
        $result->execute();
    
        echo("<table border=\"1\">\n");
        echo("<tr><td>numMeio</td><td>nomeEntidade</td></tr>\n");
        foreach($result as $row)
        {
            echo("<tr><td>");
            echo($row['nummeio']);
            echo("</td><td>");
            echo($row['nomeentidade']);
            echo("</td><td>");
            echo("<a href=\"removemeio.php?nummeio={$row['nummeio']}\">Remover</a>");
            echo("</td></tr>\n");
        $last = ($row['nummeio']);
        }
        $last = $last + 1;
        echo("</table>\n");
        echo("<a href=\"inserirmeio.php?nummeio={$last}\">Inserir novo Meio de Combate</a>\n");
    
    }
    catch (PDOException $e)
    {
        echo("<p>ERROR: {$e->getMessage()}</p>");
    }
?>
    </div>
        <div style="float right; width:50%;">
        <h3>Meios de Apoio</h3>
<?php
    try
    {
        $sql = "SELECT numMeio, nomeEntidade FROM MeioApoio;";
    
        $result = $db->prepare($sql);
        $result->execute();
    
        echo("<table border=\"1\">\n");
        echo("<tr><td>numMeio</td><td>nomeEntidade</td></tr>\n");
        foreach($result as $row)
        {
            echo("<tr><td>");
            echo($row['nummeio']);
            echo("</td><td>");
            echo($row['nomeentidade']);
            echo("</td><td>");
            echo("<a href=\"removemeio.php?nummeio={$row['nummeio']}\">Remover</a>");
            echo("</td></tr>\n");
        $last = ($row['nummeio']);
        }
        $last = $last + 1;
        echo("</table>\n");
        echo("<a href=\"inserirmeio.php?nummeio={$last}\">Inserir novo Meio de Apoio</a>\n");
    
    }
    catch (PDOException $e)
    {
        echo("<p>ERROR: {$e->getMessage()}</p>");
    }
?>
    </div>
        <div style="float right; width:50%;">
        <h3>Meios de Socorro</h3>
<?php
    try
    {
        $sql = "SELECT numMeio, nomeEntidade FROM MeioSocorro;";
    
        $result = $db->prepare($sql);
        $result->execute();
    
        echo("<table border=\"1\">\n");
        echo("<tr><td>numMeio</td><td>nomeEntidade</td></tr>\n");
        foreach($result as $row)
        {
            echo("<tr><td>");
            echo($row['nummeio']);
            echo("</td><td>");
            echo($row['nomeentidade']);
            echo("</td><td>");
            echo("<a href=\"removemeio.php?nummeio={$row['nummeio']}\">Remover</a>");
            echo("</td></tr>\n");
        $last = ($row['nummeio']);
        }
        $last = $last + 1;
        echo("</table>\n");
        echo("<a href=\"inserirmeio.php?nummeio={$last}\">Inserir novo Meio de Socorro</a>\n");
    
    }
    catch (PDOException $e)
    {
        echo("<p>ERROR: {$e->getMessage()}</p>");
    }
?>
    </div>
        <div style="float right; width:50%;">
        <h3>Locais</h3>
<?php
    try
    {
        $sql = "SELECT moradaLocal FROM Local;";
    
        $result = $db->prepare($sql);
        $result->execute();
    
        echo("<table border=\"1\">\n");
        echo("<tr><td>moradaLocal</td></tr>\n");
        foreach($result as $row)
        {
            echo("<tr><td>");
            echo($row['moradalocal']);
            echo("</td><td>");
            $mor = urlencode($row['moradalocal']);
            echo("<a href=\"removelocal.php?moradalocal={$mor}\">Remover</a>");
            echo("</td></tr>\n");
        }
        echo("</table>\n");
        echo("<a href=\"inserirlocal.php\">Inserir novo Local</a>\n");
    
    }
    catch (PDOException $e)
    {
        echo("<p>ERROR: {$e->getMessage()}</p>");
    }
?>
    </div>
        <div style="float right; width:50%;">
        <h3>Eventos de Emergencia</h3>
<?php
    try
    {
        $sql = "SELECT moradalocal, instanteChamada, nomePessoa, numTelefone, numProcessoSocorro FROM EventoEmergencia;";
    
        $result = $db->prepare($sql);
        $result->execute();
    
        echo("<table border=\"1\">\n");
        echo("<tr><td>moradalocal</td><td>instanteChamada</td><td>nomePessoa</td><td>numTelefone</td><td>numProcessoSocorro</td></tr>\n");
        foreach($result as $row)
        {
            echo("<tr><td>");
            echo($row['moradalocal']);
            echo("</td><td>");
            echo($row['instantechamada']);
            echo("</td><td>");
            echo($row['nomepessoa']);
            echo("</td><td>");
            echo($row['numtelefone']);
            echo("</td><td>");
            echo($row['numprocessosocorro']);
            echo("</td><td>");
            $inst = urlencode($row['instantechamada']);
            echo("<a href=\"removeevento.php?numtelefone={$row['numtelefone']}?instantechamada={$inst}\">Remover</a>");
            echo("</td><td>");
            echo("</td></tr>\n");
        }
        echo("</table>\n");
        echo("<a href=\"inserireventoemergencia.php\">Inserir novo Evento de Emergencia</a>\n");
    
    }
    catch (PDOException $e)
    {
        echo("<p>ERROR: {$e->getMessage()}</p>");
    }
?>
    </div>
            <div style="float right; width:50%;">
        <h3>EntidadeMeio</h3>
<?php
    try
    {
        $sql = "SELECT nomeEntidade FROM EntidadeMeio;";
    
        $result = $db->prepare($sql);
        $result->execute();
    
        echo("<table border=\"1\">\n");
        echo("<tr><td>nomeEntidade</td></tr>\n");
        foreach($result as $row)
        {
            echo("<tr><td>");
            echo($row['nomeentidade']);
            echo("</td><td>");
            $nom = urlencode($row['nomeentidade']);
            echo("<a href=\"removeentidade.php?numtelefone={$nom}\">Remover</a>");
            echo("</td><td>");
            echo("</td></tr>\n");
        }
        echo("</table>\n");
        echo("<a href=\"inserirentidade.php\">Inserir nova Entidade Meio</a>\n");
    
    }
    catch (PDOException $e)
    {
        echo("<p>ERROR: {$e->getMessage()}</p>");
    }
?>
    </div>
    </body>
</html>