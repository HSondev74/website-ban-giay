document
     .querySelector(".form-check-input")
     .addEventListener("change", function () {
          if (this.checked) {
               var email = document.getElementById("email").value;
               var password = document.getElementById("password").value;

               document.cookie =
                    "remember_email=" +
                    email +
                    "; expires=" +
                    new Date(
                         new Date().getTime() + 30 * 24 * 60 * 60 * 1000
                    ).toUTCString() +
                    "; path=/";
               document.cookie =
                    "remember_password=" +
                    password +
                    "; expires=" +
                    new Date(
                         new Date().getTime() + 30 * 24 * 60 * 60 * 1000
                    ).toUTCString() +
                    "; path=/";
          } else {
               document.cookie =
                    "remember_email=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
               document.cookie =
                    "remember_password=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
          }
     });
