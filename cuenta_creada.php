<?php
$titulo = "KeepZen - Diario";
include("./Controller/seguridad.php");
include("./Controller/seguridad_admin.php");
include("nav.php");

verificar_permisos_sesion();
?>

<!-- CUENTA CREADA -->
<section class="created container">
    <i class="fas fa-check-circle"></i>
    <h2 class="heading-secondary">¡Cuenta creada!</h2>
    <p class="sub-heading">
        Puedes empezar desde ya a escribir tus notas, tu diario de
        agradecimiento o bien realizar algunos ejercicios de relajación. ¡No
        tiene un orden establecido!<strong>
            Pero si prefieres seguir un orden, te recomendamos probar con esta
            rutina:</strong>
    </p>
    <ol>
        <li>
            Antes de irte a dormir, o durante el día conforme te acuerdes, apunta
            todas las <b>cosas que tengas que hacer para el día siguiente.</b>
        </li>
        <li>
            Escribe al menos <b>alguna cosa por la que te sientas agradecido/a</b>
            durante el día, puede ser cualquier cosa, lo importante es que lo
            sientas de verdad.
        </li>
        <li>
            Realiza 5 minutos de <b>respiraciones</b> y después <b>estira</b> todo
            el cuerpo.
        </li>
        <li>
            Al día siguiente por la mañana, puedes ir
            <b>consultando las cosas que has apuntado</b> y tachándolas de la
            lista. Es recomendable que al levantarte realices las respiraciones y
            los estiramientos para empezar el día con mejor ánimo.
        </li>
    </ol>
    <div class="btn-container">
        <a class="btn" href="diario.php">DIARIO</a>
        <a class="btn--secondary" href="relajate.php">RELÁJATE</a>
    </div>
</section>

<!-- FOOTER -->
<?php
include("footer.php");
?>