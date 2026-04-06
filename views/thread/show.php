<?php declare(strict_types=1); ?>

<div class="container-fluid p-0 thread-page" id="maincontainer">
    <div class="container mt-0 mb-4">
        <div class="row">
            <div class="col-md-10 mx-auto">
                <div class="card my-1 rounded-0 thread-welcome" style="background-color: transparent; border: none;">
                    <div class="card-header border-0" style="border-bottom: 1px solid #2d3748 !important;">
                        <h5 class="text-light">
                            <span class="text-capitalize"><?php echo isset($thread) ? htmlspecialchars($thread->getTitle()) : 'Thread not found'; ?></span>
                        </h5>
                    </div>
                    <div class="card-body border-0" style="border-bottom: 1px solid #2d3748 !important; padding-top: 1.5rem; padding-bottom: 1.5rem;">
                        <p class="text-secondary m-0"><?php echo isset($thread) ? nl2br(htmlspecialchars($thread->getDescription())) : 'No description available.'; ?></p>
                    </div>
                    <div class="card-footer border-0 pt-3 bg-transparent">
                        <p class="m-0 text-warning">No spam!</p>
                        <?php $threadAuthor = (isset($thread) && trim($thread->getUsername()) !== '') ? $thread->getUsername() : ('usuario_' . (string) (isset($thread) ? (int) $thread->getUserId() : 0)); ?>
                        <span class="lead" style="font-size:14px;">Posted by : <b class="text-light">@<?php echo htmlspecialchars($threadAuthor); ?></b></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="position-fixed" style="bottom: 40px; right: 14px; z-index: 1040;">
        <a href="#" class="fa-solid fa-up-long float-end text-secondary text-decoration-none mb-2" id="backtotop" onclick="document.body.scrollTop=0;document.documentElement.scrollTop=0;event.preventDefault()"></a><br>
        <button class="btn btn-sm btn-outline-success text-success mt-2" type="button" style="background-color:#060a11; border-color: #198754;" data-bs-toggle="offcanvas" data-bs-target="#offcanvasThreadComment" aria-controls="offcanvasThreadComment">
            Post a Comment <img src="<?php echo BASE_URL; ?>/imgs/send-png-green.png" width="20px" alt="">
        </button>
    </div>

    <?php if (isset($_SESSION['user_id'])): ?>
        <div class="offcanvas offcanvas-bottom" data-bs-scroll="true" tabindex="-1" id="offcanvasThreadComment" style="height:150px;background-color:#060a11;">
            <div class="offcanvas-body p-1 overflow-hidden">
                <div class="row">
                    <div class="col-md-10 mx-auto mb-1 mt-0">
                        <button type="button" class="btn btn-sm float-end" data-bs-dismiss="offcanvas" style="color:red;"><span class="fa fa-close"></span></button>
                    </div>
                    <div class="col-md-10 mx-auto mb-1">
                        <form action="<?php echo BASE_URL; ?>/hilo/<?php echo (int) $threadId; ?>/comentario" method="POST">
                            <div class="position-relative">
                                <textarea name="content" class="form-control text-light" id="commento" cols="30" rows="2" placeholder="Add Your Comment" style="background-color:black;box-shadow:none; border:1px solid #333;" required></textarea>
                                <button type="submit" class="btn btn-sm position-absolute" style="right:5px; bottom:5px;"><img src="<?php echo BASE_URL; ?>/imgs/send-png-white.png" width="25px" alt=""></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="offcanvas offcanvas-bottom" tabindex="-1" id="offcanvasThreadComment" style="height:130px;background-color:#0d1117;">
            <div class="offcanvas-body overflow-hidden p-1">
                <div class="row">
                    <div class="col-md-10 mx-auto mb-1 mt-0">
                        <button type="button" class="btn btn-sm float-end" data-bs-dismiss="offcanvas" style="color:red;"><span class="fa fa-close"></span></button>
                    </div>
                    <div class="col-md-10 mx-auto mb-1">
                        <div class="p-4 rounded-0 text-light border border-secondary" style="background-color:#060a14;"><b><span class="text-danger">Sign in</span> to post a comment.</b></div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <div class="container">
        <div class="row">
            <div class="col-md-10 mx-auto my-3">
                <h2 class="text-light mb-4">Discussions</h2>
                <hr class="text-light">

                <?php if (!empty($comments)): ?>
                    <?php foreach ($comments as $comment): ?>
                        <?php $timestamp = strtotime($comment->getTimestamp()); ?>
                        <?php $username = $comment->getUsername() !== '' ? $comment->getUsername() : ('usuario_' . (string) $comment->getUserId()); ?>
                        <?php $userImage = trim($comment->getUserImage()); ?>
                        <div class="row my-3">
                            <div class="col-2 d-flex justify-content-end align-items-start">
                                <span class="rounded-5 border border-secondary overflow-hidden" style="width:31px;height:31px;display:inline-block;">
                                    <?php if ($userImage !== ''): ?>
                                        <img src="<?php echo BASE_URL; ?>/uploaded_img/<?php echo htmlspecialchars($userImage); ?>" width="31" alt="img">
                                    <?php else: ?>
                                        <img src="https://ui-avatars.com/api/?name=<?php echo urlencode($username); ?>&background=random" width="31" alt="img">
                                    <?php endif; ?>
                                </span>
                            </div>
                            <div class="col-10">
                                <p class="m-0 text-light"><b><small>@<?php echo htmlspecialchars($username); ?></small></b><i class="float-end"><small style="font-size:.7rem;">Posted : <?php echo htmlspecialchars(date('d-m H:i', $timestamp)); ?></small></i></p>
                                <p class="m-0 text-secondary"><?php echo nl2br(htmlspecialchars($comment->getContent())); ?></p>
                                <hr class="m-1 text-secondary">
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="p-4 rounded-0 text-light" style="background-color:#060a13;"><b>No comments! Be the first one to Answer it</b></div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>