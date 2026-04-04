<?php
/**
 * @param array<\Lenovo\ProyectoRefactorizacion\Domain\Entities\Thread> $threads
 */
?>
<div class="container mt-4">
    <h2>Lista de Temas</h2>
    <div class="list-group">
        <?php foreach ($threads as $thread): ?>
            <a href="#" class="list-group-item list-group-item-action">
                <h5 class="mb-1"><?php echo htmlspecialchars($thread->getTitle()); ?></h5>
                <p class="mb-1"><?php echo htmlspecialchars($thread->getContent()); ?></p>
                <small>Publicado el <?php echo $thread->getCreatedAt()->format('d/m/Y'); ?></small>
            </a>
        <?php endforeach; ?>
    </div>
</div>