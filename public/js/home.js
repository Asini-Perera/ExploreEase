const initSlider = () => {
    const slider = document.querySelectorAll(".slide-wrap .slider");
    const slideButtons = document.querySelectorAll("#slide-button");

    //slide images according to the slide button click
    slideButoons(button => {
        button.addEventListner("click", () => {
            const direction = button.id === "slide-button" ? -1 : 1;
            const scrollAmount = slider.clientWidtg * direction;
            slider.scrollBy({left: scrollAmount,behavior: "smooth"});
        });
    });
}