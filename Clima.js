document.querySelectorAll("[data-capa]").forEach(btn => {
    btn.addEventListener("click", () => {
        cambiarCapa(btn.dataset.capa);
    });
});

function cambiarCapa(capa) {
    const iframe = document.getElementById("windyMap");

    let product = "ecmwf";
    if (capa === "rain") {
        product = "radar";
    }

    iframe.src =
        `https://embed.windy.com/embed2.html` +
        `?lat=${LAT}` +
        `&lon=${LON}` +
        `&zoom=8` +
        `&overlay=${capa}` +
        `&product=${product}` +
        `&menu=false` +
        `&message=false`;
}

function showCard(index) {
    const cards = document.querySelectorAll('.clima-card');
    const tabs = document.querySelectorAll('.tabs button');

    cards.forEach(card => card.classList.remove('active'));
    tabs.forEach(tab => tab.classList.remove('active'));

    cards[index].classList.add('active');
    tabs[index].classList.add('active');
}

function changeLayer(type, btn) {

    let overlay = "wind";
    let product = "ecmwf";
    let extraParams = "";

    switch (type) {
        case "satellite":
            overlay = "satellite";
            product = "ecmwf";
            break;

        case "temp":
            overlay = "temp";
            product = "ecmwf";
            break;

        case "wind":
            overlay = "wind";
            product = "ecmwf";
            break;

        case "radar":
            overlay = "radar";
            product = "radar";
            extraParams = "&calendar=&pressure="; // ❗ SIN animación
            break;
    }

    const url =
        `https://embed.windy.com/embed2.html` +
        `?lat=18.641&lon=-91.828` +
        `&detailLat=18.641&detailLon=-91.828` +
        `&zoom=9` +
        `&level=surface` +
        `&overlay=${overlay}` +
        `&product=${product}` +
        `&menu=false&message=false&marker=true` +
        `&type=map&location=coordinates` +
        `&metricWind=km/h&metricTemp=°C` +
        extraParams;

    document.getElementById("windyMap").src = url;

    // Botón activo (sin error event)
    document.querySelectorAll('.map-controls button')
        .forEach(b => b.classList.remove('active'));

    btn.classList.add('active');
}

