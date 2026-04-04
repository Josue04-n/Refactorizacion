<?php declare(strict_types=1); ?>

<div class="container my-4">
    <h1 class="text-center mb-4"><?php echo htmlspecialchars($titulo ?? 'Categorías del Foro'); ?></h1>

    <div class="row">
        <?php if (!empty($categories)): ?>
            <?php foreach ($categories as $category): ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">
                                <a href="/proyectorefactorizacion/public/categoria/<?php echo $category->getId(); ?>" class="text-decoration-none text-primary">
                                    <?php echo htmlspecialchars($category->getName()); ?>
                                </a>
                            </h5>
                            <p class="card-text text-muted">
                                <?php echo htmlspecialchars($category->getDescription()); ?>
                            </p>
                        </div>
                        <div class="card-footer bg-transparent border-top-0">
                            <!-- c_reg_date removed -->
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12">
                <div class="alert alert-info text-center" role="alert">
                    Aún no hay categorías creadas en el foro.
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>