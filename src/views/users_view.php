<?php
function displayTable($users)
{
    ob_start();
?>
    <div id="table-container" class="container table__container">
        <table>
            <thead>
                <tr>
                    <th><input type="checkbox" class="select-all-checkbox"></th>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Phone</th>
                    <th>Company</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user) : ?>
                    <tr>
                        <td><input type="checkbox" class="user-checkbox" data-id="<?= $user['id'] ?>"></td>
                        <td><?= htmlspecialchars($user['name']) ?></td>
                        <td><?= htmlspecialchars($user['username']) ?></td>
                        <td><?= htmlspecialchars($user['email']) ?></td>
                        <td>
                            <?= htmlspecialchars($user['address']['street']) ?>,
                            <?= htmlspecialchars($user['address']['zipcode']) ?>
                            <?= htmlspecialchars($user['address']['city']) ?>
                        </td>
                        <td><?= htmlspecialchars($user['phone']) ?></td>
                        <td><?= htmlspecialchars($user['company']['name']) ?></td>
                        <td><button class="btn btn-primary remove-button" data-id="<?= $user['id'] ?>">Remove</button></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <button class="btn btn-primary remove-selected-button">Remove Selected</button>
        <div id="pagination-container">
            <button id="prev-page" disabled><</button>
            <div id="pagination"></div>
            <button id="next-page" disabled>></button>
        </div>
    </div>
<?php
    return ob_get_clean();
}
