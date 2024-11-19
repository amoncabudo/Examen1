<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link href="/css/datatables.css" rel="stylesheet" crossorigin="anonymous">
    <link href="/css/bootstrap-icons.css" rel="stylesheet">
</head>

<body>

<?php include_once("navbar.php"); ?>


    <!-- id_song | song_name | artist   | duration | song_path -->

    <!-- Formulario para añadir canciones -->
    <div class="container mt-4">
        <h2>Formulario para añadir canciones</h2>
        <form action="/index.php?r=addsong" method="post" enctype="multipart/form-data">
            <div class="form-floating mb-3">
                <input type="text" name="song_name" class="form-control" id="song_name" placeholder="505">
                <label>Nombre de la cancion</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" name="artist" class="form-control" id="artist" placeholder="Artic Monkeys">
                <label>Artista</label>
            </div>
            <div class="form-floating">
                <input type="file" name="song" accept="audio/*" class="form-control" id="song">
                <label>Canción</label>
            </div>
            <button class="btn btn-primary mt-3" type="submit">Añadir Cancion</button>
        </form>
    </div>

    <script src="/js/bootstrap.bundle.min.js"></script>
    <script src="/js/jquery-3.7.1.min.js"></script>
    <script src="/js/datatables.js"></script>
    <script src="/js/main.js"></script>
</body>

</html>