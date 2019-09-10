<html>
    <body>
        <h3>Altere o Meio <?=$_REQUEST['nummeio']?></h3>
        <form action="updatemeio2.php" method="post">
            <p><input type="hidden" name="nummeio" value="<?=$_REQUEST['nummeio']?>"/></p>
            <p><input type="hidden" name="tipo" value="<?=$_REQUEST['tipo']?>"/></p>
            <p>Nome Entidade: <input type="text" name="nomeentidade"/></p>
            <p><input type="submit" value="Inserir"/></p>
        </form>
    </body>
</html>