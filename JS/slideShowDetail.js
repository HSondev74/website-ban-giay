var list = document.querySelectorAll(".list img");
var gallery = document.querySelector(".gallery");
var galleryInner = document.querySelector(".gallery-inner img");
var prev = document.querySelector(".control.prev");
var next = document.querySelector(".control.next");

var curenIndex = 0;

list.forEach((item, index) => {
  if (index === 0) {
    galleryInner.setAttribute("src", `${item.src}`);
  }

  item.addEventListener("click", (e) => {
    list[curenIndex].classList.remove("active");
    curenIndex = index;
    var img = item.src;
    galleryInner.setAttribute("src", `${img}`);
    item.classList.add("active");
  });
});

next.addEventListener("click", () => {
  curenIndex++;
  if (curenIndex >= list.length) {
    curenIndex = 0;
    var a = list[curenIndex].src;
    galleryInner.setAttribute("src", `${a}`);
  } else {
    var a = list[curenIndex].src;
    galleryInner.setAttribute("src", `${a}`);
  }
});

prev.addEventListener("click", () => {
  curenIndex--;
  if (curenIndex <= 0) {
    curenIndex = list.length - 1;
    var a = list[curenIndex].src;
    galleryInner.setAttribute("src", `${a}`);
  } else {
    var a = list[curenIndex].src;
    galleryInner.setAttribute("src", `${a}`);
  }
});
