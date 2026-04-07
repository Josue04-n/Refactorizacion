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
    <link rel="icon" type="image/x-icon" href="<?php echo BASE_URL; ?>/imgs/icons8-poison-16.png">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/css_js/style.css">
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
    <?php if (isset($_SESSION['alert']) && !isset($_SESSION['signin']) && !isset($_SESSION['signup'])): ?>
        <div class="alert alert-<?php echo htmlspecialchars($_SESSION['alert']['type']); ?> alert-dismissible fade show mb-0 rounded-0 text-center" role="alert" style="z-index: 1050;">
            <?php echo htmlspecialchars($_SESSION['alert']['message']); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <main style="min-height: 80vh;">
        <?php echo $content; ?>
    </main>

    <?php if (isset($_SESSION['user_id'])): ?>
        <div class="modal fade signmodal" id="userprofilemodal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border border-light">
                    <div class="modal-header border-secondary">
                        <h1 class="modal-title fs-4">Your Profile</h1>
                        <button type="button" class="btn btn-sm btn-outline-warning rounded-2 close" data-bs-dismiss="modal">Close</button>
                    </div>
                    <div class="modal-body d-flex gap-4 align-items-center">
                        <div class="flex-shrink-0">
                            <?php $profileImage = trim($_SESSION['userimage'] ?? ''); ?>
                            <?php if ($profileImage !== ''): ?>
                                <img src="<?php echo BASE_URL; ?>/uploaded_img/<?php echo htmlspecialchars($profileImage); ?>" alt="profile" style="width:220px;height:220px;object-fit:cover;border-radius:50%;border:4px solid #ef4444;">
                            <?php else: ?>
                                <div style="width:220px;height:220px;border-radius:50%;border:4px solid #ef4444;display:flex;align-items:center;justify-content:center;color:#ef4444;font-size:110px;">
                                    <span class="fa fa-user"></span>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="flex-grow-1 text-light">
                            <p class="m-0 py-2 text-success text-uppercase"><b>Username : </b><span class="text-danger"><?php echo htmlspecialchars($_SESSION['username'] ?? ''); ?></span></p>
                            <hr class="my-2 text-secondary">
                            <p class="m-0 py-2 text-success text-uppercase"><b>Gmail : </b><span class="text-danger"><?php echo htmlspecialchars($_SESSION['useremail'] ?? ''); ?></span></p>
                            <hr class="my-2 text-secondary">
                            <div class="d-flex gap-2 mt-3">
                                <a href="<?php echo BASE_URL; ?>/logout" class="btn btn-outline-danger rounded-2">Logout</a>
                                <button type="button" class="btn btn-outline-warning rounded-2" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <?php if (!isset($_SESSION['user_id'])): ?>
        <div class="modal fade signmodal" id="signinmodal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border border-light">
                    <div class="modal-header border-secondary">
                        <h1 class="modal-title fs-3">Sign In</h1>
                        <button type="button" class="btn btn-sm btn-outline-danger rounded-2 close" data-bs-dismiss="modal">Close</button>
                    </div>
                    <div class="modal-body">
                        <?php if (isset($_SESSION['alert']) && $_SESSION['alert']['type'] === 'danger'): ?>
                            <div class="alert alert-danger p-2"><?php echo htmlspecialchars($_SESSION['alert']['message']); ?></div>
                        <?php endif; ?>
                        <form action="<?php echo BASE_URL; ?>/login" method="POST">
                            <div class="mb-3">
                                <label for="signinemail" class="form-label">Email address</label>
                                <input type="email" class="form-control" id="signinemail" name="email" placeholder="Email" required>
                            </div>
                            <div class="mb-3">
                                <label for="signinpassword" class="form-label">Password</label>
                                <input type="password" class="form-control" id="signinpassword" name="password" placeholder="Password" required>
                            </div>
                            <button type="submit" class="btn btn-sm btn-sign btn-outline-success">Sign in</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade signmodal" id="signupmodal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content border border-light">
                    <div class="modal-header border-secondary">
                        <h1 class="modal-title fs-3">Sign Up</h1>
                        <button type="button" class="btn btn-sm btn-outline-danger rounded-2 close" data-bs-dismiss="modal">Close</button>
                    </div>
                    <div class="modal-body">
                        <?php if (isset($_SESSION['alert']) && $_SESSION['alert']['type'] === 'warning'): ?>
                            <div class="alert alert-warning p-2"><?php echo htmlspecialchars($_SESSION['alert']['message']); ?></div>
                        <?php endif; ?>
                        <form action="<?php echo BASE_URL; ?>/register" method="POST" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <label for="signupusername" class="form-label">Username</label>
                                    <input type="text" class="form-control" id="signupusername" name="username" placeholder="Username" required>
                                    <small class="message"></small>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="signupemail" class="form-label">Email address</label>
                                    <input type="email" class="form-control" id="signupemail" name="email" placeholder="Email" required>
                                    <small class="message"></small>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <label for="signuppassword" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="signuppassword" name="password" placeholder="password" required>
                                    <small class="message"></small>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="signupcpassword" class="form-label">Confirm Password</label>
                                    <input type="password" class="form-control" id="signupcpassword" name="cpassword" placeholder="Confirm password" required>
                                    <small class="message"></small>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="pfp" class="form-label">Pfp</label>
                                <input type="file" class="form-control" id="pfp" name="pfp">
                                <small class="message"></small>
                            </div>
                            <button type="submit" id="submit" class="btn btn-sm btn-sign btn-outline-success">Sign Up</button>
                            <small class="message d-block mt-2"></small>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <footer class="container-fluid text-light mb-0" style="background-color: #060a11; padding-top: 15px; padding-bottom: 15px;">
        <p class="text-center mb-0">Copyright <?php echo date('Y'); ?> | Welcome to CHACHA's</p>
    </footer>
    <script>
        window.APP_BASE_URL = "<?php echo BASE_URL; ?>";
        window.APP_ROOT_URL = "<?php echo rtrim(dirname(BASE_URL), '/'); ?>";
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo BASE_URL; ?>/css_js/script.js"></script>

    <?php if (isset($_SESSION['signin'])) : ?>
        <script>
            $(document).ready(function () {
                $("#signinmodal").modal("show");
            });
        </script>
        <?php unset($_SESSION['signin']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['signup'])) : ?>
        <script>
            $(document).ready(function () {
                $("#signupmodal").modal("show");
            });
        </script>
        <?php unset($_SESSION['signup']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['alert'])) { unset($_SESSION['alert']); } ?>
</body>
</html>