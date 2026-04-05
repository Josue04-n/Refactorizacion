<?php declare(strict_types=1); ?>

<div class="container my-4">
    <div class="p-4 mb-4 rounded-3 shadow-sm" style="background-color: #121826; border: 1px solid #1f2937;">
        <h1 class="display-6 fw-bold text-light">
            Welcome To <span class="text-danger"><?php echo isset($category) ? htmlspecialchars($category->getName()) : 'Category'; ?></span> Threads
        </h1>
        <p class="fs-6 mt-3 text-secondary">
            <?php echo isset($category) ? htmlspecialchars($category->getDescription()) : 'Explora y responde las preguntas de la comunidad sobre este tema.'; ?>
        </p>
        <hr class="my-4" style="border-color: #374151;">
        <p class="text-warning mb-0 fw-bold" style="font-size: 0.9rem;">No spam!</p>
    </div>

    <h3 class="mb-4 mt-5 text-light text-uppercase fw-bold fs-4">BROWSE QUESTIONS</h3>

    <div class="list-group mb-5 pb-5">
        <?php if (!empty($threads)): ?>
            <?php foreach ($threads as $thread): ?>
                <div class="list-group-item bg-transparent border-0 border-bottom border-secondary py-3 d-flex align-items-start gap-3 px-0">
                    
                    <img src="https://ui-avatars.com/api/?name=User+<?php echo $thread->getUserId(); ?>&background=random" alt="Avatar" width="45" height="45" class="rounded-circle mt-1">
                    
                    <div class="w-100">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <h6 class="mb-0 fw-bold" style="color: #38bdf8;">@usuario_<?php echo $thread->getUserId(); ?></h6>
                            <small class="text-secondary fst-italic" style="font-size: 0.75rem;">Posted : <?php echo htmlspecialchars($thread->getTimestamp()); ?></small>
                        </div>
                        
                        <h5 class="mb-1 mt-2">
                            <a href="/proyectorefactorizacion/public/hilo/<?php echo $thread->getId(); ?>" class="text-decoration-none fw-bold" style="color: #3b82f6;">
                                <?php echo htmlspecialchars($thread->getTitle()); ?>
                            </a>
                        </h5>
                        
                        <p class="mb-2 text-light opacity-75 mt-2" style="font-size: 0.95rem;">
                            <?php echo htmlspecialchars($thread->getDescription()); ?>
                        </p>
                        
                        <div class="d-flex justify-content-between mt-3">
                            <span class="text-info" style="font-size: 0.85rem;">Click title to view replies</span>
                            <a href="/proyectorefactorizacion/public/hilo/<?php echo $thread->getId(); ?>" class="text-info text-decoration-none"><i class="fa fa-reply me-1"></i></a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="alert bg-transparent border-0 text-warning px-0" role="alert">
                <span style="color: #eab308;">There's no Reply Yet | Be the first one Answer it.</span>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php if(isset($_SESSION['user_id'])): ?>
    <button type="button" class="btn border-success text-success position-fixed bottom-0 end-0 m-4 rounded-1 shadow px-3 py-2" style="z-index: 1000; background-color: #060a11;">
        Add Your Question <i class="fa fa-paper-plane ms-2"></i>
    </button>
<?php else: ?>
    <a href="/proyectorefactorizacion/public/login" class="btn border-success text-success position-fixed bottom-0 end-0 m-4 rounded-1 shadow px-3 py-2 text-decoration-none" style="z-index: 1000; background-color: #060a11;">
        Add Your Question <i class="fa fa-paper-plane ms-2"></i>
    </a>
<?php endif; ?>