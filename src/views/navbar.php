<?php
$current_page = basename($_SERVER['REQUEST_URI'], ".php");
?>

<nav class="navbar">
    <div class="container nav-container">
        <a href="/users" class="nav-logo">UsersMVC</a>
        <ul class="nav-menu">
            <li class="nav-item">
                <a href="/users" class="nav-link <?= ($current_page == 'users' || $current_page == '/') ? 'active' : ''; ?>">Users</a>
            </li>
            <li class="nav-item">
                <a href="/add-user" class="nav-link <?= $current_page == 'add-user' ? 'active' : ''; ?>">Add User</a>
            </li>
        </ul>
    </div>
</nav>