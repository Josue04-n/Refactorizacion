<?php declare(strict_types=1); ?>

<div class="container-fluid p-0 threadlist-page" id="maincontainer">
    
    <div class="container my-4">
        <div class="row">
            <div class="col-md-10 mx-auto">
                <div class="card rounded-0 threadlist-welcome" style="background-color: transparent; border: none;">
                    <div class="card-header border-0" style="border-bottom: 1px solid #2d3748 !important;">
                        <h5 class="text-light">WelcØme To <span class="text-capitalize text-danger"><?php echo isset($category) ? htmlspecialchars($category->getName()) : 'Category'; ?></span> Threads</h5>
                    </div>
                    <div class="card-body border-0" style="border-bottom: 1px solid #2d3748 !important; padding-top: 1.5rem; padding-bottom: 1.5rem;">
                        <p class="text-secondary m-0" style="font-size: 0.95rem;"><?php echo isset($category) ? htmlspecialchars($category->getDescription()) : 'Description...'; ?></p>
                    </div>
                    <div class="card-footer border-0 pt-3 bg-transparent">
                        <p class="m-0 text-warning" style="font-size: 0.9rem;">No spam!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="position-fixed" style="bottom: 40px; right: 14px; z-index: 1040;">
        <a href="#" class="fa-solid fa-up-long float-end text-secondary text-decoration-none mb-2" id="backtotop" onclick="document.body.scrollTop=0;document.documentElement.scrollTop=0;event.preventDefault()"></a><br>
        <button class="btn btn-sm btn-outline-success text-success mt-2" type="button" style="background-color:#060a11; border-color: #198754;" data-bs-toggle="offcanvas" data-bs-target="#offcanvasthreadlist" aria-controls="offcanvasBottom">
            Add Your Question <img src="<?php echo BASE_URL; ?>/imgs/send-png-green.png" width="20px" alt="">
        </button>
    </div>

    <?php if (isset($_SESSION["user_id"])): ?>
        <div class="offcanvas offcanvas-bottom" data-bs-scroll="true" tabindex="-1" id="offcanvasthreadlist" style="height:180px;background-color:#060a11;">
            <div class="offcanvas-body p-1 overflow-hidden">
                <div class="row">
                    <div class="col-md-10 mx-auto mb-1 mt-0">
                        <button type="button" class="btn btn-sm float-end" data-bs-dismiss="offcanvas" style="color:red;"><span class="fa fa-close"></span></button>
                    </div>
                    <div class="col-md-10 mx-auto mb-1">
                        <form action="<?php echo BASE_URL; ?>/categoria/<?php echo isset($category) ? $category->getId() : 0; ?>/hilo/guardar" method="POST">
                            <div class="mb-3">
                                <input type="text" name="thread_title" class="form-control text-light" style="background-color:black; box-shadow:none; border:1px solid #333;" placeholder="Question Title" required>
                            </div>
                            <div class="mb-3 position-relative">
                                <textarea name="thread_desc" class="form-control text-light" style="background-color:black; box-shadow:none; border:1px solid #333;" cols="30" rows="2" placeholder="Question Description" required></textarea>
                                <button type="submit" class="btn btn-sm position-absolute" style="right:5px; bottom:5px;">
                                    <img src="<?php echo BASE_URL; ?>/imgs/send-png-white.png" width="25px" alt="">
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="offcanvas offcanvas-bottom" tabindex="-1" id="offcanvasthreadlist" style="height:130px;background-color:#0d1117;">
            <div class="offcanvas-body overflow-hidden p-1">
                <div class="row">
                    <div class="col-md-10 mx-auto mt-0">
                        <button type="button" class="btn btn-sm float-end" data-bs-dismiss="offcanvas" style="color:red;"><span class="fa fa-close"></span></button>
                    </div>
                    <div class="col-md-10 mx-auto">
                        <div class="p-4 rounded-0 text-light border border-secondary mb-2" style="background-color:#060a14;">
                            <b><span class="text-danger">Sign in</span> to post a Question.</b>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <div class="container my-2">
        <div class="row">
            <div class="col-md-10 mx-auto">
                <h2 class="fw-bold text-light mt-2 mb-3">BROWSE QUESTIONS</h2>
                <hr class="text-secondary mb-4" style="border-top: 1px solid #4a5568;">
                
                <?php if (!empty($threads)): ?>
                    <?php foreach ($threads as $thread): ?>
                        <div class="row mb-3">
                            <div class="col-2 d-flex justify-content-end align-items-start pt-1">
                                <span class="rounded-5 border border-secondary overflow-hidden" style="width:31px; height:31px; display:inline-block;">
                                    <img src="https://ui-avatars.com/api/?name=User+<?php echo $thread->getUserId(); ?>&background=random" class="img-fluid" width="31px" alt="">
                                </span>
                            </div>
                            <div class="col-10 ps-0">
                                <p class="m-0 text-light">
                                    <b><small>@usuario_<?php echo $thread->getUserId(); ?></small></b> 
                                    <i class="float-end text-secondary" style="font-size:.7rem;"><small>Posted : <?php echo htmlspecialchars($thread->getTimestamp()); ?></small></i>
                                </p>
                                
                                <h5 class="mt-1 mb-2">
                                    <a class="text-decoration-none" href="<?php echo BASE_URL; ?>/hilo/<?php echo $thread->getId(); ?>">
                                        <span style="font-size:14px; color: #0ea5e9; font-weight: 600;"><?php echo htmlspecialchars($thread->getTitle()); ?></span>
                                    </a>
                                </h5>
                                
                                <p class="text-secondary mb-3" style="font-size: 0.9rem; line-height: 1.4;">
                                    <?php echo htmlspecialchars($thread->getDescription()); ?>
                                </p>
                                
                                <?php 
                                    // Verificamos si existe el método para no romper la vista
                                    $numReplies = method_exists($thread, 'getReplyCount') ? $thread->getReplyCount() : 0; 
                                ?>
                                
                                <?php if ($numReplies <= 0): ?>
                                    <p class="w-sm-50 m-0"><a class="text-decoration-none p-0 text-warning d-block" style="font-size:12px;" href="<?php echo BASE_URL; ?>/hilo/<?php echo $thread->getId(); ?>">There's no Reply Yet | Be the first one Answer it. <span class="pt-1 fa fa-reply float-end"></span></a></p>
                                <?php elseif ($numReplies == 1): ?>
                                    <p class="w-sm-50 m-0"><a class="text-decoration-none p-0 text-danger d-block" style="font-size:12px;" href="<?php echo BASE_URL; ?>/hilo/<?php echo $thread->getId(); ?>">There's only <?php echo $numReplies; ?> Reply <span class="pt-1 fa fa-reply float-end"></span></a></p>
                                <?php else: ?>
                                    <p class="w-sm-50 m-0"><a class="text-decoration-none p-0 text-info d-block" style="font-size:12px;" href="<?php echo BASE_URL; ?>/hilo/<?php echo $thread->getId(); ?>">There are <?php echo $numReplies; ?> Replies <span class="pt-1 fa fa-reply float-end"></span></a></p>
                                <?php endif; ?>
                                
                                <hr class="text-secondary mt-3" style="border-top: 1px solid #2d3748;">
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="lead text-secondary p-4 rounded-2 my-1" style="background-color:#060a15;">
                        No Threads<p>Be the first one to ask a Qn.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>