<?php

//Datu basea hartu
include 'dbcon.php';
//Konprobatu POST-etik hartzen duen datuak
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //Aldagaiak
    $titulo = $_POST['titulo'];
    $escritor = $_POST['escritor'];
    $sinopsis = $_POST['sinopsis'];
    $idioma = $_POST['idioma'];
    $formato = $_POST['sl0'];
    $img_name = $_FILES['imagen']['name'];
    $archivo = $_FILES['imagen']['tmp_name'];
    $tamaino = $_FILES['imagen']['size'];
    $tipo = $_FILES['imagen']['type'];

    if ($archivo != "none") {
        $fp = fopen($archivo, "rb");
        $imagen = fread($fp, $tamaino);
        $imagen = addslashes($imagen);
        fclose($fp);
    }

    $etiq = '';
    $etiq = implode(', ', $_POST['cbox']);
    //Sartu datu basean
    $nireInsert = $nirePDO->prepare('INSERT INTO Libros (titulo, escritor, sinopsis, idioma, formato, etiquetas, imagen, estado, tipo) VALUES (:titulo, :escritor, :sinopsis, :idioma, :formato, :etiquetas, :imagen, :estado, :tipo)');
    // Exekutatu INSERT datuekin
    $nireInsert->execute(
        array(
            'titulo' => $titulo,
            'ecritor' => $escritor,
            'sinopsis' => $sinopsis,
            'idioma' => $idioma,
            'formato' => $formato,
            'etiquetas' => $etiq,
            'imagen' => $imagen,
            'estado' => 'supervision',
            'tipo' => $tipo
        )
    );
    // Irakurrira eraman
    header('Location: index.php');
    // $insert = "INSERT INTO Libros SET titulo='$titulo', escritor='$escritor', sinopsis='$sinopsis', idioma = '$idioma', formato='$formato', etiquetas='$etiq', imagen='$imagen' estado='supervision', tipo='$tipo'";
    // echo "$insert";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/addL.css">
    <script src="JS/script.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="Multimedia/icono_arbol.png">
    <title>Añadir Libro</title>
</head>
<body>
<div class="form">
    <form action="" method="post" enctype="multipart/form-data">
        <td>
            <tr>
                <br>
                <label for="titulo">Titulo</label>
                <input type="text" name="titulo" placeholder="Mete titulo en cada idioma.">
                <br>
            </tr>
            <tr>
                <br>
                <label for="escritor">Escritor</label>
                <input type="text" name="escritor" placeholder="Mete escritor/es.">
                <br>
            </tr>
            <tr>
                <br>
                <label for="sinopsis">Sinopsis</label>
                <textarea name="sinopsis" id="sinopsis" cols="30" rows="10" placeholder="Mete una sinopsis breve." style="resize: none"></textarea>
                <br>
            </tr>
            <tr>
                <br>
                <label for="idioma">Idiomas</label>
                <input type="text" name="idioma" placeholder="Mete los idiomas.">
                <br>
            </tr>
            <tr>
                <br>
                <label for="formato">Formato</label>
                    <select name="sl0" id="formato">
                        <option value="Novela">Novela</option>
                        <option value="Novela Juvenil">Novela Juvenil</option>
                        <option value="Libro Infantil">Libro Infantil</option>
                        <option value="Diario">Diario</option>
                        <option value="Manga">Manga</option>
                        <option value="Comic">Comic</option>
                        <option value="Otro">Otro</option>
                    </select>
                <br>
            </tr>
            <tr>
                <br>
                <p>Etiquetas</p>
                    <label for="chbx1"><input type="checkbox" id="chbx1" value="Aventura" name="cbox[]">Aventura</label>
                    <label for="chbx2"><input type="checkbox" id="chbx2" value="Ciencia Ficción" name="cbox[]">Ciencia Ficción</label>
                    <label for="chbx3"><input type="checkbox" id="chbx3" value="Acción" name="cbox[]">Acción</label>
                    <label for="chbx4"><input type="checkbox" id="chbx4" value="Hadas" name="cbox[]">Hadas</label>
                    <label for="chbx5"><input type="checkbox" id="chbx5" value="Gótica" name="cbox[]">Gótica</label>
                    <label for="chbx6"><input type="checkbox" id="chbx6" value="Policiaca" name="cbox[]">Policiaca</label>
                    <label for="chbx7"><input type="checkbox" id="chbx7" value="Paranormal" name="cbox[]">Paranormal</label>
                    <label for="chbx8"><input type="checkbox" id="chbx8" value="Distopica" name="cbox[]">Distopica</label>
                    <label for="chbx9"><input type="checkbox" id="chbx9" value="Fantastica" name="cbox[]">Fantastica</label>
                    <label for="chbx10"><input type="checkbox" id="chbx10" value="Comedia" name="cbox[]">Comedia</label>
                    <label for="chbx11"><input type="checkbox" id="chbx11" value="Misterio" name="cbox[]">Misterio</label>
                    <label for="chbx12"><input type="checkbox" id="chbx12" value="Terror" name="cbox[]">Terror</label>
                    <label for="chbx13"><input type="checkbox" id="chbx13" value="Historico" name="cbox[]">Historico</label>
                    <label for="chbx14"><input type="checkbox" id="chbx14" value="Autobiografia" name="cbox[]">Autobiografia</label>
                    <label for="chbx15"><input type="checkbox" id="chbx15" value="Biografia" name="cbox[]">Biografia</label>
                <br>
            </tr>
            <tr>
                <br>
                <label for="imagen">Portada</label>
                <input type="file" id="imagen" name="imagen">
                <br>
            </tr>
            <tr>
                <br>
                <button type="submit" name="addL" value="submit">Enviar</button>
                <br>
            </tr>
        </td>
    </form>
</div>

</body>
</html>