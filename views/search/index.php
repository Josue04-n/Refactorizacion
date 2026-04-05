<?php declare(strict_types=1); ?>

<div class="container my-4">
    <h1 class="mb-4">Resultados de la búsqueda para: <em>"<?php echo htmlspecialchars($keyword); ?>"</em></h1>

    <div class="list-group">
        <?php if (!empty($results)): ?>
            <?php foreach ($results as $thread): ?>
                <a href="/proyectorefactorizacion/public/hilo/<?php echo $thread->getId(); ?>" class="list-group-item list-group-item-action d-flex gap-3 py-3 shadow-sm mb-2 rounded border">
                    <img src="https://ui-avatars.com/api/?name=User+<?php echo $thread->getUserId(); ?>&background=random" alt="Avatar" width="40" height="40" class="rounded-circle flex-shrink-0">
                    <div class="d-flex gap-2 w-100 justify-content-between">
                        <div>
                            <h5 class="mb-1 text-success"><?php echo htmlspecialchars($thread->getTitle()); ?></h5>
                            <p class="mb-0 opacity-75"><?php echo htmlspecialchars(substr($thread->getDescription(), 0, 150)) . '...'; ?></p>
                        </div>
                        <small class="opacity-50 text-nowrap"><?php echo htmlspecialchars($thread->getTimestamp()); ?></small>
                    </div>
                </a>
            <?php endforeach; ?>
        <?php elseif (trim($keyword) === ''): ?>
            <div class="alert alert-info" role="alert">
                Por favor, ingresa un término de búsqueda en la barra superior.
            </div>
        <?php else: ?>
            <div class="p-5 bg-light rounded-3 shadow-sm text-center">
                <h2 class="display-6">No se encontraron resultados</h2>
                <p class="lead">No hemos encontrado ningún tema que coincida con "<b><?php echo htmlspecialchars($keyword); ?></b>".</p>
                <p>Asegúrate de que las palabras estén escritas correctamente o intenta con palabras clave diferentes.</p>
            </div>
        <?php endif; ?>
    </div>
</div>