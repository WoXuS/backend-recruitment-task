<?php
function displayTable($users)
{
    ob_start();
?>
    <div class="table__container">
        <table>
            <thead>
                <tr>
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
    </div>

    <div class="form__container">
        <form action="/" method="POST" id="add-form__form" novalidate>
            <div class="form__input-container input-group">
                <div class="form__input">
                    <input type="text" name="first_name" id="first_name" value="John">
                    <label for="first_name" id="first_name-label">First Name</label>
                </div>
                <div class="form__input">
                    <input type="text" name="last_name" id="last_name" value="Doe">
                    <label for="last_name" id="last_name-label">Last Name</label>
                </div>
            </div>
            <div class="form__input-container">
                <div class="form__input">
                    <input type="text" name="username" id="username" value="johndoe">
                    <label for="username" id="username-label">Username</label>
                </div>
            </div>
            <div class="form__input-container">
                <div class="form__input">
                    <input type="text" name="email" id="email" value="john.doe@example.com">
                    <label for="email" id="email-label">Email</label>
                </div>
            </div>
            <div class="form__input-container input-group">
                <div class="form__input">
                    <input type="text" name="street" id="street" value="123 Main St">
                    <label for="street" id="street-label">Street</label>
                </div>
                <div class="form__input">
                    <input type="text" name="zipcode" id="zipcode" value="90210">
                    <label for="zipcode" id="zipcode-label">Zip Code</label>
                </div>
                <div class="form__input">
                    <input type="text" name="city" id="city" value="Los Angeles">
                    <label for="city" id="city-label">City</label>
                </div>
            </div>
            <div class="form__input-container input-group">
                <div class="form__input">
                    <input type="text" name="phone" id="phone" value="+1 (123) 456-7890">
                    <label for="phone" id="phone-label">Phone</label>
                </div>
                <div class="form__input">
                    <input type="text" name="extension" id="extension" value="x123456">
                    <label for="extension" id="extension-label">Extension</label>
                </div>
            </div>
            <div class="form__input-container">
                <div class="form__input">
                    <input type="text" name="company" id="company" value="Acme Inc">
                    <label for="company" id="company-label">Company</label>
                </div>
            </div>
            <input type="submit" value="Submit" class="btn btn-primary">
        </form>
    </div>

<?php
    return ob_get_clean();
}
