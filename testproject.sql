CREATE DATABASE dbweb;

USE dbweb;

CREATE TABLE songs (
    id_song INT AUTO_INCREMENT,
    song_name VARCHAR(255),
    artist VARCHAR(255),
    duration DECIMAL(10,2),
    song_path VARCHAR(255),
    PRIMARY KEY (id_song)
);

INSERT INTO songs (id_song, song_name, artist, duration, song_path) VALUES (1, "Song 1", "Artist 1", 3.45, "path1");
INSERT INTO songs (id_song, song_name, artist, duration, song_path) VALUES (2, "Song 2", "Artist 2", 2.30, "path2");

CREATE TABLE users (
    id_user INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255),
    password VARCHAR(255),
    email VARCHAR(255),
    role VARCHAR(50) DEFAULT 'user'
);

INSERT INTO users (id_user, username, password, email, role) VALUES (1, "admin", "12345678", "admin@example.com", "administrator");