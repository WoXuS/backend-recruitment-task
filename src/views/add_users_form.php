<?php
function displayForm()
{
    ob_start();
    $user_added = isset($_SESSION['user_added']) ? $_SESSION['user_added'] : false;
?>
    <div class="container form__container">
        <h1>Adding a new user</h1>
        <h3>Please fill in the form below</h3>
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
                    <input type="text" name="zipcode" id="zipcode" value="902101234">
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
            <div class="form__button-section">
                <?php if ($user_added) : ?>
                    <div class="form__success-container">
                        <div class='form__success-msg'>✓ User <?php echo $user_added; ?> added successfully. What would you like to do?</div>
                        <div class="form__button-group">
                            <input type="submit" value="Add another user" class="btn btn-primary">
                            <a href="/users" class='btn'>View all users</a>
                        </div>
                    </div>
                    <?php unset($_SESSION['user_added']); ?>
                <?php else : ?>
                    <input type="submit" value="Submit" class="btn btn-primary">
                <?php endif; ?>
            </div>
        </form>
    </div>
<?php
    echo ob_get_clean();
}
