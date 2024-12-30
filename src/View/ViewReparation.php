<?php namespace App\View;

session_start();

use App\Model\Reparation;

if (isset($_GET['role'])) {
    $_SESSION['role'] = $_GET['role'];
}

class ViewReparation {
    public function render(?Reparation $reparation): void
    {
        echo "<div class='container'>";
        if ($reparation != null) {
            echo "<h2 class='message'>Reparation Details</h2>";
            echo "<ul>";
            echo "<li><strong>ID Reparation:</strong> " . $reparation->getIdReparation() . "</li>";
            echo "<li><strong>ID Workshop:</strong> " . $reparation->getIdWorkshop() . "</li>";
            echo "<li><strong>Name Workshop:</strong> " . $reparation->getNameWorkshop() . "</li>";
            echo "<li><strong>Fecha de Registro:</strong> " . $reparation->getRegisterDate() . "</li>";
            echo "<li><strong>Placa del Vehículo:</strong> " . $reparation->getLicensePlate() . "</li>";
            echo '<li><img src="data:image/png;base64, ' . $reparation->getCarPicture() . '" alt="carPicture" style="width: 400px"></li>';
            echo "</ul>";
        } else {
            echo "<h1 class='message' style='color: red'>PROBLEM WITH REPARATION</h1>";
        }
        echo "</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Workshop</title>
    <style>
        body {
            font-family: 'Roboto', Arial, sans-serif;
            background-color: #f3f8fc;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            color: #333;
            gap: 20px;
        }

        h2 {
            margin-bottom: 20px;
            color: #2c3e50;
        }

        form {
            background-color: #ffffff;
            padding: 20px 25px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            width: 100%;
            max-width: 400px;
        }

        form label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
            color: #2c3e50;
            font-size: 14px;
        }

        form input[type="text"],
        form input[type="number"],
        form input[type="date"],
        form input[type="submit"] {
            display: block;
            width: 100%;
            padding: 12px 15px;
            font-size: 14px;
            border-radius: 8px;
            border: 1px solid #dcdfe3;
            margin-top: 5px;
        }

        form input[type="text"],
        form input[type="number"],
        form input[type="date"] {
            margin-bottom: 15px;
            width: 92%;
            background-color: #f7f9fc;
            color: #34495e;
        }

        form input[type="submit"] {
            background-color: #3498db;
            color: #fff;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.2s;
        }

        form input[type="submit"]:hover {
            background-color: #2980b9;
            transform: scale(1.02);
        }

        ul {
            list-style: none;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            margin: 0 0 20px;
            max-width: 400px;
            width: 100%;
        }

        ul li {
            margin-bottom: 10px;
            font-size: 14px;
        }

        ul li strong {
            font-weight: bold;
        }

        .message {
            background-color: #ecf0f1;
            color: #1c1d1d;
            padding: 10px 15px;
            border-radius: 8px;
            text-align: center;
            margin-bottom: 20px;
            font-size: 14px;
            max-width: 400px;
            width: 100%;
        }
    </style>
</head>
<body>
<!-- Formulario para obtener una reparación -->
<form method="post" action="../Controller/ControllerReparation.php">
    <h1>GET REPARATION</h1>
    <label for="idReparation">
        <input type="text" name="idReparation" id="idReparation" placeholder="Enter Reparation ID" required>
    </label>
    <input type="submit" name="getReparation" value="SEND">
</form>

<!-- Formulario para insertar una reparación (solo para empleados) -->
<?php if ($_SESSION['role'] === 'employee'): ?>
    <form method="post" action="../Controller/ControllerReparation.php" enctype="multipart/form-data">
        <h1>INSERT REPARATION</h1>
        <label for="idWorkshop">ID WORKSHOP</label>
        <input type="number" name="idWorkshop" id="idWorkshop" placeholder="Enter Workshop ID" required>

        <label for="nameWorkshop">NAME WORKSHOP</label>
        <input type="text" name="nameWorkshop" id="nameWorkshop" placeholder="Enter Workshop Name" required>

        <label for="date">REGISTER DATE</label>
        <input type="text" name="date" id="date" placeholder="YYYY-MM-DD" required>

        <label for="licensePlate">LICENSE PLATE</label>
        <input type="text" name="licensePlate" id="licensePlate" placeholder="1234-XXX" required>

        <label for="carPicture">CAR PICTURE</label>
        <input type="file" name="carPicture" id="carPicture">

        <input type="submit" name="insertReparation" value="SEND">
    </form>
<?php endif; ?>
</body>
</html>
