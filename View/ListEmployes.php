<?php
include "../Controller/EmployeC.php";

$user1 = new UserC();
$tab = $user1->listeEmploye();
if (isset($_GET['action']) && $_GET['action'] == 'supp' && isset($_GET['id_user'])) {
    $user1->deleteuser($_GET['id_user']);
    header("Location: " . strtok($_SERVER["PHP_SELF"], '?'));
    exit;
}

?>

<style>
    /* Style pour rendre les icônes cliquables */
    .icon {
        cursor: pointer;
        margin-right: 5px;
    }
</style>

<table border="1">
<tr>
    <th>Id</th>
    <th>Nom</th>
    <th>Prénom</th>
    <th>Email</th>
    <th>Mot de passe</th>
    <th>Confirmation Mdp</th>
    <th>Nature</th>
    <th>Photo</th>
    <th>Action</th>
    <th>Update</th>
</tr>
<?php foreach ($tab as $user): ?>
    <tr>
        <td><?= $user['id_user']; ?></td>
        <td><?= $user['nom_user']; ?></td>
        <td><?= $user['prenom_user']; ?></td>
        <td><?= $user['email_user']; ?></td>
        <td><?= $user['mdp']; ?></td>
        <td><?= $user['confirm_mdp']; ?></td>
        <td><?= $user['nature_user']; ?></td>
        <td><img src="<?= $user['photo_user']; ?>" width="100px" height="70px"></td>
        <td>
            <a href="javascript:void(0);" onclick="confirmDelete(<?= $user['id_user']; ?>);">
                <img src="TRASH.PNG" alt="Supprimer" class="icon">
            </a>
        </td>
        <td align="center">
                <form method="POST" action="editUser.php">
                    <input type="submit" name="update" value="Update">
                    <input type="hidden" value=<?PHP echo $user['id_user']; ?> name="id_user">
                </form>
            </td>
    </tr>
<?php endforeach; ?>
</table>

<script>
function confirmDelete(id_user) {
    if (confirm("Êtes-vous sûr de vouloir supprimer cet utilisateur ?")) {
        window.location.href = "?action=supp&id_user=" + id_user;
    }
}
</script>
