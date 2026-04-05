<?php declare(strict_types=1); ?>

<div class="container-fluid p-0 contact-page" id="maincontainer">
    <div class="container">
        <div class="row">
            <div class="col-md-5 mx-auto">
                <h2 class="my-4 text-light">Contact Us</h2>
                
                <form action="/proyectorefactorizacion/public/contact/guardar" method="POST">
                    <input type="hidden" name="user_id" value="<?php echo htmlspecialchars((string)($uid ?? '')); ?>">
                    
                    <div class="my-3 input-group">
                        <label for="cusername" class="input-group-text w-25 d-flex justify-content-center box">
                            <span class="fa fa-user" style="color: blue;"></span>
                        </label>
                        <input type="text" id="cusername" class="form-control" name="username" placeholder="Username" value="<?php echo htmlspecialchars($uusername ?? ''); ?>" required>
                    </div>
                    
                    <div class="my-3 input-group">
                        <label for="cemail" class="input-group-text w-25 d-flex justify-content-center box">
                            <span class="fa fa-asl-interpreting" style="color: red;"></span>
                        </label>
                        <input type="email" id="cemail" class="form-control" name="email" placeholder="Email" value="<?php echo htmlspecialchars($uemail ?? ''); ?>" required>
                    </div>
                    
                    <div class="my-3 input-group">
                        <label for="ccontact" class="input-group-text w-25 d-flex justify-content-center box">
                            <span class="fa fa-phone" style="color: green;"></span>
                        </label>
                        <input type="text" id="ccontact" class="form-control" name="contact" placeholder="Contact" required>
                    </div>
                    
                    <div class="my-3 input-group">
                        <label for="message" class="input-group-text w-25 d-flex justify-content-center box">
                            <span class="fa-solid fa-message" style="color: purple;"></span>
                        </label>
                        <textarea name="message" id="message" class="form-control" cols="30" rows="3" placeholder="Type your Message Here" required></textarea>
                    </div>
                    
                    <div class="my-3 input-group">
                        <button type="submit" name="submitmessage" class="btn btn-sm btn-outline-success text-success" style="background-color:#060a11;">
                            Submit Your Message
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>