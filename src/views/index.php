<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TEST PROJECT</title>
    <link href="/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link href="/css/datatables.css" rel="stylesheet" crossorigin="anonymous">
    <link href="/css/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/style.css">
</head>

<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-lg">
    <a class="navbar-brand" href="/index.php"><img src="/img/imatge4.png"  width="30" height="30"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/index.php"><i class="bi bi-house-fill"></i></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/index.php?r=formsongs"> <i class="bi bi-plus-circle"></i> Add Songs</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/index.php?r=songs">Songs</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/index.php?r=credits">Credits</a>
        </li>
      </ul>
      
    </div>
  </div>
</nav>


    <!-- Tabla de canciones -->
    <div class="container mt-5 container-index">

        <div class="container-title">
            <h1 class="main-title" style="text-align: center; background-color: gold;">WEBAMP</h1>
        </div>


        <div class="container py-4">
            <div class="row g-2">
                <!-- Primera fila -->
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card h-160">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title"><i class="bi bi-people-fill me-2"></i>Gestión de Usuarios</h5>
                            <p class="card-text flex-grow-1">Administra los usuarios del sistema, permisos, roles y comentarios.</p>
                            <a href="#" class="btn btn-primary mt-auto">
                                <i class="bi bi-gear-fill me-2 background-icon"></i>Gestionar Usuarios
                            </a>
                        </div>
                    </div>
                </div>


                <div class="col-2 col-md-6 col-lg-4">
                    <div class="song-col card h-100">
                        <div class="card-body d-flex flex-column song-card">
                            <div class="container songs-container">
                                <div class="table-responsive mt-4 rounded">
                                    <table class="table table-striped songs-table">

                                        <?php if (!empty($songs)): ?>
                                            <?php foreach ($songs as $song): ?>
                                                <tbody>
                                                    <tr data-song-id="<?= $song['id_song'] ?>" style="align-items: center; text-align: center;">
                                                        <td><?= $song['song_name'] ?></td>
                                                        <td><?= $song['artist'] ?></td>
                                                        <td class="align-middle">
                                                            <div class="control-btns d-flex align-items-center justify-content-end gap-2 p-2 w-100">
                                                                <!-- Contenedor del reproductor de audio -->
                                                                <div class="audio-player rounded-3">
                                                                    <audio id="myAudio" class="w-100" style="right: auto;">
                                                                        <source src="<?= htmlspecialchars($song['song_path']) ?>" type="audio/mpeg">
                                                                        Tu navegador no soporta el elemento de audio.

                                                                    </audio>
                                                                </div>
                                                            </div>
                                                                <div class="update-btns btn-group" role="group" aria-label="Controles de canción">
                                                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editSongModal-<?= $song['id_song'] ?>">
                                            <i class="bi bi-pencil"></i> 
                                        </button>
                                        
                                        <button class="btn btn-danger btn-sm" style="margin-left: 5px;">
                                            <a class="text-white text-decoration-none" href="index.php?r=deletesong&id=<?= $song['id_song'] ?>">
                                                <i class="bi bi-trash"></i> 
                                            </a>
                                        </button>
                                                                </div>
                                                            

                                </div>
                                </td>

                                </tbody>



                            </div>
                        </div>
                    </div>


                </div>
            </div>


        </div>


        <!-- Modal de edición -->
        <div class="modal fade" id="editSongModal-<?= $song['id_song'] ?>" tabindex="-1" aria-labelledby="editSongModalLabel-<?= $song['id_song'] ?>" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editSongModalLabel-<?= $song['id_song'] ?>">Editar Canción</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Formulario para editar la canción -->
                        <form action="index.php?r=updatesong" id="editSongForm" method="post" enctype="multipart/form-data">
                            <input type="text" hidden name="song_id" value="<?= $song['id_song'] ?>">
                            <div class="form-floating mb-3">
                                <input type="text" name="song_name" value="<?= $song['song_name'] ?>" class="form-control" id="song_name" placeholder="Merodian">
                                <label for="song_name">Nombre de la canción</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" name="artist" value="<?= $song['artist'] ?>" class="form-control" id="artist" placeholder="Dave">
                                <label for="artist">Artista</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="file" name="song" accept="audio/*" class="form-control" id="song">
                                <label for="song">Seleccionar una nueva canción</label>
                                <?php if (!empty($song['song_path'])): ?>
                                    <small class="form-text text-muted">
                                        Canción actual:
                                        <a href="<?= $song['song_path'] ?>" target="_blank"><?= basename($song['song_path']) ?></a>
                                    </small>
                                <?php endif; ?>
                            </div>
                            <button class="btn btn-primary mt-3" type="submit">Guardar Cambios</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    <?php endforeach; ?>
<?php else: ?>
    <tbody>
        <tr>
            <td colspan="4">No hay canciones disponibles</td>
        </tr>
    </tbody>
<?php endif; ?>
</table>
    </div>
    </div>


    <!-- Archivos necesarios para Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script src="/js/bootstrap.bundle.min.js"></script>
    <script src="/js/jquery-3.7.1.min.js"></script>
    <script src="/js/datatables.js"></script>
    <script src="/js/main.js"></script>
</body>

</html>