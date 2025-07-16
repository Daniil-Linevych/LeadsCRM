<h1>Users</h1>
<div>
    <ul>
        <?php
        foreach ($users as $user) {

        ?>
            <li><?= $user["id"] . " " . $user["login"] . " " . $user["password"] ?></li>
        <?php } ?>
    </ul>
</div>