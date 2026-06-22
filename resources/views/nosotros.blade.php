<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sobre Nosotros - Compured Perú</title>
    <style>
        /* Variables y Reset */
        :root {
            --primary: #0b33a2;
            --secondary: #27a1eb;
            --text-dark: #333;
            --text-light: #666;
            --bg-light: #f4f6f9;
            --border-color: #eaeaea;
        }
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; }
        body { background-color: #ffffff; color: var(--text-dark); line-height: 1.7; }

        /* Top Bar */
        .top-bar {
            background-color: var(--secondary);
            color: white;
            padding: 8px 5%;
            text-align: right;
            font-size: 14px;
        }
        .top-bar a { color: white; text-decoration: none; margin-left: 15px; transition: opacity 0.3s; }
        .top-bar a:hover { opacity: 0.8; }

        /* Header Principal */
        .main-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 20px 5%;
            background: white;
            border-bottom: 1px solid var(--border-color);
            flex-wrap: wrap;
            gap: 20px;
        }

        /* Logo */
        .logo {
            display: flex;
            align-items: center;
            text-decoration: none;
        }
        .logo h1 {
            color: var(--primary);
            font-size: 28px;
            font-weight: 800;
            font-style: italic;
            letter-spacing: -0.5px;
            margin: 0;
        }
        .logo h1 span { color: var(--secondary); }
        .logo p {
            font-size: 11px;
            color: var(--text-light);
            margin-top: -5px;
            text-align: right;
        }

        /* Barra de Búsqueda */
        .search-wrapper {
            display: flex;
            flex: 1;
            max-width: 600px;
            border: 1px solid #ccc;
            border-radius: 4px;
            overflow: hidden;
            height: 42px;
        }
        .search-wrapper select {
            padding: 0 15px;
            border: none;
            border-right: 1px solid #ccc;
            background: #fafafa;
            color: var(--text-dark);
            outline: none;
            cursor: pointer;
        }
        .search-wrapper input {
            flex: 1;
            padding: 0 15px;
            border: none;
            outline: none;
            font-size: 14px;
        }
        .search-wrapper button {
            width: 50px;
            background: var(--secondary);
            border: none;
            cursor: pointer;
            transition: background 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .search-wrapper button:hover { background: var(--primary); }
        .search-wrapper button svg { width: 18px; fill: white; }

        /* Iconos de cabecera */
        .header-icons {
            display: flex;
            gap: 25px;
            align-items: center;
        }
        .icon-box {
            position: relative;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .icon-box svg {
            width: 26px;
            height: 26px;
            fill: none;
            stroke: var(--text-dark);
            stroke-width: 1.5;
            transition: stroke 0.3s;
        }
        .icon-box:hover svg { stroke: var(--secondary); }
        .badge {
            position: absolute;
            top: -8px;
            right: -10px;
            background: var(--secondary);
            color: white;
            font-size: 11px;
            font-weight: bold;
            width: 18px;
            height: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
        }

        /* Breadcrumb */
        .breadcrumb {
            background-color: var(--bg-light);
            padding: 15px 5%;
            font-size: 14px;
            color: var(--text-light);
        }
        .breadcrumb a {
            color: var(--text-dark);
            text-decoration: none;
            font-weight: 500;
        }
        .breadcrumb a:hover { color: var(--secondary); }
        .breadcrumb span { margin: 0 8px; color: #aaa; }

        /* Contenido Principal */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 50px 5%;
        }
        .page-title {
            color: var(--primary);
            font-size: 38px;
            font-weight: 600;
            margin-bottom: 40px;
        }

        .content-section h2 {
            font-size: 18px;
            color: var(--text-dark);
            text-transform: uppercase;
            font-weight: 700;
            margin-top: 35px;
            margin-bottom: 15px;
        }
        .content-section p {
            color: #444;
            font-size: 15px;
            margin-bottom: 18px;
            text-align: justify;
        }
        .content-section p strong {
            color: var(--text-dark);
        }

        /* Responsive */
        @media (max-width: 850px) {
            .search-wrapper { order: 3; max-width: 100%; width: 100%; margin-top: 10px; }
        }
    </style>
</head>
<body>

    <div class="top-bar">
        <a href="#">Registrarse</a> |
        <a href="#">Entrar</a>
    </div>

    <header class="main-header">
        <a href="{{ url('/') }}" class="logo">
            <div>
                <h1>Compured<span>Perú</span></h1>
                <p>Tecnología Informática a tu Alcance</p>
            </div>
        </a>

        <div class="search-wrapper">
            <select>
                <option value="all">Categorías</option>
            </select>
            <input type="text" placeholder="Buscar producto">
            <button type="submit" aria-label="Buscar">
                <svg viewBox="0 0 24 24"><path d="M15.5 14h-.79l-.28-.27A6.471 6.471 0 0 0 16 9.5 6.5 6.5 0 1 0 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/></svg>
            </button>
        </div>

        <div class="header-icons">
            <div class="icon-box">
                <svg viewBox="0 0 24 24"><path d="M7 18c-1.1 0-1.99.9-1.99 2S5.9 22 7 22s2-.9 2-2-.9-2-2-2zM1 2v2h2l3.6 7.59-1.35 2.45c-.16.28-.25.61-.25.96 0 1.1.9 2 2 2h12v-2H7.42c-.14 0-.25-.11-.25-.25l.03-.12.9-1.63h7.45c.75 0 1.41-.41 1.75-1.03l3.58-6.49A1.003 1.003 0 0 0 20 4H5.21l-.94-2H1zm16 16c-1.1 0-1.99.9-1.99 2s.89 2 1.99 2 2-.9 2-2-.9-2-2-2z"/></svg>
                <span class="badge">0</span>
            </div>
            <div class="icon-box">
                <svg viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
                <span class="badge">0</span>
            </div>
            <div class="icon-box">
                <svg viewBox="0 0 24 24"><path d="M12 4V1L8 5l4 4V6c3.31 0 6 2.69 6 6 0 1.01-.25 1.97-.7 2.8l1.46 1.46A7.93 7.93 0 0 0 20 12c0-4.42-3.58-8-8-8zm0 14c-3.31 0-6-2.69-6-6 0-1.01.25-1.97.7-2.8L5.24 7.74A7.93 7.93 0 0 0 4 12c0 4.42 3.58 8 8 8v3l4-4-4-4v3z"/></svg>
                <span class="badge">0</span>
            </div>
        </div>
    </header>

    <nav class="breadcrumb">
        <a href="{{ url('/') }}">Home</a> <span>»</span> Sobre nosotros
    </nav>

    <main class="container">
        <h1 class="page-title">Sobre nosotros</h1>

        <div class="content-section">
            <h2>POLÍTICA DE PRIVACIDAD</h2>
            <p>El presente Política de Privacidad establece los términos en que https://sistemasguerrero.net/ usa y protege la información que es proporcionada por sus usuarios al momento de utilizar su sitio web. Esta compañía está comprometida con la seguridad de los datos de sus usuarios. Cuando le pedimos llenar los campos de información personal con la cual usted pueda ser identificado, lo hacemos asegurando que sólo se empleará de acuerdo con los términos de este documento. Sin embargo esta Política de Privacidad puede cambiar con el tiempo o ser actualizada por lo que le recomendamos y enfatizamos revisar continuamente esta página para asegurarse que está de acuerdo con dichos cambios.</p>

            <h2>Información que es recogida</h2>
            <p>Nuestro sitio web podrá recoger información personal por ejemplo: Nombre, información de contacto como su dirección de correo electrónica e información demográfica. Así mismo cuando sea necesario podrá ser requerida información específica para procesar algún pedido o realizar una entrega o facturación.</p>

            <h2>Uso de la información recogida</h2>
            <p>Nuestro sitio web emplea la información con el fin de proporcionar el mejor servicio posible, particularmente para mantener un registro de usuarios, de pedidos en caso que aplique, y mejorar nuestros productos y servicios. Es posible que sean enviados correos electrónicos periódicamente a través de nuestro sitio con ofertas especiales, nuevos productos y otra información publicitaria que consideremos relevante para usted o que pueda brindarle algún beneficio, estos correos electrónicos serán enviados a la dirección que usted proporcione y podrán ser cancelados en cualquier momento.</p>
            <p>https://sistemasguerrero.net/ está altamente comprometido para cumplir con el compromiso de mantener su información segura. Usamos los sistemas más avanzados y los actualizamos constantemente para asegurarnos que no exista ningún acceso no autorizado.</p>

            <h2>Cookies</h2>
            <p>Una cookie se refiere a un fichero que es enviado con la finalidad de solicitar permiso para almacenarse en su ordenador, al aceptar dicho fichero se crea y la cookie sirve entonces para tener información respecto al tráfico web, y también facilita las futuras visitas a una web recurrente. Otra función que tienen las cookies es que con ellas las web pueden reconocerte individualmente y por tanto brindarte el mejor servicio personalizado de su web.</p>
            <p>Nuestro sitio web emplea las cookies para poder identificar las páginas que son visitadas y su frecuencia. Esta información es empleada únicamente para análisis estadístico y después la información se elimina de forma permanente. Usted puede eliminar las cookies en cualquier momento desde su ordenador. Sin embargo las cookies ayudan a proporcionar un mejor servicio de los sitios web, estás no dan acceso a información de su ordenador ni de usted, a menos de que usted así lo quiera y la proporcione directamente noticias. Usted puede aceptar o negar el uso de cookies, sin embargo la mayoría de navegadores aceptan cookies automáticamente pues sirve para tener un mejor servicio web. También usted puede cambiar la configuración de su ordenador para declinar las cookies. Si se declinan es posible que no pueda utilizar algunos de nuestros servicios.</p>

            <h2>Enlaces a Terceros</h2>
            <p>Este sitio web pudiera contener enlaces a otros sitios que pudieran ser de su interés. Una vez que usted de clic en estos enlaces y abandone nuestra página, ya no tenemos control sobre al sitio al que es redirigido y por lo tanto no somos responsables de los términos o privacidad ni de la protección de sus datos en esos otros sitios terceros. Dichos sitios están sujetos a sus propias políticas de privacidad por lo cual es recomendable que los consulte para confirmar que usted está de acuerdo con estas.</p>

            <h2>Control de su información personal</h2>
            <p>En cualquier momento usted puede restringir la recopilación o el uso de la información personal que es proporcionada a nuestro sitio web. Cada vez que se le solicite rellenar un formulario, como el de alta de usuario, puede marcar o desmarcar la opción de recibir información por correo electrónico. En caso de que haya marcado la opción de recibir nuestro boletín o publicidad usted puede cancelarla en cualquier momento.</p>
            <p>Esta compañía no venderá, cederá ni distribuirá la información personal que es recopilada sin su consentimiento, salvo que sea requerido por un juez con un orden judicial.</p>
        </div>
    </main>

</body>
</html>
