<?php
include "../Controller/PaysC.php";

$c = new functions();
$tab = $c->listPays();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of pays</title>
    <style>
        /* Orange pastel background color */
        body {
            background-color: #FFDAB9;
            margin: 0;
            font-family: Arial, sans-serif;
        }

        /* Styles for the table */
        table {
            border-collapse: collapse;
            width: 70%;
            margin: 20px auto; /* Center the table */
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #FFA500;
        }

        /* Styles for the headings */
        h1,
        h2 {
            text-align: center;
            color: ##25BDC4; /* Orange Red color for headings */
        }

        /* Link style for 'Add a guide' */
        a {
            text-decoration: none;
            color: ##25BDC4;
        }

        /* Link style for 'Delete' */
        .delete-link {
            color: red;
            text-decoration: none;
        }

        /* Update button style */
        input[type="submit"] {
            background-color: #FFA500;
            border: none;
            color: white;
            padding: 5px 10px;
            border-radius: 3px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <h1>Liste des pays</h1>
    <h2>
        <a href="addPays.php">Add a pays</a>
    </h2>

    <table border="1" align="center">
        <tr>
            <th>ID_pays</th>
            <th>NomP</th>
            <th>Capital</th>
            <th>monuments</th>
            <th>ID_guide</th>
            <th>Update</th>
            <th>Delete</th>
            
        </tr>
        <?php
        foreach ($tab as $pays) {
        ?>
        <tr>
            <td><?= $pays['ID_pays']; ?></td>
            <td><?= $pays['NomP']; ?></td>
            <td><?= $pays['Capital']; ?></td>
            <td><?= $pays['monuments']; ?></td>
            <td><?= $pays['ID_guide']; ?></td>
           
            <td align="center">
                <form method="POST" action="updatePays.php">
                    <input type="submit" name="update" value="Update">
                    <input type="hidden" value="<?= $pays['ID_pays']; ?>" name="ID_pays">
                </form>
            </td>
            <td>
                <a href="deletePays.php?ID_pays=<?= $pays['ID_pays']; ?>" class="delete-link">Delete</a>
            </td>
           
        </tr>
        <?php
        }
        ?>
    </table>
</body>

</html>
