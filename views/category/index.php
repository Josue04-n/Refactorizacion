<?php declare(strict_types=1); ?>

<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="/proyectorefactorizacion/public/imgs/slider-1.jpg" class="d-block w-100" alt="Slider 1" style="height: 400px; object-fit: cover;">
        </div>
        <div class="carousel-item">
            <img src="/proyectorefactorizacion/public/imgs/slider-2.jpg" class="d-block w-100" alt="Slider 2" style="height: 400px; object-fit: cover;">
        </div>
        <div class="carousel-item">
            <img src="/proyectorefactorizacion/public/imgs/slider-3.jpg" class="d-block w-100" alt="Slider 3" style="height: 400px; object-fit: cover;">
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

<div class="container my-5">
    <h2 class="text-center mb-5 fw-bold" style="color: #f8f9fa;">Welcome to <span class="text-danger">iDiscuss</span></h2>
    
    <div class="row">
        <?php if (!empty($categories)): ?>
            <?php foreach ($categories as $category): ?>
                <div class="col-md-4 mb-4 d-flex justify-content-center">
                    <div class="card bg-dark text-light border-0 shadow-lg" style="width: 18rem; background-color: #121826 !important;">
                        
                        <img src="https://picsum.photos/seed/<?php echo $category->getId(); ?>/500/400" class="card-img-top" alt="<?php echo htmlspecialchars($category->getName()); ?>">
                        
                        <div class="card-body">
                            <h5 class="card-title fw-bold">
                                <a href="/proyectorefactorizacion/public/categoria/<?php echo $category->getId(); ?>" class="text-decoration-none text-light">
                                    <?php echo htmlspecialchars($category->getName()); ?>
                                </a>
                            </h5>
                            <p class="card-text text-secondary mt-3 mb-4" style="font-size: 0.95rem;">
                                <?php echo htmlspecialchars(substr($category->getDescription(), 0, 90)); ?>...
                            </p>
                            <a href="/proyectorefactorizacion/public/categoria/<?php echo $category->getId(); ?>" class="btn btn-outline-danger w-100 rounded-1">
                                View Threads
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