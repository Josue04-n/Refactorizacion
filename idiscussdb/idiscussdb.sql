-- Volcado de SQL de phpMyAdmin
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12 de Ene de 2024 a las 12:26 PM
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `idiscussdb`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categories`
--

CREATE TABLE `categories` (
  `c_id` int(250) NOT NULL,
  `c_name` varchar(250) NOT NULL,
  `c_desc` varchar(250) NOT NULL,
  `c_images` varchar(255) NOT NULL,
  `c_reg_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categories`
--

INSERT INTO `categories` (`c_id`, `c_name`, `c_desc`, `c_images`, `c_reg_date`) VALUES
(1, 'python', 'Python es un lenguaje de programación de propósito general y de alto nivel. Su filosofía de diseño enfatiza la legibilidad del código con el uso de sangría significativa. Python tiene tipado dinámico y recolección de basura.', 'card-1.jpg', '2024-01-12 14:22:34'),
(2, 'java', 'Java es un lenguaje de programación orientado a objetos, basado en clases y de alto nivel, diseñado para tener la menor cantidad posible de dependencias de implementación. Es un lenguaje de programación de propósito general.', 'card-2.jpg', '2024-01-12 14:24:10'),
(3, 'javascript', 'JavaScript, a menudo abreviado como JS, es un lenguaje de programación que es una de las tecnologías principales de la World Wide Web, junto con HTML y CSS.', 'card-3.jpg', '2024-01-12 14:25:49'),
(4, 'c++', 'C++ es un lenguaje de programación de propósito general y de alto nivel creado por el científico informático danés Bjarne Stroustrup. Lanzado por primera vez en 1985 como una extensión del lenguaje de programación C.', 'card-4.jpg', '2024-01-12 14:26:19'),
(5, 'php', 'PHP es un lenguaje de scripting de propósito general orientado al desarrollo web. Fue creado originalmente por el programador danés-canadiense Rasmus Lerdorf en 1993 y lanzado en 1995.', 'card-5.jpg', '2024-01-12 14:27:23'),
(6, 'react js', 'React es una biblioteca de JavaScript front-end de código abierto y gratuita para crear interfaces de usuario basadas en componentes. Es mantenida por Meta y una comunidad de desarrolladores individuales y empresas.', 'card-6.jpg', '2024-01-12 14:29:24'),
(7, 'otras preguntas relacionadas con programación', 'Haz cualquier tipo de pregunta relacionada con programación.', 'card-7.jpg', '2024-01-12 14:37:57');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(255) NOT NULL,
  `comment_content` text NOT NULL,
  `thread_id` int(255) NOT NULL,
  `comment_by` int(255) NOT NULL,
  `comment_on_id` int(255) NOT NULL,
  `active` int(255) NOT NULL,
  `comment_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `comments`
--

