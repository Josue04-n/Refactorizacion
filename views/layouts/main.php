<?php declare(strict_types=1); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>iDiscuss Foro - Refactorizado</title>
    </head>
<body>

    <header>
        <nav>
            <ul>
                <li><a href="/proyectorefactorizacion/public/">Inicio</a></li>
                <li><a href="/proyectorefactorizacion/public/about">Acerca de</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <?php echo $content; ?>
    </main>

    <footer>
        <p>&copy; <?php echo date('Y'); ?> iDiscuss. Todos los derechos reservados.</p>
    </footer>

</body>
</html>