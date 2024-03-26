import React, { useEffect, useState } from 'react';
import axios from 'axios';

function App() {
  const [clientes, setClientes] = useState([]);
  const [reservaciones, setReservaciones] = useState([]);
  const [torneos, setTorneos] = useState([]);
  const [canchas, setCanchas] = useState([]);
  const [equipos, setEquipos] = useState([]);
  const [jugadores, setJugadores] = useState([]);

  useEffect(() => {
    // Obtener los clientes desde el backend
    axios.get('http://localhost:3000/clientes')
      .then(response => setClientes(response.data))
      .catch(error => console.error(error));

    // Obtener las reservaciones desde el backend
    axios.get('http://localhost:3000/reservaciones')
      .then(response => setReservaciones(response.data))
      .catch(error => console.error(error));

    // Obtener los torneos desde el backend
    axios.get('http://localhost:3000/torneos')
      .then(response => setTorneos(response.data))
      .catch(error => console.error(error));

    // Obtener las canchas desde el backend
    axios.get('http://localhost:3000/canchas')
      .then(response => setCanchas(response.data))
      .catch(error => console.error(error));

    // Obtener los equipos desde el backend
    axios.get('http://localhost:3000/equipos')
      .then(response => setEquipos(response.data))
      .catch(error => console.error(error));

    // Obtener los jugadores desde el backend
    axios.get('http://localhost:3000/jugadores')
      .then(response => setJugadores(response.data))
      .catch(error => console.error(error));
  }, []);

  return (
    <div>
      {/* Listado de clientes */}
      <h1>Listado de Clientes</h1>
      <ul>
        {clientes.map(cliente => (
          <li key={cliente.idCliente}>{cliente.Nombre}</li>
        ))}
      </ul>

      {/* Listado de reservaciones */}
      <h1>Listado de Reservaciones</h1>
      <ul>
        {reservaciones.map(reservacion => (
          <li key={reservacion.idReservacion}>
            {reservacion.Fecha} - {reservacion.Hora}
          </li>
        ))}
      </ul>

      {/* Listado de torneos */}
      <h1>Listado de Torneos</h1>
      <ul>
        {torneos.map(torneo => (
          <li key={torneo.idTorneo}>{torneo.Nombre}</li>
        ))}
      </ul>

      {/* Listado de canchas */}
      <h1>Listado de Canchas</h1>
      <ul>
        {canchas.map(cancha => (
          <li key={cancha.idCancha}>{cancha.Descripcion}</li>
        ))}
      </ul>

      {/* Listado de equipos */}
      <h1>Listado de Equipos</h1>
      <ul>
        {equipos.map(equipo => (
          <li key={equipo.idEquipo}>{equipo.Nombre}</li>
        ))}
      </ul>

      {/* Listado de jugadores */}
      <h1>Listado de Jugadores</h1>
      <ul>
        {jugadores.map(jugador => (
          <li key={jugador.idJugador}>{jugador.Nombre}</li>
        ))}
      </ul>
    </div>
  );
}

export default App;