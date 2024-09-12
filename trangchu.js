function showContent(item) {
    var contentId = item.toLowerCase() + "-content";
    var content = document.getElementById(contentId);
    if (content) {
        content.style.display = 'block';
    }
}

function hideContent(item) {
    var contentId = item.toLowerCase() + "-content";
    var content = document.getElementById(contentId);
    if (content) {
        content.style.display = 'none';
    }
}

document.addEventListener("DOMContentLoaded", function() {
    const header = document.querySelector("header");
    window.addEventListener("scroll", function(){
        const x = window.pageYOffset;
        if (x > 0){
            header.classList.add("sticky");
        } else {
            header.classList.remove("sticky");
        }
    });

    const imgPosition = document.querySelectorAll(".aspect-ratio-169 img");
    const imgContainer = document.querySelector('.aspect-ratio-169');
    const notItem = document.querySelectorAll(".not");

    let imgNumber = imgPosition.length;
    let index = 0;
    let shoppingWindowOpen = false;

    imgPosition.forEach(function(image, index) {
        image.style.left = index * 100 + "%";
        notItem[index].addEventListener("click", function() {
            slider(index);
        });
    });

    function imgSlide() {
        if (shoppingWindowOpen) {
            return;
        }
        index++;
        if (index >= imgNumber) {
            index = 0;
        }
        slider(index);
    }

    function slider(index) {
        imgContainer.style.left = "-" + index * 100 + "%";
        const notActive = document.querySelector('.active');
        if (notActive) {
            notActive.classList.remove("active");
        }
        if (notItem[index]) {
            notItem[index].classList.add("active");
        }
    }

    setInterval(imgSlide, 3000);

    const shoppingIcon = document.getElementById("shopping-icon");
    if (shoppingIcon) {
        shoppingIcon.addEventListener("click", function() {
            const shoppingWindow = document.querySelector(".shopping-window");
            if (shoppingWindow) {
                shoppingWindow.classList.toggle("active");
            }
        });
    }

    const shoppingWindow = document.querySelector(".shopping-window");
    if (shoppingWindow) {
        shoppingWindow.addEventListener("transitionend", function() {
            shoppingWindowOpen = shoppingWindow.classList.contains("active");
        });
    }
    const closeIcon = document.querySelector(".close-icon");
    if (closeIcon && shoppingWindow) {
        closeIcon.addEventListener("click", function() {
            shoppingWindow.classList.remove("active");
            shoppingWindowOpen = false;
        });
    }
});



