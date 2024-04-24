<ul class="breadcrumb" style="display: flex;
     align-items: center;
     grid-gap: 16px;
     margin: 20px 30px;">
     <li>
          <a href="index.php?action=sanpham" style="color: var(--dark-grey);">Dashboard</a>
     </li>
     <li><i class='bx bx-chevron-right'></i></li>
     <li>
          <a class="active" href="" style="pointer-events: none;
color: var(--blue);">Danh mục</a>
     </li>
</ul>
<div class="board" style="width: 90%;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            ">
     <form action="Dashboard/layout/quanlydanhmuc/xuly.php" method="post" class="form-danhmuc">
          <h3 style="text-align: center;">Thêm danh mục sản phẩm</h3>
          <label>Tên danh mục</label>
          <input style="margin: 20px 0;" type="text" placeholder="Nhập tên danh mục..." name="cate_name" id="cate_name" value="" require>
          <button class="save" type="submit" name="btnSave">
               Thêm Danh Mục
          </button>
          <!-- <tr>
               <td colspan="2" align="center">
               </td>
          </tr> -->
     </form>
</div>