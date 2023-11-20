//Carusel

function sliders() {
    $.post("../../controller/evento.php?op=slider", function (data) {
        let eventos = JSON.parse(data);
        if (eventos.length > 0) {
            let sliderData = eventos.map(function (evento) {
                return {
                    src: evento.src,
                    alt: evento.alt
                };
            });
            const data = sliderData;
            console.log(data);
        }
    });
}
sliders();

let slide = 0;
let autoSlideInterval = null;

function checkImagesLoaded() {
    const slidesContainer = document.getElementById('slides');
    const indicatorsContainer = document.getElementById('indicators');

    data.forEach((item, index) => {
        const imgElement = new Image();
        imgElement.src = item.src;
        imgElement.alt = item.alt;
        imgElement.classList.add("slide");
        imgElement.style.width = "1000px";
        imgElement.style.height = "600px";
        if (index !== 0) {
            imgElement.classList.add("slide-hidden");
        }

        imgElement.onload = () => {
            slidesContainer.appendChild(imgElement);

            const indicator = document.createElement("button");
            indicator.className = index === 0 ? "indicator" : "indicator indicator-inactive";
            indicator.onclick = () => setSlide(index);
            indicatorsContainer.appendChild(indicator);
        };
    });

    startAutoSlide();
}

function nextSlide() {
    slide = (slide === data.length - 1) ? 0 : slide + 1;
    updateSlides();
}

function prevSlide() {
    slide = (slide === 0) ? data.length - 1 : slide - 1;
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
        if (index === slide) {
            slideElement.classList.remove('slide-hidden');
        } else {
            slideElement.classList.add('slide-hidden');
        }
    });

    indicators.forEach((indicator, index) => {
        if (index === slide) {
            indicator.classList.remove('indicator-inactive');
        } else {
            indicator.classList.add('indicator-inactive');
        }
    });
}

checkImagesLoaded();

