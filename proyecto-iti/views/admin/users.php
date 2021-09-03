<?php require('../../init.php'); ?>
<?php
    if (isset($_SESSION) && !($_SESSION['admin'])) {
        header('Location: ../../');
    }

    if (isset($_GET['home'])) {
        header('Location: .');
    }

    if (isset($_GET['equip'])) {
        header('Location: equipment.php');
    }

    if (isset($_GET['users'])) {
        header('Location: users.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../images/Siscoin_Icon_3.svg">
    <link rel="stylesheet" href="../css/styles_users.css">
    <title>Users</title>
</head>
<body>
    <?php include('../extras/header_admin.html'); ?>
    <div class="container1">
        <?php if ((isset($_GET['create']))) { ?>
            <div class="switchBtns">
                <a href="users.php">View Users</a>
            </div>
            <div class="formCreate">
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" autocomplete="off">
                    <h2>Create User</h2>
                    <input required type="email" name="cMail" placeholder="Insert E-Mail"
                    maxlength="35">
                    <input required type="password" name="cPass" placeholder="Insert Password"
                    maxlength="24">
                    <input required type="text" name="cName" placeholder="Insert Name"
                    maxlength="40">
                    <div class="selectCreate">
                        <select name="cGroup" required>
                            <option value="" disabled selected>Select a Group</option>
                            <?php foreach ($listGroups as $list) { ?>
                                <option value="<?php echo $list['id_grupo'] ?>"><?php echo $list['nom_grupo'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <button type="submit" name="saveUser">Save</button>
                </form>
            </div>
        <?php } ?>
        <?php if (!(isset($_GET['create']))) { ?>
            <div class="switchBtns">
                <a href="?create">Create User</a>
            </div>
            <div class="tableUser">
                <div class="table">
                    <table>
                        <tr>
                            <th>ID</th>
                            <th>Group</th>
                            <th>E-Mail</th>
                            <th>Name</th>
                        </tr>
                        <?php foreach($listUsers as $user) { ?>
                            <tr>
                                <td><?php echo $user['id_user'] ?></th>
                                <td><?php echo $user['grupo_user'] ?></th>
                                <td><?php echo $user['mail_user'] ?></th>
                                <td><?php echo $user['nom_comp_user'] ?></th>
                            </tr>
                        <?php } ?>
                    </table>
                </div>
            </div>
        <?php } ?>
    </div>
    <script src="https://kit.fontawesome.com/84614effd5.js" crossorigin="anonymous" async></script>
    <script src="../js/script.js"></script>
</body>
</html>