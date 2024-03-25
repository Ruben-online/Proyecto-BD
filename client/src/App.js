import React, { useEffect, useState } from 'react';
import axios from 'axios';

function App() {
  const [clientes, setClientes] = useState([]);
  const [reservaciones, setReservaciones] = useState([]);

  useEffect(() => {
    // Obtener los clientes desde el backend
    axios.get('http://localhost:3000/clientes')
      .then(response => setClientes(response.data))
      .catch(error => console.error(error));

    // Obtener las reservaciones desde el backend
    axios.get('http://localhost:3000/reservaciones')
      .then(response => setReservaciones(response.data))
      .catch(error => console.error(error));
  }, []);

  return (
    <div>
      <h1>Listado de Clientes</h1>
      <ul>
        {clientes.map(cliente => (
          <li key={cliente.idCliente}>{cliente.Nombre}</li>
        ))}
      </ul>

      <h1>Listado de Reservaciones</h1>
      <ul>
        {reservaciones.map(reservacion => (
          <li key={reservacion.idReservacion}>
            {reservacion.Fecha} - {reservacion.Hora}
          </li>
        ))}
      </ul>
    </div>
  );
}

export default App;