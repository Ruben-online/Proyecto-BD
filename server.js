const express = require('express');
const mysql = require('mysql');
const cors = require('cors');

const app = express();
app.use(cors());
app.use(express.json());

const connection = mysql.createConnection({
  host: '127.0.0.1',
  user: 'root',
  password: 'tiguilasoloj.03',
  database: 'mydb'
});

// Ruta para obtener los clientes
app.get('/clientes', (req, res) => {
  const query = 'SELECT * FROM Cliente';
  connection.query(query, (err, results) => {
    if (err) {
      console.error(err);
      res.status(500).json({ error: 'Error al obtener los clientes' });
    } else {
      res.json(results);
    }
  });
});

// Ruta para obtener las reservaciones
app.get('/reservaciones', (req, res) => {
  const query = 'SELECT * FROM Reservacion';
  connection.query(query, (err, results) => {
    if (err) {
      console.error(err);
      res.status(500).json({ error: 'Error al obtener las reservaciones' });
    } else {
      res.json(results);
    }
  });
});

// Ruta para obtener los torneos
app.get('/torneos', (req, res) => {
  const query = 'SELECT * FROM Torneo';
  connection.query(query, (err, results) => {
    if (err) {
      console.error(err);
      res.status(500).json({ error: 'Error al obtener los torneos' });
    } else {
      res.json(results);
    }
  });
});

// Ruta para obtener las canchas
app.get('/canchas', (req, res) => {
  const query = 'SELECT * FROM Cancha';
  connection.query(query, (err, results) => {
    if (err) {
      console.error(err);
      res.status(500).json({ error: 'Error al obtener las canchas' });
    } else {
      res.json(results);
    }
  });
});

// Ruta para obtener los equipos
app.get('/equipos', (req, res) => {
  const query = 'SELECT * FROM Equipo';
  connection.query(query, (err, results) => {
    if (err) {
      console.error(err);
      res.status(500).json({ error: 'Error al obtener los equipos' });
    } else {
      res.json(results);
    }
  });
});

// Ruta para obtener los jugadores
app.get('/jugadores', (req, res) => {
  const query = 'SELECT * FROM Jugador';
  connection.query(query, (err, results) => {
    if (err) {
      console.error(err);
      res.status(500).json({ error: 'Error al obtener los jugadores' });
    } else {
      res.json(results);
    }
  });
});

// Otras rutas para manejar las operaciones CRUD de torneos, canchas, equipos, jugadores, etc.

app.listen(3000, () => {
  console.log('Servidor iniciado en http://localhost:3000');
});