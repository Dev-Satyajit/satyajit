<nav class="navbar navbar-expand-lg navbar-dark" style="background-color:#0076ce; position: sticky; top:0; z-index: 999;">
<!-- <nav class="navbar navbar-expand-lg navbar-light" style="background-color: orange;"> -->
    <div class="container-fluid">
        <a class="navbar-brand" href="#">SatyaJit <i class="fab fa-buffer"></i></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link <?php if ($page == 'home') {
                                            echo 'active';
                                        } ?>" href="/satyajit">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if ($page == 'services') {
                                            echo 'active';
                                        } ?>" href="services.php">Services</a>
                </li>
                <?php
                $active = '';
                if ($page == 'users') {
                    $active = 'active';
                }
                if ($_SESSION['role'] == 1) {
                    echo '<li class="nav-item">
                <a class="nav-link ' . $active . '" href="users.php">Users</a>
                </li>';
                }
                ?>
                <li class="nav-item">
                    <a class="nav-link <?php if ($page == 'about') {
                                            echo 'active';
                                        } ?>" href="#">About</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle <?php if ($page == 'account') {
                                            echo 'active';
                                        } ?>" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Account
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                        <li><a class="dropdown-item" href="change_password.php">Reset Password</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="logout.php?id=<?php echo $_SESSION['id'] ?>">Logout</a></li>
                    </ul>
                </li>
            </ul>

        </div>
    </div>
</nav>