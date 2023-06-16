<?php
//Página para comprar los temas disponibles, se puede pagar con Stripe o con un código de descuento canjeable.
//El pago se administra mediante el "checkout" de Stripe. Lo maneja por detrás el propio Stripe con el JS adjuntado
//Y el composer/Stripe instalados.
$titulo = "KeepZen - Activar Tema";
include("./Controller/seguridad.php");
include("./Controller/seguridad_admin.php");
include("./Controller/conectar_db.php");
include("./Controller/canjear_cupon.php");
require_once('config.php');
include("nav.php");

verificar_permisos();

if (verificar_compra_temas($_SESSION['id_usuario'])) {
    header("Location: temas.php");
    exit;
}

?>

<div class="theme-purchase container">
    <h1 class="heading-primary">¡Desbloquea temas extra!</h1>
    <p class="sub-heading subtitulo">Dale un toque distinto a la web con estos 3 temas adicionales.<br> Por <b>1,99€</b>
        te
        puedes llevar este pack de temas:</p>

    <div class="theme__images">
        <div class="theme__images__container">
            <h4 class="heading-quaternary">Dark Choco</h4>
            <img class="theme__images__img" src="img/temas/theme_dark-choco.png"
                alt="imagen de muestra del tema dark-choco">
        </div>
        <div class="theme__images__container">
            <h4 class="heading-quaternary">Lemon Pie</h4>
            <img class="theme__images__img" src="img/temas/theme_lemon.png" alt="imagen de muestra del tema lemon">

        </div>
        <div class="theme__images__container">
            <h4 class="heading-quaternary">Dracula</h4>
            <img class="theme__images__img" src="img/temas/theme_dracula.png" alt="imagen de muestra del tema dracula">

        </div>
    </div>
    <div class="payment-container">
        <div class="payment-discount">

            <p class="sub-heading">¿Tienes un cupón de descuento?</p>
            <p class="error-msg"><?php if(isset($err_cupon)){echo $err_cupon; }?></p>
            <form action="" method="POST">
                <input type="text" name="cupon" placeholder="Introduce el código de descuento">
                <button class="btn" name="canjear" type="submit">CANJEAR</button>
            </form>
        </div>
        <div class="stripe">
            <p class="sub-heading"><i class="fas fa-lock"></i> Pago seguro con STRIPE: </p>
            <img src="img/temas/Stripe-credit-cards-pay.png" alt="tarjetas compatibles con Stripe">
            <form action="charge.php" method="POST">
                <script src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                    data-key="<?php echo $stripe['publishable_key']; ?>" data-amount="199"
                    data-name="THEME PACK - 1,99€" data-description="keepzen.es" data-image=""
                    data-label="PAGAR CON TARJETA" data-locale="es" data-zip-code="true" data-currency="eur" />
            </form>
        </div>
    </div>
</div>

<?php
include("footer.php");
?>