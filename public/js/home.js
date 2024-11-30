function slideShow(className, indexValue) {
    var i;
    var x = document.getElementsByClassName(className);
    for (i = 0; i < x.length; i++) {
        x[i].style.display = "none";
        }
        indexValue++;
        if (indexValue > x.length) { indexValue = 1; }
        x[indexValue - 1].style.display = "block";
        setTimeout(() => slideShow(className, indexValue), 2500);
    }

    slideShow("image-item", 0);
    slideShow("image-item-one", 0);
    slideShow("image-item-two", 0);
    slideShow("image-item-three", 0);