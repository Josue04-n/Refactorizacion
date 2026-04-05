<?php declare(strict_types=1); ?>

<div class="container-fluid p-0 contact-page" id="maincontainer">
    <div class="container my-5">
        <div class="row">
            <div class="col-md-5 mx-auto bg-dark p-4 rounded shadow">
                <h2 class="my-4 text-light text-center">Contact Us</h2>
                
                <?php if(isset($_SESSION['errormessage'])): ?>
                    <div class="alert alert-danger"><?php echo $_SESSION['errormessage']; unset($_SESSION['errormessage']); ?></div>
                <?php endif; ?>
                <?php if(isset($_SESSION['successmessage'])): ?>
                    <div class="alert alert-success"><?php echo $_SESSION['successmessage']; unset($_SESSION['successmessage']); ?></div>
                <?php endif; ?>

                <form action="/proyectorefactorizacion/public/contact/guardar" method="POST">
                    <div class="my-3 input-group">
                        <label for="cusername" class="input-group-text w-25 d-flex justify-content-center box"><span class="fa fa-user" style="color: blue;"></span></label>
                        <input type="text" id="cusername" class="form-control" name="username" placeholder="Username" required>
                    </div>
                    <div class="my-3 input-group">
                        <label for="cemail" class="input-group-text w-25 d-flex justify-content-center box"><span class="fa fa-envelope" style="color: red;"></span></label>
                        <input type="email" id="cemail" class="form-control" name="email" placeholder="Email" required>
                    </div>
                    <div class="my-3 input-group">
                        <label for="ccontact" class="input-group-text w-25 d-flex justify-content-center box"><span class="fa fa-phone" style="color: green;"></span></label>
                        <input type="text" id="ccontact" class="form-control" name="contact" placeholder="Contact" required>
                    </div>
                    <div class="my-3 input-group">
                        <label for="message" class="input-group-text w-25 d-flex justify-content-center box"><span class="fa-solid fa-message" style="color: purple;"></span></label>
                        <textarea name="message" id="message" class="form-control" cols="30" rows="3" placeholder="Type your Message Here" required></textarea>
                    </div>
                    <div class="my-3 input-group">
                        <button type="submit" name="submitmessage" class="btn btn-outline-success text-success w-100" style="background-color:#060a11;">Submit Your Message</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>