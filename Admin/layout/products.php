<div class="container-fluid px-4">
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Danh sách sản phẩm | <a href="#addproduct" data-toggle="modal" class = "addproduct"><button class="btn btn-primary">Thêm mới sản phẩm</button></a>
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th style="text-align: center;">ID</th>
                            <th style="text-align: center;">Loại sản phẩm</th>
                            <th style="text-align: center;">Hãng</th>
                            <th style="text-align: center;">Tên sản phẩm</th>
                            <th style="text-align: center;">Giá</th>
                            <th style="text-align: center;">Giá sale</th>
                            <th style="text-align: center;">Ngày nhập</th>
                            <th style="text-align: center;">Số lượng</th>
                            <th style="text-align: center;">Ngày bảo hành</th>
                            <th style="text-align: center;">Chi tiết</th>
                            <th style="text-align: center;">Ảnh</th>
                        </tr>
                    </thead>
                    <tbody>

                    <?php
                      // 1. Viết câu lệnh truy vấn để lấy ra dữ liệu mong muốn
                    $admin_products = "SELECT product.id , product.name, product.price, product.sale_price, product.import_date, product.quantity, product.warranty_day, product.detail, product.image, product.is_deleted, product_type.name as producttypename, brand.name as brandname 
                    From product INNER JOIN product_type ON product.product_type_id = product_type.id 
                    INNER JOIN brand ON product.brand_id = brand.id ORDER BY id ASC";

                    // 2. Thực thi câu lệnh truy vấn (mục đích trả về dữ liệu các bạn cần)
                    $query_run = mysqli_query($conn, $admin_products);

                    // 3. Hiển thị ra dữ liệu bạn vừa lấy được
                    $i = 0;
                    while ($row = mysqli_fetch_array($query_run)) 
                    {
                        $i++
                    ;?>
                    <tr>
                        <td style="text-align: center;"><?php echo $row['id'] ;?></td>
                        <td style="text-align: center;"><?php echo $row['producttypename'] ;?></td>
                        <td style="text-align: center;"><?php echo $row['brandname'] ;?></td>
                        <td style="text-align: center;"><?php echo $row['name'] ;?></td>
                        <td style="text-align: center;"><?php echo $row['price'] ?></td>
                        <td style="text-align: center;"><?php echo $row['sale_price'] ;?></td>
                        <td style="text-align: center;"><?php echo $row['import_date'] ;?></td>
                        <td style="text-align: center;"><?php echo $row['quantity'] ;?></td>
                        <td style="text-align: center;"><?php echo $row['warranty_day'] ;?></td>
                        <td style="text-align: center;"><?php echo $row['detail'] ;?></td>
                        <td style="text-align: center;">
                            <img src="../img/products/<?php echo $row['image']; ?>" width="150">
                        </td>
                        <td style="text-align: center;">
                            <!-- <a href="#editproduct" data-toggle="modal" data-id = "<?php echo $row['id']?>" class = "product"><button class="btn btn-primary btn-block">sửa</button></a> -->
                            <a>
                              <button id="<?php echo $row['id']?>" class="change__prd btn btn-primary btn-block" onclick="updateProduct(this.id)">Sửa</button>
                            </a>
                        </td>
                        <td style="text-align: center;">
                          <!-- <a href="actions/products/delete.php?id=<?php echo $row['id'] ;?>"> -->
                          <?php
                            if ($row['is_deleted'] == 0)
                            {
                          ?>
                              <button id="<?php echo $row['id'];?>" class ="del btn btn-primary btn-block" onclick= "DeleteProduct(this.id, 'Cancel')">Xóa</button>
                          <?php
                            }
                            else
                            {
                          ?>
                            <button id="<?php echo $row['id'];?>" class="del btn btn-primary btn-block" onclick= "DeleteProduct(this.id, 'reCancel')">Kích hoạt</button>
                          <?php
                            }
                          ?>
                            
                          </a>
                        </td>
                    </tr>

                    <?php
                    }
                    // 4. Đóng lại kết nối sau khi dử dụng xong
                    mysqli_close($conn);
                    ;?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


<div class="container">
  <!-- Modal -->
  <div class="modal fade" id="editproduct" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
       <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Sửa thông tin sản phẩm</h4>
        </div>
        <div class="modal-body--editproduct">
          <p>Some text in the modal.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div> 
    <!-- Modal content-->
     </div>
  </div>
    <!-- Modal -->
</div>

<!--add_product-->
<div class="container">
  <!-- Modal -->
  <div class="modal fade" id="addproduct" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Thêm sản phẩm</h4>
        </div>
        <div class="#">
            <form action="actions/products/add.php" method="POST">
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="">Loại sản phẩm</label>
                        <select name="product_type_id" requied class="form-control">
                            <option value="">---Select---</option>
                            <option value="1" >Smartphone</option>
                            <option value="2" >Laptop</option>
                            <option value="3" >PC</option>
                            <option value="4" >Linh kiện PC</option>
                            <option value="5" >Chuột - bàn phím</option>
                            <option value="6" >Phụ kiện khác</option>
                        </select>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="">Thương hiệu</label>
                        <select name="brand_id" requied class="form-control">
                            <option value="">---Select---</option>
                            <option value="1" >Apple</option>
                            <option value="2" >Samsung</option>
                            <option value="3" >Asus</option>
                            <option value="4" >Dell</option>
                            <option value="5" >Dareu</option>
                            <option value="6" >LG</option>
                            <option value="7" >Cooler Master</option>
                            <option value="8" >AMD</option>
                            <option value="9" >Intel</option>
                            <option value="10" >Kingstion</option>
                            <option value="11" >JBL</option>
                            <option value="12" >Xigmatek</option>
                            <option value="13" >Logitech</option>
                            <option value="14" >Sony</option>
                            <option value="15" >MSI</option>
                        </select>        
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="">Tên sản phẩm</label>
                        <input class="form-control" type="text" name="name" required = "required" >
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="">Giá</label>
                        <input class="form-control" type="text" name="price" required = "required" >
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="">Giá sale</label>
                        <input class="form-control" type="text" name="sale_price" required = "required" >
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="">Ngày nhập</label>
                        <input class="form-control" type="date" name="import_date" required = "required" >
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="">Số lượng</label>
                        <input class="form-control" type="text" name="quantity" required = "required" >
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="">Ngày bảo hành</label>
                        <input class="form-control" type="text" name="warranty_day" required = "required" >
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="">Chi tiết</label>
                        <textarea name="detail" id="summernote" cols="30" rows="10"></textarea>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label>Ảnh sản phẩm</label> <br>
                        <input type="file" name="image">
                    </div>
                    <div class="col-md-12 mb-3">
                    <br>
                        <button type="submit" name="sbm" class="btn btn-primary form-control">Thêm mới</button>
                    </div>
                </div>
		    </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      <!-- Modal content-->
    </div>
  </div>
  <!-- Modal -->
</div>