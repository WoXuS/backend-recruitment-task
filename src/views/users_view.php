<?php
function displayTable($users)
{
    echo '<table>';
    echo '<tr><th>Name</th><th>Username</th><th>Email</th><th>Address</th><th>Phone</th><th>Company</th><th>Action</th></tr>';
    foreach ($users as $user) {
        echo '<tr>';
        foreach ($user as $key => $value) {
            echo '<td>' . htmlspecialchars($value) . '</td>';
        }
        echo '<td><button class="remove-button" data-id="' . $user['id'] . '">Remove</button></td>';
        echo '</tr>';
    }
    echo '</table>';
}
?>

<form action="/" method="POST">
    <!-- form inputs for new user details -->
</form>