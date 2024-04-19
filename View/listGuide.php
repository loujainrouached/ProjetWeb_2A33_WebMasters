<?php
include "../Controller/GuideC.php";

$c = new functions();
$tab = $c->listGuide();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of Guides</title>
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
    <h1>Liste des guides</h1>
    <h2>
        <a href="addGuide.php">Add a guide</a>
    </h2>

    <table border="1" align="center">
        <tr>
            <th>ID_guide</th>
            <th>Nom</th>
            <th>Prenom</th>
            <th>Age</th>
            <th>numTel</th>
            <th>Email</th>
            <th>nbvoyages</th>
            <th>Update</th>
            <th>Delete</th>
            
        </tr>
        <?php
        foreach ($tab as $guide) {
        ?>
        <tr>
            <td><?= $guide['ID_guide']; ?></td>
            <td><?= $guide['Nom']; ?></td>
            <td><?= $guide['Prenom']; ?></td>
            <td><?= $guide['Age']; ?></td>
            <td><?= $guide['numTel']; ?></td>
            <td><?= $guide['Email']; ?></td>
            <td><?= $guide['nbvoyages']; ?></td>
            <td align="center">
                <form method="POST" action="updateguide.php">
                    <input type="submit" name="update" value="Update">
                    <input type="hidden" value="<?= $guide['ID_guide']; ?>" name="ID_guide">
                </form>
            </td>
            <td>
                <a href="deleteGuide.php?ID_guide=<?= $guide['ID_guide']; ?>" class="delete-link">Delete</a>
            </td>
           
        </tr>
        <?php
        }
        ?>
    </table>
</body>

</html>
