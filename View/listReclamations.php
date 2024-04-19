<?php
include "../controller/ReclamationsC.php";

$c = new ReclamationsC();
$tab = $c->listReclamations();

?>

<center>
    <h1>List of reclamations</h1>
    <h2>
        <a href="addReclamations.php">Add reclamations</a>
    </h2>
</center>
<table border="1" align="center" width="70%">
    <tr>
        <th>Id reclamation</th>
        <th>Id client</th>
        <th>Date de reclamation</th>
        <th>Titre de reclamation</th>
        <th>contenu</th>
        <th>Update</th>
        <th>Delete</th>
    </tr>


    <?php
    foreach ($tab as $Reclamations) {
    ?>




        <tr>
            <td><?= $Reclamations['id_reclamation']; ?></td>
            <td><?= $Reclamations['id_client']; ?></td>
            <td><?= $Reclamations['date_reclamation']; ?></td>
            <td><?= $Reclamations['titre_reclamation']; ?></td>
            <td>
            <?= $Reclamations['contenu']; ?>
            </td>
             <td align="center"> 
                 <form method="POST" action="updateReclamations.php"> 
                      <input type="submit" name="update" value="Update"> 
                     <input type="hidden" name="id_reclamation" value="<?= $Reclamations["id_reclamation"];?>"> 


                     <input type="hidden" value=<?PHP echo $Reclamations['id_reclamation']; ?> id_reclamation="id_reclamation">
                 </form> 
            </td> 
     
            <td align="center">
            <a href="deleteReclamations.php?id_reclamation=<?= $Reclamations['id_reclamation']; ?>" onclick="return confirm('Are you sure you want to delete this ?')">Delete</a>
            </td>
        </tr>
    <?php
    }
    ?>
</table>
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



</html>