INSERT INTO `comments` (`comment_id`, `comment_content`, `thread_id`, `comment_by`, `comment_on_id`, `active`, `comment_date`) VALUES
(1, 'setup.py es un archivo de python, cuya presencia es una indicación de que el módulo/paquete que estás a punto de instalar probablemente ha sido empaquetado y distribuido con Distutils, que es el estándar para distribuir Módulos de Python.', 1, 2, 1, 1, '2024-01-12 15:34:34'),
(2, '$ pip install : - pip usará setup.py para instalar tu módulo. Evita llamar a setup.py directamente.', 1, 7, 1, 1, '2024-01-12 15:36:33'),
(3, '¿Por qué estás usando una versión RC?', 2, 1, 3, 1, '2024-01-12 15:55:57'),
(4, 'entonces, ¿cuál descargo? Soy nuevo en python, por favor ayúdenme a instalarlo.', 2, 3, 3, 0, '2024-01-12 15:56:30'),
(5, 'Este error también se manifiesta al instalar Python como una aplicación de la Tienda de Windows. Abre \'Administrar alias de ejecución de la aplicación\' en Inicio y desactiva todas las entradas de Python antes de instalar. Después de que la instalación se complete correctamente, habilita los alias apropiados para python.exe, python3.exe y posiblemente otros específicos de la versión.', 2, 4, 3, 1, '2024-01-12 15:57:48'),
(6, 'Uno de tus archivos está corrupto. Simplemente descarga Jarfix y ejecútalo.\r\n\r\nThe Breakdown tiene un sitio web fácil y útil para usar Jarfix. Simplemente sigue las instrucciones y descárgalo en el siguiente enlace:\r\n\r\nenlace - https://thebreakdown.xyz/jarfix-to-repair-jar-files-on-your-pc/', 3, 1, 4, 1, '2024-01-12 16:00:56'),
(7, 'Esto suele ocurrir debido a la ausencia de la Carpeta Package Cache en tus datos locales.\r\n\r\nVerifica el registro de python (desde tu ventana de instalación; donde ves el error), desplázate hasta el final. Después del punto de Creación del Punto de Restauración en el registro, encontrarás que no puede transferir el archivo desde el caché temporal local a esta ubicación C:\\Users&lt;>\\AppData\\local\\Package Cache.\r\nPara aislar esto, ¿verifica si la ruta existe en tu sistema o no? Si no, por favor crea la carpeta llamada Package Cache en la carpeta local.\r\n\r\nUna vez que lo hagas, notarás que la carpeta se llena con algunas descargas temporales.\r\n\r\nVuelve a instalar el paquete de python. Esta vez se instalará.\r\nTuve el mismo problema en mi organización donde usaba VDI. La carpeta no estaba presente allí y por eso, cada vez que llegaba a ese punto, fallaba.\r\n\r\nPude solucionar el problema.', 2, 5, 3, 1, '2024-01-12 16:02:48'),
(8, 'gracias de todos modos', 2, 3, 3, 0, '2024-01-12 16:06:01'),
(9, 'Esto no es muy útil. Le estás lanzando vocabulario e instrucciones que probablemente no tengan sentido para él. Le dices que vea su salida, sin embargo, lo más probable es que no sepa qué hacer a partir de ahí. ¿Buscar más errores en Google? No. La solución es ejecutar jarfix.', 3, 3, 4, 1, '2024-01-12 16:07:47'),
(10, '¿Podrías reformular tu pregunta? ¿Qué quieres decir con \"forma formateada\"? ¿Como, con formato enriquecido, como negrita/cursiva/etc.?', 4, 12, 10, 1, '2024-01-12 16:12:54'),
(11, '¿hay alguna manera de mostrar el valor en tiempo de ejecución de una variable imprimiendo el valor de la variable usando algunos comandos de consola?', 4, 10, 10, 0, '2024-01-12 16:14:17'),
(12, 'Simplemente haz console.log(\"\", tuObjeto1, tuObjeto2, tuObjeto3, etc...);. Una versión más corta es simplemente hacer console.log(tuObjeto1, tuObjeto2, etc...);', 4, 9, 10, 1, '2024-01-12 16:14:57'),
(13, '¿versión de java antigua o faltante en tu máquina? java -version?', 6, 10, 15, 1, '2024-01-12 16:20:43'),
(14, 'Java(TM) SE Runtime Environment (build 1.8.0_101-b13) Comprobando desde el navegador: Su sistema está administrado por el departamento de TI de su organización. Se detectaron las siguientes versiones de Java en su sistema. Java 8 Update 101 (static) Java 8 Update 101 (64-bit)', 6, 15, 15, 0, '2024-01-12 16:21:04'),
(15, '¿Puedes verificar si hay información de error en los registros? Deberían estar aquí &lt;DRIVE>\\Users\\&lt;nombre_usuario>\\.Pycharm&lt;versión>', 6, 8, 15, 1, '2024-01-12 16:22:10'),
(16, 'He probado pycharm.exe y nunca se ejecuta ni muestra ningún mensaje. Acabo de encontrar pycharm64.exe en la misma carpeta y funciona.', 6, 15, 15, 0, '2024-01-12 16:23:46'),
(17, 'Investigué un poco. El acceso directo que usa mi sistema apunta directamente a ese pycharm64.exe, y sin embargo el acceso directo no funciona y abrir el *.exe como dijiste sí lo hace. No conozco windows lo suficientemente bien como para depurar eso.', 6, 15, 15, 0, '2024-01-12 16:24:45'),
(18, 'Verifica si tienes Java instalado en tu windows 10.', 6, 10, 15, 1, '2024-01-12 16:25:45'),
(19, 'está funcionando gracias..', 4, 10, 10, 0, '2024-01-12 16:27:55'),
(20, 'Enfrenté un problema similar muchas veces, la ventana del lanzador se abría y luego se cerraba inmediatamente sin ningún mensaje de error. En mi caso, parece que esto sucede cuando tengo espacio en disco insuficiente. Liberar 10-15Gb me lo soluciona. Espero que ayude.', 6, 5, 15, 1, '2024-01-12 16:33:00'),
(21, '\r\n¡Sí! ¡Hay un depurador de Python llamado pdb justo para hacer eso!\r\n\r\nPuedes iniciar un programa de Python a través de pdb usando python -m pdb miscript.py.\r\n\r\nHay algunos comandos que luego puedes emitir, que están documentados en la página de pdb.\r\n\r\nAlgunos útiles para recordar son:\r\n\r\nb: establecer un punto de interrupción\r\nc: continuar la depuración hasta llegar a un punto de interrupción\r\ns: avanzar paso a paso por el código\r\nn: ir a la siguiente línea de código\r\nl: listar el código fuente del archivo actual (predeterminado: 11 líneas, incluida la línea que se está ejecutando)\r\nu: navegar hacia arriba en un marco de pila\r\nd: navegar hacia abajo en un marco de pila\r\np: imprimir el valor de una expresión en el contexto actual\r\nSi no quieres usar un depurador de línea de comandos, algunos IDEs como Pydev, Wing IDE o PyCharm tienen un depurador GUI. Wing y PyCharm son productos comerciales, pero Wing tiene una edición \"Personal\" gratuita, y PyCharm tiene una edición comunitaria gratuita.', 7, 13, 6, 1, '2024-01-12 16:37:15'),
(22, 'Vaya, no puedo creer que me esté costando encontrar un pdb gráfico para linux/ubuntu. ¿Me estoy perdiendo algo? Puede que tenga que buscar cómo hacer un plugin de SublimeText para ello.', 7, 6, 6, 0, '2024-01-12 16:38:06'),
(23, 'PyCharm es bastante bueno como depurador gráfico, ¡y su Community Edition es gratuita!', 7, 11, 6, 1, '2024-01-12 16:38:52'),
(24, '@dhruv, pudb es genial para eso. Además', 7, 5, 6, 1, '2024-01-12 16:40:36'),
(25, 'pdb no es una herramienta de línea de comandos. Para usarlo, usa python -m pdb tu_script.py.', 7, 14, 6, 1, '2024-01-12 16:41:35'),
(26, '@devil Supongo que no es estándar, pero en Ubuntu el comando pdb es parte del paquete de python. En cualquier caso, python -m &lt;módulo> se está convirtiendo en el estándar para otras cosas también como pip, así que probablemente sea mejor usar eso por defecto.', 7, 17, 6, 1, '2024-01-12 16:42:35'),
(27, 'Usando el depurador interactivo de Python \'pdb\'\r\nEl primer paso es hacer que el intérprete de Python entre en el modo de depuración.\r\n\r\nA. Desde la línea de comandos : La forma más directa, ejecutando desde la línea de comandos, el intérprete de python. \r\n\r\nLa forma más directa, ejecutando desde la línea de comandos, el intérprete de python [ $ python -m pdb nombreScript.py\r\n> .../pdb_script.py(7)&lt;module>()\r\n-> \"\"\"\r\n(Pdb) ] \r\nB. Dentro del intérprete : \r\n\r\nAl desarrollar versiones tempranas de módulos y para experimentarlo de manera más iterativa. [  $ python\r\nPython 2.7 (r27:82508, Jul  3 2010, 21:12:11)\r\n[GCC 4.0.1 (Apple Inc. build 5493)] on darwin\r\nType \"help\", \"copyright\", \"credits\" or \"license\" for more information.\r\n>>> import pdb_script\r\n>>> import pdb\r\n>>> pdb.run(\'pdb_script.MyObj(5).go()\')\r\n> &lt;string>(1)&lt;module>()\r\n(Pdb) ]\r\n\r\n', 7, 12, 6, 1, '2024-01-12 16:47:19'),
(28, '\"Apagar el indicador (Pdb)... con “c” (continuar)\" -- Eso no suena bien... La documentación dice que c es \"Continuar la ejecución, solo detenerse cuando se encuentra un punto de interrupción.', 7, 9, 6, 1, '2024-01-12 16:48:38'),
(29, 'hay un módulo llamado \'pdb\' en python. En la parte superior de tu script de python haces\r\n [ \r\nimport pdb\r\npdb.set_trace() ]\r\ny entrarás en modo de depuración. Puedes usar \'s\' para avanzar, \'n\' para seguir la siguiente línea, similar a lo que harías con el depurador \'gdb\'.', 7, 7, 6, 1, '2024-01-12 16:50:21'),
(30, 'Cuando vi punto de interrupción me emocioné. Pero luego aprendí que es esencialmente solo un atajo para import pdb; pdb.set_trace() y eso me entristeció. Desarrolladores de Python: por favor, concéntrense en mejorar PDB con características básicas de GDB como líneas de contexto, historial de comandos persistente y autocompletado con tabulador :-)', 7, 1, 6, 1, '2024-01-12 16:53:32');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `messages`
--

