<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>iDiscuss Foro</title>
    <link rel="icon" type="image/x-icon" href="/proyectorefactorizacion/public/imgs/icons8-poison-16.png">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <link rel="stylesheet" href="/proyectorefactorizacion/public/css_js/style.css">
</head>
<body>

    <nav class="navbar navbar-expand-lg sticky-top top-0" id="navbarr">
        <div class="container-fluid">
            <a class="navbar-brand ps-2 ps-sm-5" href="/proyectorefactorizacion/public/"><span class="fa fa-wechat"></span></a>
            
            <?php if (isset($_SESSION["user_id"])): ?>
                <div class="me-auto ms-1 ms-sm-3">
                    <button class="btn btn-sm border border-3 border-danger btn-outline-danger rounded-5 mx-1" data-bs-toggle="modal" data-bs-target="#userprofilemodal"><span class="fa fa-user"></span></button>
                    <button type="button" class="btn btn-outline-danger position-relative fa fa-bell" id="notf-btn">
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger invisible"><i id="notification-no"></i></span>
                    </button>
                </div>
            <?php else: ?>
                <div class="me-auto ms-1 ms-sm-3">
                    <button class="btn btn-sm btn-outline-danger rounded-0" data-bs-toggle="modal" data-bs-target="#signinmodal">LOGIN</button>
                    <button class="btn btn-sm btn-outline-danger rounded-0" data-bs-toggle="modal" data-bs-target="#signupmodal">REGISTER</button>
                    <button type="button" class="btn btn-outline-danger position-relative fa fa-bell d-none" id="notf-btn">
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger invisible"><i id="notification-no"></i></span>
                    </button>
                </div>
            <?php endif; ?>

            <ul class="list-group" id="list"></ul>
            
            <button class="navbar-toggler text-danger" type="button" id="navbarcollapse" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContentt" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="fa fa-bars"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarSupportedContentt">
                <div class="navbar-nav mx-auto mb-2 mb-lg-0 d-flex justify-content-center align-items-center">
                    <ul class="list-group list-group-horizontal-sm">
                        <li class="home list-group-item">
                            <a class="nav-link" aria-current="page" href="/proyectorefactorizacion/public/">Home</a>
                        </li>
                        <li class="about list-group-item">
                            <a class="nav-link" href="/proyectorefactorizacion/public/about">About</a>
                        </li>
                        <li class="categories dropdown list-group-item">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Categories
                            </a>
                            <ul class="dropdown-menu bg-dark">
                                <?php if (!empty($globalCategories)): ?>
                                    <?php foreach ($globalCategories as $cat): ?>
                                        <li>
                                            <a class="dropdown-item text-capitalize text-secondary" href="/proyectorefactorizacion/public/categoria/<?php echo $cat->getId(); ?>">
                                                <?php echo htmlspecialchars($cat->getName()); ?>
                                            </a>
                                        </li>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <li><a class="dropdown-item text-secondary" href="#">Sin categorías</a></li>
                                <?php endif; ?>
                            </ul>
                        </li>
                        <li class="contact list-group-item">
                            <a class="nav-link" href="/proyectorefactorizacion/public/contact">Contact</a>
                        </li>
                    </ul>
                </div>
                
                <form class="d-flex position-relative other-nav-content" role="search" method="get" action="/proyectorefactorizacion/public/buscar">
                    <input class="form-control me-2 ps-5" type="search" name="search" placeholder="Type \ to Search" aria-label="Search">
                    <button class="position-absolute start-0 ms-1 p-2 bg-transparent border-0" type="submit"><span class="fa fa-search text-secondary"></span></button>
                </form>
            </div>
        </div>
    </nav>
    <?php if (isset($_SESSION['alert'])): ?>
        <div class="alert alert-<?php echo htmlspecialchars($_SESSION['alert']['type']); ?> alert-dismissible fade show mb-0 rounded-0 text-center" role="alert" style="z-index: 1050;">
            <?php echo htmlspecialchars($_SESSION['alert']['message']); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php unset($_SESSION['alert']); ?>
    <?php endif; ?>

    <main style="min-height: 80vh;">
        <?php echo $content; ?>
    </main>

    <footer class="container-fluid text-light mb-0 mt-4" style="background-color: #060a11; padding-top: 15px; padding-bottom: 15px;">
        <p class="text-center mb-0">Copyright <?php echo date('Y'); ?> | Welcome to CHACHA's</p>
    </footer>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/proyectorefactorizacion/public/css_js/script.js"></script>
</body>
</html>