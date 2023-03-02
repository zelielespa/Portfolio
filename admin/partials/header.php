<nav class="navbar navbar-expand-lg bg-dark navbar-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="../index.php">Mon site :)</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="dashboard.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="2danimation.php">2D Animation</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="illustration.php">Illustration</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logo.php">Logo and Branding</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="webdesign.php">Web Design</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="photography.php">Photography</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="videoediting.php">Video editing and camera work</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="compositing.php">Compositing</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="3danimation.php">3D animation and design</a>
                </li>
               
               
            </ul>
            <ul class="navbar-nav ms-auto me-5">
                <li class="nav-item dropdown me-5">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?= $_SESSION['login'] ?>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="dashboard.php?deco=ok">Déconnexion</a></li>
                    </ul>
                </li>
            </ul>
            
        </div>
    </div>
    </nav>