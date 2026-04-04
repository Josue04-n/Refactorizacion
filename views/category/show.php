<?php declare(strict_types=1); ?>

<div class="container my-4">
    <h1 class="text-center mb-4">Hilos de la categoria</h1>

    <div class="row">
        <?php if (!empty($threads)): ?>
            <?php foreach ($threads as $thread): ?>
                <div class="col-12 mb-3">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">
                                <?php echo htmlspecialchars($thread->getTitle()); ?>
                            </h5>
                            <p class="card-text text-muted mb-2">
                                <?php echo htmlspecialchars($thread->getDescription()); ?>
                            </p>
                            <small class="text-muted">
                                Publicado: <?php echo htmlspecialchars($thread->getTimestamp()); ?>
                            </small>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12">
                <div class="alert alert-info text-center" role="alert">
                    Esta categoria aun no tiene hilos.
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
