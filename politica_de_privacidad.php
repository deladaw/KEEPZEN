<?php
//Página para practicar ejercicios de respiración y estiramientos.
$titulo = "KeepZen - Relájate";
include("./Controller/seguridad.php");
include("./Controller/conectar_db.php");
include("nav.php");

?>

<section class="politica-privacidad container">

    <h1 class="heading-primary">Política de Privacidad</h1>

    <h2 class="heading-secondary">Información recopilada</h2>
    <p>Recopilamos la siguiente información personal cuando te registras en nuestro sitio web:</p>
    <ul>
        <li>Nombre</li>
        <li>Dirección de correo electrónico</li>
        <li>Información de pago, como tarjeta de crédito o detalles de cuenta de Stripe</li>
    </ul>

    <h2 class="heading-secondary">Uso de la información</h2>
    <p>Utilizamos la información recopilada para los siguientes fines:</p>
    <ul>
        <li>Facilitar el proceso de inicio de sesión y autenticación de los usuarios</li>
        <li>Procesar y gestionar los pagos a través de Stripe</li>
        <li>Comunicarnos contigo sobre tu cuenta, incluyendo notificaciones sobre pagos, actualizaciones y cambios en
            nuestros servicios</li>
        <li>Mejorar y personalizar la experiencia del usuario en nuestro sitio web</li>
    </ul>

    <h2 class="heading-secondary">Divulgación de la información</h2>
    <p>No compartimos tu información personal con terceros, excepto en las siguientes circunstancias:</p>
    <ul>
        <li>Cuando sea necesario para procesar los pagos a través de Stripe y cumplir con las regulaciones y estándares
            aplicables</li>
        <li>Si tenemos la obligación legal de hacerlo o si es necesario para proteger nuestros derechos legales</li>
        <li>Con tu consentimiento explícito</li>
    </ul>

    <h2 class="heading-secondary">Seguridad de la información</h2>
    <p>Tomamos medidas de seguridad para proteger tu información personal y asegurar que se utilice de acuerdo con esta
        política de privacidad. Utilizamos medidas técnicas y organizativas para proteger la información contra acceso
        no autorizado, divulgación, alteración o destrucción.</p>

    <h2 class="heading-secondary">Cookies</h2>
    <p>Utilizamos cookies en nuestro sitio web para mejorar la experiencia del usuario y recopilar información sobre el
        uso del sitio. Puedes gestionar tus preferencias de cookies a través de la configuración de tu navegador.</p>

    <h2 class="heading-secondary">Contacto</h2>
    <p>Si tienes alguna pregunta o inquietud acerca de nuestra política de privacidad, por favor contáctanos a través de
        los siguientes medios:</p>
    <ul>
        <li>Correo electrónico: keepzen@info.com</li>
    </ul>
</section>


<!-- FOOTER -->
<?php
include("footer.php");
?>