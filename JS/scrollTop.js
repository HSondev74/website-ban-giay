window.addEventListener("scroll", function () {
     var scrollToTopButton = document.getElementById("scrollToTop");
     if (window.pageYOffset > 100) {
          scrollToTopButton.classList.add("show");
     } else {
          scrollToTopButton.classList.remove("show");
     }
});

document.getElementById("scrollToTop").addEventListener("click", function () {
     window.scrollTo({ top: 0, behavior: "smooth" });
});
