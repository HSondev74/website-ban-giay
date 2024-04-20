const listImage = document.querySelector(".list-image");
const imgs = document.querySelectorAll(".list-image img");
const btnLeft = document.querySelector(".btn-left");
const btnRight = document.querySelector(".btn-right");
const indexItems = document.querySelectorAll(".index-item");
let current = 0;
let handleEventChangeSlide;

const handleChangeSlide = () => {
     if (current === imgs.length - 1) {
          current = 0;
     } else {
          current++;
     }
     updateSlide();
};

const updateSlide = () => {
     let width = imgs[0].offsetWidth;
     listImage.style.transform = `translateX(${width * -1 * current}px)`;

     document.querySelector(".active")?.classList.remove("active");
     indexItems[current].classList.add("active");
};

handleEventChangeSlide = setInterval(handleChangeSlide, 4000);

btnRight.addEventListener("click", () => {
     clearInterval(handleEventChangeSlide);
     handleChangeSlide();
     handleEventChangeSlide = setInterval(handleChangeSlide, 4000);
});

btnLeft.addEventListener("click", () => {
     clearInterval(handleEventChangeSlide);
     if (current === 0) {
          current = imgs.length - 1;
     } else {
          current--;
     }
     updateSlide();
     handleEventChangeSlide = setInterval(handleChangeSlide, 4000);
});

indexItems.forEach((item, index) => {
     item.addEventListener("click", () => {
          clearInterval(handleEventChangeSlide);
          current = index;
          updateSlide();
          handleEventChangeSlide = setInterval(handleChangeSlide, 4000);
     });
});
