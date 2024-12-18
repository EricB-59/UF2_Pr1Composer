<?php namespace App\View;

use App\Model\Reparation;
require '../Controller/ControllerReparation.php';
?>

<?php
class ViewReparation {
    function render(Reparation | null $reparation): void
    {
        if($reparation != null) {
            echo "<h2 class='message'>Reparation Details</h2>";
            echo "<ul>";
            echo "<li><strong>ID Reparation:</strong> " . $reparation->getIdReparation() . "</li>";
            echo "<li><strong>ID Workshop:</strong> " . $reparation->getIdWorkshop() . "</li>";
            echo "<li><strong>Fecha de Registro:</strong> " . $reparation->getRegisterDate() . "</li>";
            echo "<li><strong>Placa del Vehículo:</strong> " . $reparation->getLicensePlate() . "</li>";
            echo "</ul>";
        } else {
            echo "<h1 class='message'>No reparation found.</h1>";
        }
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
                flex-direction: column;
                align-items: center;
                justify-content: center;
                min-height: 100vh;
                color: #333;
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
            form input[type="submit"] {
                display: block;
                width: 100%;
                padding: 12px 15px;
                font-size: 14px;
                border-radius: 8px;
                border: 1px solid #dcdfe3;
                margin-top: 5px;
            }

            form input[type="text"] {
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
                margin: 0;
                background-color: #fff;
                padding: 20px;
                border-radius: 10px;
                box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
                margin-bottom: 20px;
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
        <form method="post">
            <label for="idReparation"> GET REPARATION
                <input type="text" name="idReparation">
            </label>
            <input type="submit" name="getReparation" value="SEND">
        </form>
        <br>
        <?php
        session_start();
        $_SESSION['role'] = $_GET['role'];

        if ($_SESSION['role'] === 'employee') { ?>
            <form method="post">
                <h1>INSERT REPARATION</h1>
                <label for="idWorkshop"> ID WORKSHOP
                    <input type="number" name="idWorkshop">
                </label>
                <label for="date">
                    <input type="date" name="date">
                </label>
                <label for="licensePlate">
                    <input type="text" placeholder="1234-XXX" name="licensePlate">
                </label>
                <input type="submit" name="insertReparation" value="SEND">
            </form>
        <?php } ?>
    </body>
</html>
