<?php
include "../controlador/conexion.php";
$id=$_GET["id"];
$sql=$conexion->query(" select  *from clientes where id_cliente=$id");
?>

<!DOCTYPE html>
<html lang="en">
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

  </head>
<body>
    
 <!-- Formulario para agregar clientes con Bootstrap -->
        
        <form class="col-4 p-3 m-auto"  method="post">
        <h2>Modificar cliente</h2>
        <input type="hidden" name="id" value="<?= $_GET["id"]?>">

        <?php
        include "../controlador/modificar_cliente.php";
        while($datos=$sql->fetch_object()){?>

        <div class="form-group">
            <label for="clientName">Nombre del Cliente:</label>
            <input type="text" class="form-control" id="clientName" name="clientName" value="<?=$datos->nombre?>" placeholder="Nombre del Cliente" required>
        </div>
        <div class="form-group">
            <label for="clientAge">Edad:</label>
            <input type="number" class="form-control" id="clientAge" name="clientAge" value="<?=$datos->edad?>" placeholder="Edad" required>
        </div>
        <div class="form-group">
            <label for="clientNumber">Número de Teléfono:</label>
            <input type="tel" class="form-control" id="clientNumber" name="clientNumber" value="<?=$datos->numero?>" placeholder="Número de Teléfono" required>
        </div>
        <div class="form-group">
            <label for="clientEmail">Correo Electrónico:</label>
            <input type="email" class="form-control" id="clientEmail" name="clientEmail" value="<?=$datos->email?>" placeholder="Correo Electrónico" required>
        </div>

        <?php }
        ?>
        
        
        <button type="submit" class="btn btn-primary" name="btnregistrar" value="ok">Actualizar Cliente</button>
    </form>

</body>
</html>