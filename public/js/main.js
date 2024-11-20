document.addEventListener("DOMContentLoaded", () => {
  // Seleccionar todos los elementos de audio
  const audioElements = document.querySelectorAll("audio");

  // Iterar sobre cada elemento de audio
  audioElements.forEach((audioElement) => {
    const container = audioElement.closest('.audio-player');
    const durationSpan = container.closest('tr').querySelector('.duration');

    audioElement.addEventListener('loadedmetadata', () => {
      const duration = formatTime(audioElement.duration);
      durationSpan.textContent = duration;
    });

    if (!container.querySelector('.custom-controls')) {
      const controls = document.createElement('div');
      controls.className = 'custom-controls d-flex align-items-center gap-2 mt-2';
      controls.innerHTML = `
          <button class="btn btn-sm btn-success play-btn">
              <i class="bi bi-play-fill"></i>
          </button>
          <button class="btn btn-sm btn-primary pause-btn">
              <i class="bi bi-pause-fill"></i>
          </button>
          <button class="btn btn-sm btn-dark mute-btn">
              <i class="bi bi-volume-up-fill"></i>
          </button>
      
      `;
      container.appendChild(controls);

      // Add event listeners for the controls
      const playBtn = controls.querySelector('.play-btn');
      const pauseBtn = controls.querySelector('.pause-btn');
      const muteBtn = controls.querySelector('.mute-btn');

      playBtn.addEventListener('click', () => {
          audioElement.play();
      });

      pauseBtn.addEventListener('click', () => {
          audioElement.pause();
      });

      muteBtn.addEventListener('click', () => {
          audioElement.muted = !audioElement.muted;
          muteBtn.querySelector('i').className = audioElement.muted ? 
              'bi bi-volume-mute-fill' : 'bi bi-volume-up-fill';
      });

    }
  });
});
function saveCurrentSong(id_song) {
    sessionStorage.setItem('currentSong', id_song);
}

function getCurrentSong() {
    return sessionStorage.getItem('currentSong');
}

function playSong(id_song) {
    console.log(`Playing song with ID: ${id_song}`);
}

document.querySelectorAll('.song').forEach(song => {
    song.addEventListener('play', function() {
        saveCurrentSong(this.id);
    });
});

window.addEventListener('load', function() {
    const currentSong = getCurrentSong();
    if (currentSong) {
        playSong(currentSong);
    }
});

function formatTime(seconds) {
    const minutes = Math.floor(seconds / 60);
    const secs = Math.floor(seconds % 60);
    return `${minutes}:${secs < 10 ? "0" : ""}${secs}`;
    }
$(document).ready(function () {
    $("#editSongForm").on("submit", function (event) {
        event.preventDefault(); // Evita el envío normal del formulario

        let formData = new FormData(this); // Crea un objeto FormData con los datos del formulario
        let songId = formData.get("song_id"); // Obtén el ID de la canción desde el formulario

        $.ajax({
            url: "index.php?r=updatesong", // La URL de tu controlador que procesa la actualización
            type: "POST", // Usamos POST para enviar los datos
            data: formData,
            processData: false, // No proceses los datos (es necesario para archivos)
            contentType: false, // No establezcas un contentType automáticamente
            success: function (response) {
                console.log(response); // Muestra la respuesta del servidor
                alert("¡Canción actualizada correctamente!");

                // Actualiza dinámicamente los datos de la tabla
                let row = $(`tr[data-song-id='${songId}']`);
                row.find("td:nth-child(1)").html(`<i class="bi bi-music-note-beamed"></i> ${formData.get("song_name")}`);
                row.find("td:nth-child(2)").html(`<i class="bi bi-person-circle"> ${formData.get("artist")}</i>`);

                // Si se actualiza la canción, también actualiza el enlace al archivo de audio
                if (formData.get("song")) {
                    let newSongPath = response.newSongPath; // Asegúrate de devolver el nuevo path desde el servidor
                    row.find("audio source").attr("src", newSongPath);
                    row.find("audio")[0].load(); // Recarga el reproductor de audio
                }

                // Cierra el modal después de la actualización
                $(`#editSongModal-${songId}`).modal("hide");
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText); // Muestra cualquier error que ocurra
                alert("Hubo un error al actualizar la canción.");
            }
        });
    });
});

