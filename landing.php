<!-- HEADER -->
<header class="header">
    <div class="header__container container">
        <div class="header__title">
            <h1 class="heading-primary">
                El objetivo perfecto entre la productividad y el bienestar
                emocional.
            </h1>
            <a href="registro.php" class="btn">ÚNETE AHORA</a>
        </div>
        <img class="header__img" src="img/landing_page/hero_girl_mindfullness<?php
  if ($bodyClass === 'theme--dark') {
    echo '--dark';
  } elseif ($bodyClass === 'theme--lemon') {
    echo '--lemon';
  } elseif ($bodyClass === 'theme--dracula') {
    echo '--dracula';
  }
?>.svg" alt="chica meditando relajada" />
    </div>
</header>
<!-- INICIO FEATURES -->
<section class="landing">
    <div class="landing__features container">
        <h2 id="funciona" class="lading__features-title heading-secondary">
            ¿Cómo funciona KEEPZEN?
        </h2>
        <div class="features">
            <div class="features__info">
                <h3 class="features__info-title heading-tertiary">
                    1. Despeja tu mente antes de dormir
                </h3>
                <!-- INFO 1 -->
                <p class="features__info-desc">
                    Seguro que alguna vez has estado más tiempo del que te gustaría
                    dándole vueltas a todas las cosas que tienes que hacer al día
                    siguiente. La mejor forma de deshacerte de ellas es <b>apuntándolas
                        antes de irte a dormir.</b> En tu
                    <?php if (isset($_SESSION['autentificado']) && $_SESSION['autentificado'] == true) : ?>
                    <a href="diario.php">agenda</a>
                    <?php else : ?>
                    <a href="diario_muestra.php">agenda</a>
                    <?php endif; ?>
                    personal podrás crear tu propia lista de tareas personalizada para cada día,
                    asegurándote de que no se te olvide nada importante. ¡Apúntalas por la noche
                    y consúltalas al día siguiente!
                </p>
            </div>
            <img class="features__img fade-in" src="img/landing_page/boy_writing<?php
  if ($bodyClass === 'theme--dark') {
    echo '--dark';
  } elseif ($bodyClass === 'theme--lemon') {
    echo '--lemon';
  } elseif ($bodyClass === 'theme--dracula') {
    echo '--dracula';
  }
?>.svg" alt="chico escribiendo en un diario" />
        </div>
        <!-- INFO 2 -->
        <div class="features features-reverse">
            <div class="features__info">
                <h3 class="features__info-title heading-tertiary">
                    2. Diario de agradecimiento
                </h3>
                <p class="features__info-desc">
                    El diario de agradecimiento es como un entrenador personal para el
                    bienestar emocional.<b>En lugar de enfocarte en lo negativo que
                        pueda haber sucedido en tu día, te alienta a buscar lo positivo y
                        escribirlo.</b> La práctica del agradecimiento ha sido estudiada y
                    demostrado que tiene beneficios cognitivos y emocionales en el
                    cerebro, como mejorar el estado de ánimo, reducir el estrés y
                    aumentar la resiliencia. En tu <b>perfil personal</b> tienes una sección para apuntar y consultar tu
                    diario
                    de agradecimiento.
                </p>
            </div>
            <img class="features__img fade-in" src="img/landing_page/thanks_features<?php
  if ($bodyClass === 'theme--dark') {
    echo '--dark';
  } elseif ($bodyClass === 'theme--lemon') {
    echo '--lemon';
  } elseif ($bodyClass === 'theme--dracula') {
    echo '--dracula';
  }
?>.svg" alt="gracias escrito en grande" />
        </div>
        <!-- INFO 3 -->
        <div class="features">
            <div class="features__info">
                <h3 class="features__info-title heading-tertiary">
                    3. Empieza el día consultando tus tareas
                </h3>
                <p class="features__info-desc">
                    Empieza tu día con el pie derecho y sin estrés, consultando tu
                    lista de tareas personalizada en tu
                    <?php if (isset($_SESSION['autentificado']) && $_SESSION['autentificado'] == true) : ?>
                    <a href="diario.php">agenda</a>
                    <?php else : ?>
                    <a href="diario_muestra.php">agenda</a>
                    <?php endif; ?>
                    . En vez de levantarte y empezar a pensar en todo lo que tienes que hacer, toma unos
                    minutos para revisar lo que ya apuntaste. Esto te ayudará a
                    priorizar y planificar mejor tu día, y a asegurarte de que no se
                    te olvide nada importante. ¡Tu
                    <?php if (isset($_SESSION['autentificado']) && $_SESSION['autentificado'] == true) : ?>
                    <a href="diario.php">agenda</a>
                    <?php else : ?>
                    <a href="diario_muestra.php">agenda</a>
                    <?php endif; ?>
                    personal te ayudará a mantener el control y la calma!
                </p>
            </div>
            <img class="features__img fade-in" src="img/landing_page/sun_features<?php
  if ($bodyClass === 'theme--dark') {
    echo '--dark';
  } elseif ($bodyClass === 'theme--lemon') {
    echo '--lemon';
  } elseif ($bodyClass === 'theme--dracula') {
    echo '--dracula';
  }
?>.svg" alt="ilustración de un sol sonriente" />
        </div>
    </div>
</section>
<!-- CALL TO ACTION -->
<section class="landing__call call">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
        <path class="call_wave" fill="var(--colorSecundarioRosa)" fill-opacity="1"
            d="M0,288L80,266.7C160,245,320,203,480,170.7C640,139,800,117,960,90.7C1120,64,1280,32,1360,16L1440,0L1440,320L1360,320C1280,320,1120,320,960,320C800,320,640,320,480,320C320,320,160,320,80,320L0,320Z">
        </path>
    </svg>

    <div class="call__fondo">
        <div class="call__container container">
            <i class="fas fa-spa"></i>
            <h2 class="call__title heading-secondary">
                Un momento de tranquilidad antes y después del día
            </h2>
            <p class="call__info">
                Si quieres empezar o acabar aún mejor el día, tómate unos minutos
                para relajar tu sistema nervioso mediante las respiraciones guiadas.
                Tu cuerpo también te lo agradecerá si liberas tensiones después de
                levantarte y antes de acostarte mediante una serie de estiramientos
                integrales.
            </p>
            <?php if (isset($_SESSION['autentificado']) && $_SESSION['autentificado'] == true) : ?>
            <a href="relajate.php" class="call-btn btn--secondary">EMPIEZA AHORA</a>
            <?php else : ?>
            <a href="registro.php" class="call-btn btn--secondary">EMPIEZA AHORA</a>
            <?php endif; ?>
        </div>
    </div>
</section>