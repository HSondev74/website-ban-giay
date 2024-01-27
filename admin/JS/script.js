// Lưu trạng thái active vào Local Storage khi người dùng chọn
const allSideMenu = document.querySelectorAll("#sidebar .side-menu.top li a");
allSideMenu.forEach((item) => {
     item.addEventListener("click", function () {
          const li = item.parentElement;
          const id = li.getAttribute("id");
          localStorage.setItem("activeMenuItem", id);
     });
});

// Khôi phục trạng thái active từ Local Storage khi trang được tải lại
window.addEventListener("load", function () {
     const activeMenuItemId = localStorage.getItem("activeMenuItem");
     console.log(activeMenuItemId);
     if (activeMenuItemId) {
          const activeMenuItem = document.getElementById(activeMenuItemId);
          if (activeMenuItem) {
               activeMenuItem.classList.add("active");
          }
     }
});

// Bat tat sidebar
const menuBar = document.querySelector("#content nav .bx.bx-menu");
const sidebar = document.getElementById("sidebar");

menuBar.addEventListener("click", function () {
     sidebar.classList.toggle("hide");
});

// Lưu trạng thái chế độ tối vào Local Storage
const switchMode = document.getElementById("switch-mode");
switchMode.addEventListener("change", function () {
     if (this.checked) {
          document.body.classList.add("dark");
          localStorage.setItem("darkMode", "enabled"); // Lưu trạng thái vào Local Storage
     } else {
          document.body.classList.remove("dark");
          localStorage.setItem("darkMode", "disabled"); // Lưu trạng thái vào Local Storage
     }
});

// Khôi phục trạng thái chế độ tối từ Local Storage khi trang được tải lại
const darkMode = localStorage.getItem("darkMode");
if (darkMode === "enabled") {
     document.body.classList.add("dark");
     switchMode.checked = true;
} else {
     document.body.classList.remove("dark");
     switchMode.checked = false;
}

// Search Form
const searchButton = document.querySelector(
     "#content nav form .form-input button"
);
const searchButtonIcon = document.querySelector(
     "#content nav form .form-input button .bx"
);
const searchForm = document.querySelector("#content nav form");

searchButton.addEventListener("click", function (e) {
     if (window.innerWidth < 576) {
          e.preventDefault();
          searchForm.classList.toggle("show");
          if (searchForm.classList.contains("show")) {
               searchButtonIcon.classList.replace("bx-search", "bx-x");
          } else {
               searchButtonIcon.classList.replace("bx-x", "bx-search");
          }
     }
});

if (window.innerWidth < 768) {
     sidebar.classList.add("hide");
} else if (window.innerWidth > 576) {
     searchButtonIcon.classList.replace("bx-x", "bx-search");
     searchForm.classList.remove("show");
}

window.addEventListener("resize", function () {
     if (this.innerWidth > 576) {
          searchButtonIcon.classList.replace("bx-x", "bx-search");
          searchForm.classList.remove("show");
     }
});
