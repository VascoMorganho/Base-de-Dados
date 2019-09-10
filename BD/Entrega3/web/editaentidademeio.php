<html>
    <body>
        <h3>Editar meio <?=$_REQUEST['nummeio']?></h3>
        <form action="editaentidademeio.php" method="post">
            <p><input type="hidden" name="nummeio" value="<?=$_REQUEST['nummeio']?>"/></p>
            <p>Nome Entidade: <input type="text" name="nomeentidade"/></p>
            <p><input type="submit" value="Editar"/></p>
        </form>
    </body>
</html>
