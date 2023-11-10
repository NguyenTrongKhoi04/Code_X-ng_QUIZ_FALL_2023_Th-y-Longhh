const input = document.getElementById("quantity");
const increaseButton = document.getElementById("increase");
const decreaseButton = document.getElementById("decrease");

increaseButton.addEventListener("click", function () {
    const currentValue = parseInt(input.value);
    if (currentValue < 10) {
        input.value = currentValue + 1;
    }
});

decreaseButton.addEventListener("click", function () {
    const currentValue = parseInt(input.value);
    if (currentValue > 0) {
        input.value = currentValue - 1;
    }
});



/**
 * Xử lý hiển thị số khi nhấn tăng giảm
 * 
 */
document.addEventListener("DOMContentLoaded", function() {
    const contents = document.querySelectorAll(".content");
    let currentIndex = 0;
    const totalContents = contents.length;
    const positionDisplay = document.querySelector(".position-display");

    function showContent(index) {
        contents.forEach((content, i) => {
            if (i === index) {
                content.style.display = "flex";
            } else {
                content.style.display = "none";
            }
        });
    }

    function updatePosition() {
        positionDisplay.textContent = (currentIndex + 1) + "/" + totalContents;
    }

    const buttonTang = document.querySelector("button[name='tang']");
    buttonTang.addEventListener("click", function() {
        currentIndex = (currentIndex + 1) % totalContents;
        showContent(currentIndex);
        updatePosition();
    });

    const buttonGiam = document.querySelector("button[name='giam']");
    buttonGiam.addEventListener("click", function() {
        currentIndex = (currentIndex - 1 + totalContents) % totalContents;
        showContent(currentIndex);
        updatePosition();
    });

    // Hiển thị phần tử đầu tiên ban đầu
    showContent(currentIndex);
    updatePosition();
});