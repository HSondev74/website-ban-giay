var listimage = document.querySelector(".list-image");
var imgs = document.getElementsByTagName("img");
var btnleft = document.querySelector(".btn-left");
var btnright = document.querySelector(".btn-right");
var indexItems = document.querySelectorAll(".index-item");
let current = 0;
let handleEventChangeSlide;

const handleChangeSlide = () => {
  if (current == imgs.length - 1) {
    current = 0;
  } else {
    current++;
  }
  updateSlide();
};

const updateSlide = () => {
  let width = imgs[0].offsetWidth;
  listimage.style.transform = `translateX(${width * -1 * current}px)`;

  document.querySelector('.active').classList.remove('active');
  document.querySelector('.index-item-' + current).classList.add('active');
};

handleEventChangeSlide = setInterval(handleChangeSlide, 4000);

btnright.addEventListener('click', () => {
  clearInterval(handleEventChangeSlide);
  handleChangeSlide();
  handleEventChangeSlide = setInterval(handleChangeSlide, 4000);
});

btnleft.addEventListener('click', () => {
  clearInterval(handleEventChangeSlide);
  if (current == 0) {
    current = imgs.length - 1;
  } else {
    current--;
  }
  updateSlide();
  handleEventChangeSlide = setInterval(handleChangeSlide, 4000);
});

indexItems.forEach((item, index) => {
  item.addEventListener('click', () => {
    clearInterval(handleEventChangeSlide);
    current = index;
    updateSlide();
    handleEventChangeSlide = setInterval(handleChangeSlide, 4000);
  });
});
