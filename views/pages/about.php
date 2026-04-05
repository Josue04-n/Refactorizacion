<?php declare(strict_types=1); ?>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="p-5 mb-4 bg-light rounded-3 shadow-sm border">
                <div class="container-fluid py-2 text-center">
                    <h1 class="display-5 fw-bold text-success mb-4">
                        <?php echo htmlspecialchars($titulo ?? 'Acerca de Nosotros'); ?>
                    </h1>
                    <p class="fs-5 text-muted mb-4">
                        Bienvenido a <strong>iDiscuss</strong>, tu plataforma de foros de discusión. 
                        Este proyecto nació con la idea de crear un espacio seguro y organizado donde desarrolladores, estudiantes y curiosos puedan compartir conocimientos, resolver dudas y crecer en comunidad.
                    </p>
                    <p class="fs-6 text-secondary">
                        <em>"El conocimiento crece cuando se comparte."</em>
                    </p>
                    
                    <hr class="my-4">
                    
                    <h4 class="fw-bold mt-4">Nuestra Arquitectura</h4>
                    <p class="text-start mt-3">
                        Este foro ha sido completamente refactorizado utilizando <strong>Clean Architecture</strong>, principios <strong>SOLID</strong> y el patrón <strong>MVC</strong>, garantizando un código escalable, mantenible y seguro, separando la lógica de negocio de la infraestructura y la presentación.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>