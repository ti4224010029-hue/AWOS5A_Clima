<?php
/* =========================================================
   PHP ORIGINAL
   Fuente del PRONÓSTICO: JSON (7Timer)
   ========================================================= */

$ciudad = "Ciudad del Carmen, Campeche";
$apiUrl = "http://www.7timer.info/bin/api.pl?lon=91.413&lat=18.453&product=civil&output=json";

$response = file_get_contents($apiUrl);
$data = json_decode($response, true);
$clima = $data['dataseries'][0];

/* =========================================================
   ÚNICO CAMBIO
   Interpretación visual del clima (iconos Bootstrap)
   ========================================================= */
function weatherIcon($weather) {
    $weather = strtolower($weather);

    if (strpos($weather, 'clear') !== false) return 'bi-sun-fill text-sun';
    if (strpos($weather, 'cloud') !== false) return 'bi-cloud-fill text-cloud';
    if (strpos($weather, 'rain') !== false) return 'bi-cloud-rain-fill text-rain';
    if (strpos($weather, 'snow') !== false) return 'bi-snow text-snow';
    if (strpos($weather, 'ts') !== false) return 'bi-cloud-lightning-rain-fill text-storm';
    if (strpos($weather, 'fog') !== false) return 'bi-cloud-fog-fill text-fog';

    return 'bi-cloud text-default';
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>RADARPRO | Sistema Meteorológico</title>

    <!-- Bootstrap Icons -->
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- CSS ORIGINAL -->
    <link rel="stylesheet" href="Clima.css">
</head>
<body>

<header class="top-bar">
    <div class="logo">
       <i class="fas fa-satellite radar-icon"></i>
        <strong>RADARPRO</strong>
        <span>Sistema Meteorológico en Tiempo Real</span>
    </div>
    <div class="update">Actualizando cada 15 min</div>
</header>

<section class="container">

    <!-- =====================================================
         PRONÓSTICO EXTENDIDO
         Datos DIRECTOS del JSON (7Timer)
         ===================================================== -->
    <aside class="forecast">
        <h2>Pronóstico Extendido</h2>

        <div class="clima-card active">
        <p><strong>Ciudad:</strong> <?= $ciudad ?></p>

        <div class="temp"><?= $clima['temp2m'] ?>°C</div>

        <div class="weather-status">
            <i class="bi <?= weatherIcon($clima['weather']) ?>"></i>
            <span><?= ucfirst($clima['weather']) ?></span>
        </div>

        <hr>

        <p>
            <i class="bi bi-wind"></i>
            Viento: <?= $clima['wind10m']['direction'] ?>
            a <?= $clima['wind10m']['speed'] ?> km/h
        </p>

        <p>
            <i class="bi bi-cloud"></i>
            Nivel de nublado: <?= $clima['cloudcover'] ?>
        </p>

        <p>
            <i class="bi bi-droplet"></i>
            Humedad: <?= $clima['rh2m'] ?>%
        </p>

        <p>
            <i class="bi bi-cloud-drizzle"></i>
            Precipitación: <?= $clima['prec_type'] ?>
        </p>
    </div>

    </aside>

    <!-- =====================================================
         MAPA METEOROLÓGICO
         Fuente: Windy (SIN CAMBIOS)
         ===================================================== -->
    <main class="radar">
        <h2>Radar Meteorológico</h2>
        <div class="map-controls">
    <button onclick="changeLayer('satellite', this)">🛰 Satélite</button>
    <button onclick="changeLayer('temp', this)">
        <i class="bi bi-thermometer-high"></i> Temperatura
    </button>
    <button onclick="changeLayer('radar', this)">
        <i class="bi bi-radar"></i> Radar
    </button>
    <button onclick="changeLayer('wind', this)" class="active">
        <i class="bi bi-wind"></i> Viento
    </button>
</div>      

        <div class="map-container">
            <iframe
                id="windyMap"
                src="https://embed.windy.com/embed2.html?lat=18.641&lon=-91.828&detailLat=18.641&detailLon=-91.828&zoom=9&level=surface&overlay=wind&product=ecmwf&menu=false&message=false&marker=true&calendar=now&pressure=false&type=map&location=coordinates&metricWind=km/h&metricTemp=°C"
                frameborder="0">
            </iframe>
        </div>
    </main>

</section>

<!-- BOTONES FLOTANTES -->
<div class="floating-buttons">
    <a href="https://wa.me/5219999999999" target="_blank" class="float-btn whatsapp" aria-label="WhatsApp">
        <i class="bi bi-whatsapp"></i>
    </a>
    <a href="mailto:tucorreo@gmail.com" class="float-btn gmail" aria-label="Gmail">
        <i class="bi bi-envelope-at-fill"></i>
    </a>
</div>

<footer>
    <p>Servicio del Clima | Alexander Pérez Domínguez</p>
    <p>Fuentes: JSON 7Timer • Windy</p>
</footer>

<script src="Clima.js"></script>
</body>
</html>