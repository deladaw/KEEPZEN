<?php
$colorSecundario = '#ffc6c7'; // Color secundario definido por la variable

// Reemplaza el valor del atributo fill con la variable
$svgCode = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                <path fill="' . $colorSecundario . '" fill-opacity="1"
                    d="M0,288L80,266.7C160,245,320,203,480,170.7C640,139,800,117,960,90.7C1120,64,1280,32,1360,16L1440,0L1440,320L1360,320C1280,320,1120,320,960,320C800,320,640,320,480,320C320,320,160,320,80,320L0,320Z">
                </path>
            </svg>';

// Envía el código SVG al navegador
header('Content-type: image/svg+xml');
echo $svgCode;
?>