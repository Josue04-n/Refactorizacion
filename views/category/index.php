<?php declare(strict_types=1); ?>

<div class="container-fluid p-0" id="maincontainer">
<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active" data-bs-interval="1500">
            <img src="<?php echo BASE_URL; ?>/imgs/slider-1.jpg" class="d-block w-100" alt="Slider 1" height="400">
        </div>
        <div class="carousel-item" data-bs-interval="1500">
            <img src="<?php echo BASE_URL; ?>/imgs/slider-2.jpg" class="d-block w-100" alt="Slider 2" height="400">
        </div>
        <div class="carousel-item">
            <img src="<?php echo BASE_URL; ?>/imgs/slider-3.jpg" class="d-block w-100" alt="Slider 3" height="400">
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

<div class="container">
    <h2 class="text-center my-3 text-light">Welcome to <span class="text-danger">IDiscuss</span></h2>
    
    <div class="row">
        <?php if (!empty($categories)): ?>
            <?php foreach ($categories as $category): ?>
                <div class="col-md-4 d-flex justify-content-center align-items-stretch">
                    <div class="card my-2 border border-secondary" style="width: 18rem; background-color:#060a13;">
                        <?php $imageName = trim($category->getImages()); ?>
                        <img src="<?php echo BASE_URL; ?>/imgs/<?php echo htmlspecialchars($imageName !== '' ? $imageName : 'card-7.jpg'); ?>" class="card-img-top" style="height:200px;" alt="<?php echo htmlspecialchars($category->getName()); ?>">
                        
                        <div class="card-body">
                            <h5 class="card-title text-light text-capitalize fw-bold">
                                <a href="<?php echo BASE_URL; ?>/categoria/<?php echo $category->getId(); ?>" class="text-decoration-none text-light">
                                    <?php echo htmlspecialchars($category->getName()); ?>
                                </a>
                            </h5>
                            <p class="card-text text-secondary">
                                <?php echo htmlspecialchars(substr($category->getDescription(), 0, 60)); ?>...
                            </p>
                        </div>
                        <div class="card-footer">
                            <a href="<?php echo BASE_URL; ?>/categoria/<?php echo $category->getId(); ?>" class="btn btn-sm text-danger btn-outline-danger" style="background-color:black;">
                                Read Threads
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12 text-center">
                <div class="alert alert-secondary bg-dark text-light border-secondary">
                    No hay categorías creadas aún.
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
</div>