<?php


?>
<main>
     <div class="container mt-1 ct">
          <div class="text-center mt-1 pb-4 img">
               <img src="./images/img-header/logo-brand.png" class="rounded mt-4" alt="..." />
          </div>
          <div class="row mt-5">
               <div class="col-lg-4 bg-white m-auto rounded-top wrapper">
                    <h2 class="text-center pt-3 mb-4">Đăng Nhập</h2>

                    <!--Form Start-->
                    <form action="#">
                         <div class="input-group mb-3">
                              <span class="input-group-text">
                                   <i class="fa fa-envelope"></i>
                              </span>
                              <input type="text" class="form-control" placeholder="Email" />
                         </div>

                         <div class="input-group mb-3">
                              <span class="input-group-text">
                                   <i class="fa fa-lock"></i>
                              </span>
                              <input type="text" class="form-control" placeholder="Password" />
                         </div>

                         <div class="mb-3 form-check">
                              <input type="checkbox" class="form-check-input" id="exampleCheck1" />
                              <label class="form-check-label" for="exampleCheck1">Ghi Nhớ Mật Khẩu
                              </label>
                         </div>

                         <div class="d-grid mt-4">
                              <button type="button" class="btn btn-dark">
                                   Đăng Nhập
                              </button>

                              <p class="text-center mt-3">
                                   Bạn chưa có tài khoản ?
                                   <a href="LogUp.html">Đăng ký ngay.</a>
                              </p>
                         </div>
                    </form>
                    <!--Form End-->
               </div>
          </div>
     </div>

     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
          integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
     </script>
</main>