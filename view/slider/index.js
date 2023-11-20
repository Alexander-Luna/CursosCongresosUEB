let data = '';

function sliders() {
    console.log('entraa');
    $.post("../../controller/evento.php?op=slider", function (responseData) {
        let eventos = JSON.parse(responseData);
        if (eventos.length > 0) {
            data = eventos.map(function (evento) {
                return {
                    src: evento.src,
                    alt: evento.alt
                };
            });
            console.log(data);
            checkImagesLoaded();
        }
    });
    setTimeout(addCardsToContainer, 500); // Puedes ajustar el tiempo según tus necesidades
}

function createSlideElement(item, index) {
    const imgElement = new Image();
    imgElement.src = item.src;
    imgElement.alt = item.alt;
    imgElement.classList.add("slide");
    imgElement.style.width = "1000px";
    imgElement.style.height = "600px";
    imgElement.classList.toggle("slide-hidden", index !== 0);

    imgElement.onload = () => {
        slidesContainer.appendChild(imgElement);

        const indicator = document.createElement("button");
        indicator.className = index === 0 ? "indicator" : "indicator indicator-inactive";
        indicator.onclick = () => setSlide(index);
        indicatorsContainer.appendChild(indicator);
    };
}

let slidesContainer;
let indicatorsContainer;
let slide = 0;
let autoSlideInterval = null;

function checkImagesLoaded() {
    slidesContainer = document.getElementById('slides');
    indicatorsContainer = document.getElementById('indicators');

    data.forEach((item, index) => {
        createSlideElement(item, index);
    });

    startAutoSlide();
}

function nextSlide() {
    slide = (slide + 1) % data.length;
    updateSlides();
}

function prevSlide() {
    slide = (slide - 1 + data.length) % data.length;
    updateSlides();
}

function setSlide(index) {
    slide = index;
    updateSlides();
}

function startAutoSlide() {
    autoSlideInterval = setInterval(nextSlide, 8000);
}

function stopAutoSlide() {
    clearInterval(autoSlideInterval);
}

function updateSlides() {
    const slides = document.querySelectorAll('.slide');
    const indicators = document.querySelectorAll('.indicator');

    slides.forEach((slideElement, index) => {
        slideElement.classList.toggle('slide-hidden', index !== slide);
    });

    indicators.forEach((indicator, index) => {
        indicator.classList.toggle('indicator-inactive', index !== slide);
    });
}
function addCardsToContainer() {
    const cardsContainer = $('#cards');

    data.slice(0, 2).forEach(function (evento) {
        const card = `
            <div class="card">
                <div class="icon">
                    <img class="img" src="${evento.src}" alt="${evento.alt}" />
                </div>
                <strong>${evento.alt}</strong>
                <div class="card__body">
                    Regístrate y adquiere todo el conocimiento.
                </div>
                <span>
                    <a href="../login">Registrarse</a>
                </span>
            </div>
        `;

        cardsContainer.append(card);
    });
}

// Llamamos a sliders y después agregamos las tarjetas al contenedor
sliders();
