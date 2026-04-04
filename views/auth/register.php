<?php declare(strict_types=1); ?>
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-danger text-white text-center py-3">
                    <h3 class="mb-0">Crear una Cuenta</h3>
                </div>
                <div class="card-body p-4">
                    <?php if (isset($data['error'])): ?>
                        <div class="alert alert-danger">
                            <?= htmlspecialchars($data['error']) ?>
                        </div>
                    <?php endif; ?>

                    <form action="/register" method="POST">
                        <div class="mb-3">
                            <label for="username" class="form-label">Nombre de Usuario</label>
                            <input type="text" class="form-control" id="username" name="username" placeholder="Tu Nombre" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Correo Electrónico</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="usuario@gmail.com" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" id="password" name="password" minlength="4" required>
                        </div>
                        <div class="mb-4">
                            <label for="cpassword" class="form-label">Confirmar Contraseña</label>
                            <input type="password" class="form-control" id="cpassword" name="cpassword" minlength="4" required>
                            <div class="form-text text-muted">Asegúrate de que tus contraseñas coincidan.</div>
                        </div>
                        <button type="submit" class="btn btn-danger w-100 fw-bold">Registrarse</button>
                    </form>
                </div>
                <div class="card-footer text-center bg-white py-3 border-0">
                    <p class="mb-0">¿Ya tienes cuenta? <a href="/login" class="text-danger text-decoration-none fw-bold">Inicia Sesión</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
