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
                    <?= htmlspecialchars($user['address']['zipcode']) ?>
                    <?= htmlspecialchars($user['address']['city']) ?>
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
    <div class="add-form__container">
        <form action="/" method="POST" id="add-form__form" novalidate>
            <div><label>First Name: <input type="text" name="first_name" required></label></div>
            <div><label>Last Name: <input type="text" name="last_name" required></label></div>
            <div><label>Username: <input type="text" name="username" required></label></div>
            <div><label>Email: <input type="email" name="email" required></label></div>
            <div><label>Street: <input type="text" name="street" required></label></div>
            <div><label>City: <input type="text" name="city" required></label></div>
            <div><label>Zip code: <input type="text" name="zipcode" required></label></div>
            <div><label>Phone:
                    <input type="text" id="phone" name="phone" required>
                    <input type="text" name="extension">
                    <input type="text" name="country_code">
                </label></div>
            <div><label>Company: <input type="text" name="company" required></label></div>
            <input type="submit" value="Submit">
        </form>
    </div>
    <?php
    return ob_get_clean();
}