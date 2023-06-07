const accordionArrows = document.querySelectorAll('.accordion-arrow');
accordionArrows.forEach(arrow=> {
    arrow.addEventListener('click', event => {
        event.preventDefault();
        if (arrow.classList.contains('accordion-arrow_active')) {
            arrow.classList.remove('accordion-arrow_active');
        } else {
            arrow.classList.add('accordion-arrow_active');
        }
    });
})
