<?php
function displayTable($users)
{
    ob_start();
    ?>
    <table>
        <tr>
            <th>Name</th>
            <th>Username</th>
            <th>Email</th>
            <th>Address</th>
            <th>Phone</th>
            <th>Company</th>
        </tr>
        <?php foreach ($users as $user): ?>
            <tr>
                <td>
                    <?= htmlspecialchars($user['name']) ?>
                </td>
                <td>
                    <?= htmlspecialchars($user['username']) ?>
                </td>
                <td>
                    <?= htmlspecialchars($user['email']) ?>
                </td>
                <td>
                    <?= htmlspecialchars($user['address']['street']) ?>,
                    <?= htmlspecialchars($user['address']['suite']) ?>,
                    <?= htmlspecialchars($user['address']['city']) ?>,
                    <?= htmlspecialchars($user['address']['zipcode']) ?>
                </td>
                <td>
                    <?= htmlspecialchars($user['phone']) ?>
                </td>
                <td>
                    <?= htmlspecialchars($user['company']['name']) ?>
                </td>
                <td><button class="remove-button" data-id="<?= $user['id'] ?>">Remove</button></td>
            </tr>
        <?php endforeach; ?>
    </table>
    <!-- <form action="/" method="POST">
        <label>Name: <input type="text" name="name"></label>
        <label>Username: <input type="text" name="username"></label>
        <label>Email: <input type="email" name="email"></label>
        <label>Address: <input type="text" name="address"></label>
        <label>Phone: <input type="tel" name="phone"></label>
        <label>Company: <input type="text" name="company"></label>
        <input type="submit" value="Submit">
    </form> -->

    <?php
    return ob_get_clean();
}