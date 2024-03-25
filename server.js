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

// Otras rutas para manejar las operaciones CRUD de torneos, canchas, equipos, jugadores, etc.

app.listen(3000, () => {
  console.log('Servidor iniciado en http://localhost:3000');
});