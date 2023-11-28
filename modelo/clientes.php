<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página con Barra Superior</title>
    <!-- Agrega el enlace al archivo de estilo de Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/9cd01b9d5e.js" crossorigin="anonymous"></script>
    <style>
        /* Agrega tu estilo personalizado aquí si es necesario */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #4CAF50;
            color: #fff;
            padding: 10px;
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        header img {
            width: 50px; /* Ajusta el tamaño del logo según sea necesario */
            vertical-align: middle;
        }

        nav {
            background-color: #333;
            overflow: hidden;
            text-align: right;
        }

        nav a {
            display: inline-block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        nav a:hover {
            background-color: #45a049;
            color: white;
        }

        section {
            padding: 20px;
        }
    </style>
</head>
<body>

    <header>
        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/7/75/Luigi_emblem.svg/2048px-Luigi_emblem.svg.png" alt="Logo" width="200" height="50">
        <h1>Luigi's Gamezone</h1>
    </header>

    <nav>
        <a href="Principal.php">Inicio</a>
        <a href="rentas.php">Rentas</a>
        <a href="ventas.php">Ventas</a>
        <a href="clientes.php">Clientes</a>
        <a href="productos.php">Inventario</a>
    </nav>

    <section>
        <h1>Registro de Clientes</h1>
        
        <!-- Formulario para agregar clientes con Bootstrap -->
        <h2>Registrar Cliente</h2>
        
            <form class="form" action="../controlador/registro_personas.php" method="post">
            <div class="form-group">
                <label for="clientName">Nombre del Cliente:</label>
                <input type="text" class="form-control" id="clientName" name="clientName" placeholder="Nombre del Cliente" required>
            </div>
            <div class="form-group">
                <label for="clientAge">Edad:</label>
                <input type="number" class="form-control" id="clientAge" name="clientAge" placeholder="Edad" required>
            </div>
            <div class="form-group">
                <label for="clientNumber">Número de Teléfono:</label>
                <input type="tel" class="form-control" id="clientNumber" name="clientNumber" placeholder="Número de Teléfono" required>
            </div>
            <div class="form-group">
                <label for="clientEmail">Correo Electrónico:</label>
                <input type="email" class="form-control" id="clientEmail" name="clientEmail" placeholder="Correo Electrónico" required>
            </div>
            <button type="submit" class="btn btn-primary" name="btnregistrar" value="ok">Registrar Cliente</button>
        </form>

        <div id="messageContainer"></div>

       <!-- Lista de clientes registrados -->
       <h2>Listado de Clientes</h2>
       <ul id="clientList">
            <!-- Aquí se mostrarán los clientes registrados -->
            <div class="col-8 p-4">
                <table id="clientTable" class="table">
                  <thead class="thead-dark">
                    <tr>
                      <th scope="col">ID</th>
                      <th scope="col">Nombre</th>
                      <th scope="col">Edad</th>
                      <th scope="col">Número de Teléfono</th>
                      <th scope="col">Correo Eléctronico</th>
                      <th scope="col">    </th>

                    </tr>
                  </thead>
                  <tbody>
                    <?php
                   include "../controlador/conexion.php";
                    $sql=$conexion->query(" select * from clientes");
                    while($datos=$sql->fetch_object()){ ?>
                        <tr>
                        <td><?=$datos->id_cliente?></td>
                        <td><?=$datos->nombre?></td>
                        <td><?=$datos->edad?></td>
                        <td><?=$datos->numero?></td>
                        <td><?=$datos->email?></td>
                        <td>
                            <a href="modificar_personas.php?id=<?=$datos->id_cliente?>" class="btn btn small btn-warning"><i class="fa-solid fa-pen-to-square"></i></a>
                            <a href="" class="btn btn small btn-danger"><i class="fa-solid fa-trash"></i></a>
                        </td>
                        </tr> 
                    <?php }
                    ?>
                   
                    
                  </tbody>
                </table>

       </ul>
   </section>

    <!-- Agrega el enlace al archivo de script de Bootstrap y jQuery -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <!-- Agrega tu script personalizado para manejar la lógica del formulario y la lista de clientes -->
    <script>
    // Agrega tu lógica de manejo de formularios y clientes aquí
document.querySelector('.form').addEventListener('submit', function (event) {
    event.preventDefault();

    const clientName = document.getElementById('clientName').value;
    const clientAge = document.getElementById('clientAge').value;
    const clientNumber = document.getElementById('clientNumber').value;
    const clientEmail = document.getElementById('clientEmail').value;

    const xhr = new XMLHttpRequest();
    xhr.open('POST', '../controlador/registro_personas.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            // Parsea la respuesta JSON
            const response = JSON.parse(xhr.responseText);

            // Muestra el mensaje en el contenedor
            if (response.status === "success") {
                // Crear un nuevo elemento de div para el mensaje
                const successMessage = document.createElement('div');
                successMessage.className = 'alert alert-success';
                successMessage.textContent = response.message;

                // Agregar el mensaje al contenedor de mensajes
                document.getElementById('messageContainer').appendChild(successMessage);

                // Limpia los campos del formulario
                document.getElementById('clientName').value = '';
                document.getElementById('clientAge').value = '';
                document.getElementById('clientNumber').value = '';
                document.getElementById('clientEmail').value = '';

                // Obtén la referencia de la tabla
                const clientTable = document.getElementById('clientTable');

                // Crea una nueva fila y agrega las celdas con la información del cliente
                const newRow = clientTable.insertRow();
                const cell1 = newRow.insertCell(0);
                const cell2 = newRow.insertCell(1);
                const cell3 = newRow.insertCell(2);
                const cell4 = newRow.insertCell(3);
                const cell5 = newRow.insertCell(4);
                const cell6 = newRow.insertCell(5);

                cell1.textContent = ''; // Puedes asignar el número de fila aquí
                cell2.textContent = clientName;
                cell3.textContent = clientAge;
                cell4.textContent = clientNumber;
                cell5.textContent = clientEmail;
                cell6.innerHTML = '<a href="" class="btn btn small btn-warning"><i class="fa-solid fa-pen-to-square"></i></a> <a href="" class="btn btn small btn-danger"><i class="fa-solid fa-trash"></i></a>';
            } else {
                alert(response.message);
            }
        }
    };
    xhr.send(`btnregistrar=ok&clientName=${clientName}&clientAge=${clientAge}&clientNumber=${clientNumber}&clientEmail=${clientEmail}`);
});
</script>


</body>
</html>
