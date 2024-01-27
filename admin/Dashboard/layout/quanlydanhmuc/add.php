<h1 style="font-size: 36px;
     font-weight: 600;
     margin: 10px 30px;
     color: var(--dark);">Danh mục</h1>
<ul class="breadcrumb" style="display: flex;
     align-items: center;
     grid-gap: 16px;
     margin: 20px 30px;">
     <li>
          <a href="index.php" style="color: var(--dark-grey);">Dashboard</a>
     </li>
     <li><i class='bx bx-chevron-right'></i></li>
     <li>
          <a class="active" href="" style="pointer-events: none;
color: var(--blue);">Danh mục</a>
     </li>
</ul>
<form action="Dashboard/layout/quanlydanhmuc/xuly.php" method="post" class="form-danhmuc">
     <table>
          <tr>
               <td colspan="2">
                    <h3>Thêm danh mục sản phẩm</h3>
               </td>
          </tr>
          <tr>
               <td>Tên danh mục</td>
               <td><input type="text" placeholder="Nhập tên danh mục..." name="cate_name" id="cate_name" value="" require>
                    <button class="save" type="submit" name="btnSave">
                         Thêm Danh Mục
                    </button>
               </td>
          </tr>
          <!-- <tr>
               <td colspan="2" align="center">
               </td>
          </tr> -->
     </table>
</form>