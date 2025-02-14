<div class="container-fluid">
    <nav class="navbar navbar-expand-sm bg-light navbar-light d-flex justify-content-between">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="#">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Abous us</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Login</a>
            </li>
            
        </ul>
        <div class="col-md-1">
            
            <ul class="nav nav-tabs">
                
                <li class="nav-item dropdown d-flex">
                    
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown"><i class="fa-solid fa-user"></i> <?= $_SESSION['user'] ?></a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="login.php">Log out</a>
                    </div>
                </li>
                
            </ul> 
        </div>
    </nav>
</div>