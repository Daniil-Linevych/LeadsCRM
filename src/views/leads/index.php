<h1>Users</h1>
<div>
    <ul>
        <?php
        foreach ($leads as $lead) {

        ?>
            <li><?= $lead["id"] . " " . $lead["login"] . " " . $lead["password"] ?></li>
        <?php } ?>
    </ul>
</div>