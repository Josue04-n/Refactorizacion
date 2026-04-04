<?php declare(strict_types=1); ?>

<div class="container my-4">
    <div class="p-5 mb-4 bg-light rounded-3 shadow-sm">
        <div class="container-fluid py-2">
            <h1 class="display-5 fw-bold text-primary">
                <?php echo isset($thread) ? htmlspecialchars($thread->getTitle()) : 'Título del Tema'; ?>
            </h1>
            <p class="col-md-10 fs-5 mt-3">
                <?php echo isset($thread) ? nl2br(htmlspecialchars($thread->getDescription())) : 'Descripción del tema cargando...'; ?>
            </p>
            <hr class="my-4">
            <p class="text-muted">
                Publicado por el usuario con ID: <b><?php echo isset($thread) ? $thread->getUserId() : 'Desconocido'; ?></b>
            </p>
        </div>
    </div>

    <div class="card mb-5 shadow-sm">
        <div class="card-header bg-white text-dark fw-bold">
            Publicar una respuesta
        </div>
        <div class="card-body">
            <form action="/proyectorefactorizacion/public/comentario/guardar" method="POST">
                <input type="hidden" name="thread_id" value="<?php echo htmlspecialchars((string) $threadId); ?>">
                
                <div class="mb-3">
                    <label for="comment_content" class="form-label">Escribe tu comentario:</label>
                    <textarea class="form-control" id="comment_content" name="comment_content" rows="3" required></textarea>
                </div>
                <button type="submit" class="btn btn-success">Publicar Comentario</button>
            </form>
        </div>
    </div>

    <h3 class="mb-4">Discusión (<?php echo count($comments); ?> respuestas)</h3>

    <div class="list-group mb-5">
        <?php if (!empty($comments)): ?>
            <?php foreach ($comments as $comment): ?>
                <div class="list-group-item d-flex gap-3 py-3 shadow-sm mb-2 rounded border">
                    <img src="https://ui-avatars.com/api/?name=User+<?php echo $comment->getUserId(); ?>&background=random" alt="Avatar" width="40" height="40" class="rounded-circle flex-shrink-0 mt-1">
                    <div class="w-100">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <h6 class="mb-0 fw-bold">Usuario ID: <?php echo $comment->getUserId(); ?></h6>
                            <small class="text-muted text-nowrap"><?php echo htmlspecialchars($comment->getTimestamp()); ?></small>
                        </div>
                        <p class="mb-0 text-dark">
                            <?php echo nl2br(htmlspecialchars($comment->getContent())); ?>
                        </p>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="alert alert-secondary text-center" role="alert">
                Nadie ha respondido aún. ¡Sé el primero en aportar a la discusión!
            </div>
        <?php endif; ?>
    </div>
</div>