CREATE TABLE `messages` (
  `id` int(40) NOT NULL,
  `user_id` int(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(30) NOT NULL,
  `contact` int(20) NOT NULL,
  `message` varchar(255) NOT NULL,
  `message_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `threads`
--

CREATE TABLE `threads` (
  `threads_id` int(255) NOT NULL,
  `threads_title` varchar(100) NOT NULL,
  `threads_desc` text NOT NULL,
  `threads_cat_id` int(255) NOT NULL,
  `threads_user_id` int(255) NOT NULL,
  `threads_reg_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `threads`
--

INSERT INTO `threads` (`threads_id`, `threads_title`, `threads_desc`, `threads_cat_id`, `threads_user_id`, `threads_reg_date`) VALUES
(1, '¿Qué es setup.py?', '¿Qué es setup.py y cómo se puede configurar o usar?', 1, 1, '2024-01-12 15:16:09'),
(2, 'Error de configuración de Python fallida 0x80070005 acceso denegado', 'Al instalar python en mi sistema me aparece esto - error de configuración fallida...\r\nPor favor ayuda, ¿cómo puedo solucionar este problema?\r\n\r\nMi cuenta tiene derechos de administrador en el sistema operativo windows 10 pro de 64 bits. He descargado el instalador de python desde el siguiente enlace:', 1, 3, '2024-01-12 15:54:44'),
(3, 'Instalación de Java no completada / No se puede instalar Java', 'Descargué un archivo para un juego que requiere Java para ejecutarse. Cuando descargué el archivo se guardó como un archivo WinRAR. Así que hice clic derecho en el archivo y presioné abrir con Java Platform SE Binary (Ya que era el único complemento de Java que apareció). Luego apareció un mensaje de error que dice: \"Instalación de Java no completada.\r\nNo se puede instalar Java.\r\nHay errores en los siguientes interruptores:\r\n(\"C:\\Users\\MiNombre\\Desktop\\El nombre del archivo del Juego(2).jar\").\r\nComprueba que los comandos son válidos y vuelve a intentarlo.\"\r\nPero ya he instalado Java también.\r\n\r\n¿Alguien tiene una solución que pueda recomendar?', 2, 4, '2024-01-12 15:59:49'),
(4, '¿Cómo puedo mostrar un objeto JavaScript?', '¿Cómo muestro el contenido de un objeto JavaScript en formato de cadena como cuando hacemos un alert a una variable?\r\n\r\nDe la misma forma formateada quiero mostrar un objeto.', 3, 10, '2024-01-12 16:11:04'),
(5, 'Python- Bucle While con manejo de errores', 'He estado leyendo sobre los bucles while mientras aprendo python. Lo siguiente funciona sin error, sin embargo, si inserto 16 como valor, solo obtengo 16', 1, 16, '2024-01-12 16:18:06'),
(6, '¡PyCharm no se inicia en Windows! ¿Qué le pasa?', 'Descargué e instalé JetBrains PyCharm (Versión comunitaria) en mi Windows 10, pero no pasa nada cuando intento ejecutarlo. Intenté todo como reiniciar Windows, Ejecutar como administrador, etc. Tampoco se encuentra nada en el Administrador de tareas.', 1, 15, '2024-01-12 16:19:37'),
(7, '¿Cómo avanzar paso a paso por el código Python para ayudar a depurar problemas?', 'En Java/C# puedes avanzar fácilmente paso a paso por el código para rastrear qué podría estar saliendo mal, y los IDE hacen que este proceso sea muy fácil para el usuario.\r\n\r\n¿Se puede rastrear el código python de manera similar?', 1, 6, '2024-01-12 16:35:06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `user_email` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_image` varchar(255) NOT NULL,
  `timestamp` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `username`, `user_email`, `password`, `user_image`, `timestamp`) VALUES
(1, 'hey', 'hey@gmail.com', '$2y$10$.0V9lIcXm1Ac24s12Ws38ejOt20txWFR4BZm7M5mJrVphTRGrm6D2', 'profile-3.jpg', '2024-01-12 10:09:57'),
(2, 'vipin', 'vipin@gmail.com', '$2y$10$CAFA4Dd4DHVzPDwo4P1Lb.4iDqpSbWkUxctmQuSyLvL5fmw5zu2ZC', 'profile-5.jpg', '2024-01-12 10:15:15'),
(3, 'ensh', 'ensh@gmail.com', '$2y$10$2t4VBYIeehv6VD0T38rEneLqJwcu7.v//1gKGcpDNOxPMy/lJeQ66', 'profile-4.jpg', '2024-01-12 10:15:54'),
(4, 'abhishek', 'abhi@gmail.com', '$2y$10$E.8BmDCKYbAGRwuxBu8OduQ.SGYb8hKnZWFsTuvLydvZuyEdP4Lfq', 'profile-6.jpg', '2024-01-12 10:16:43'),
(5, 'shna', 'shna@gmail.com', '$2y$10$SyuloJ2PKjsSW3GtUWjEauxkV3OuaE6EvJM4Dbr6wF83YxeneDsaO', 'profile-7.jpg', '2024-01-12 10:17:38'),
(6, 'dhruv', 'scout@gmail.com', '$2y$10$MPCL1fwqugxOJwzNSlDDneKwJLQkfbiqheKeZNJAoT9cCaMq8MVkO', 'profile-6.jpg', '2024-01-12 10:18:46'),
(7, 'nefes', 'nefes@gmail.com', '$2y$10$8OylZ2q9nDL1AiPyVR8r5eKhCafX6yk0Qq/2HR/Q8LU1pfRzWmhgO', 'profile-7.jpg', '2024-01-12 10:19:36'),
(8, 'nilesh', 'nilesh@gmail.com', '$2y$10$lpMqxNL/wFeZQR4aWTX66u84ek2aZpXgtb6PhXloFHODbZN1xQTt6', 'profile-6.jpg', '2024-01-12 10:22:30'),
(9, 'angel', 'angel@gmail.com', '$2y$10$Ipjj2Fwb3fn1Wj/6Uv94kugnSbyyANTwqpfR1fVbYcCbylBpbcJY.', 'profile-14.jpg', '2024-01-12 10:23:25'),
(10, 'simmy', 'simmy@gmail.com', '$2y$10$NMO.VEyit/PNZK5h/1R8mezi6j/Ue0LY.Vl9KLGu9pbKOyYl34ppm', 'profile-3.jpg', '2024-01-12 10:23:54'),
(11, 'ritiksha', 'ritiksha@gmail.com', '$2y$10$e3aRE.UOZvBUdDYvZlyZLeJJmJo3iN8gbW8BAWxs2vbUa9ycmdQDq', 'profile-14.jpg', '2024-01-12 10:33:59'),
(12, 'aman', 'aman@gmail.com', '$2y$10$e0EZa9hrK9blBdnoBuZmwOyxw1GrQ4fY7SQRJQI5XYPL9UWm.tJLq', 'profile-8.jpg', '2024-01-12 10:34:41'),
(13, 'hy', 'hy@gmail.com', '$2y$10$U5/KG5VVy3Xh/fCJvEJCMemTU4IwU6dxRZwzoZOFZsFuYL3Tn48iG', 'profile-10.jpg', '2024-01-12 10:35:26'),
(14, 'devil', 'devil@gmail.com', '$2y$10$hmYk5J3MLX9L.8w8xcZRkud8gBwEvj.YvIx/.lFFLfAM2nwUWU3hi', 'profile-11.jpg', '2024-01-12 10:36:38'),
(15, 'chirag', 'chirag@gmail.com', '$2y$10$UtxEmgXUVR2Mmb/W0PeVNO8awvxYclWT7ZU6Clbb83xwslPSAFYYO', 'profile-2.jpg', '2024-01-12 10:38:01'),
(16, 'ankit', 'ankit@gmail.com', '$2y$10$id.lBP7zfxy2JtiHN7jpuut/aWLPZpE0Nhnz5DsDmH3Gka.HghPAO', 'profile-12.jpg', '2024-01-12 10:38:36'),
(17, 'nirmal', 'nirmal@gmail.com', '$2y$10$EX5PexRQdyu64hf6XsAHFeGSz6vJ1exQEhUFf8owh5NrhaSVs.7ES', 'profile-15.jpg', '2024-01-12 10:39:37');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`c_id`);

--
-- Indices de la tabla `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indices de la tabla `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `threads`
--
ALTER TABLE `threads`
  ADD PRIMARY KEY (`threads_id`);
ALTER TABLE `threads` ADD FULLTEXT KEY `threads_title` (`threads_title`,`threads_desc`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categories`
--
ALTER TABLE `categories`
  MODIFY `c_id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(40) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `threads`
--
ALTER TABLE `threads`
  MODIFY `threads_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;