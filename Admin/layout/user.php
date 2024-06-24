<div class="container-fluid px-4">
    <div class="card mb-4">
      <div class="card-header">
        <i class="fas fa-table me-1"></i>
          Danh sách người dùng |
        <a href="#adduser" data-toggle="modal" class="adduser"><button class="btn btn-primary">Thêm mới </button></a>
      </div>
      <div class="card-body">
        <table id="datatablesSimple">
          <thead>
            <tr>
              <th style="text-align: center;">STT</th>
              <th style="text-align: center;">ID</th>
              <th style="text-align: center;">Role_ID</th>
              <th style="text-align: center;">Name</th>
              <th style="text-align: center;">Mail</th>
              <th style="text-align: center;">Address</th>
              <th style="text-align: center;"></th>
            </tr>
          </thead>
          <tbody>
          <?php                      
            $query_run = mysqli_query($conn, "SELECT * FROM `usr`");        
            $i = 0;
            while ($row = mysqli_fetch_array($query_run)) 
            {
              $i++; 
          ?>
              <tr>
                <td style="text-align: center;"><?php echo $i; ?></td>
                <td style="text-align: center;"><?php echo $row['id']; ?></td>
                <td style="text-align: center;">
                <?php 
                    if ($row['role_id'] == 1)
                    {
                      echo "Super Admin";
                    } 
                    else if ($row['role_id'] == 2)
                    {
                      echo "Admin";
                    }
                    else 
                    {
                      echo "User";
                  }
                ?>
                </td>
                <td style="text-align: center;"><?php echo $row['name']; ?></td>
                <td style="text-align: center;"><?php echo $row['mail'] ?></td>
                <td style="text-align: center;"><?php echo $row['address']; ?></td>
                <?php
                  if ($_SESSION["active"] != $row["id"])
                  {
                ?>
                    <td style="text-align: center;">
                <?php
                    if ($row['is_deleted'] == 0)
                    {
                ?>
                      <button id="<?php echo $row['id'];?>" class="btn btn-primary btn-block" onclick="updateUser(this.id, 'delete')">Xoá</button>
                <?php
                    }
                    else
                    {
                ?>
                      <button id="<?php echo $row['id'];?>" class="btn btn-primary btn-block" onclick="updateUser(this.id, 'active')">Kích hoạt</button>
                <?php
                    }
                ?>
                    </td>
               <?php 
                  }
                ?>           
              </tr>
            <?php
            }
              mysqli_close($conn); 
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
<!--edit_user-->
<div class="container">
  <!-- Modal -->
  <div class="modal fade" id="edituser" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">

        </div>
        <div class="modal-body--changeusr">
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
<!--add_user-->
<div class="container">
  <!-- Modal -->
  <div class="modal fade" id="adduser" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Thêm Người Dùng</h4>
        </div>
        <div class="#">
          <form action="actions/users/add.php" method="POST">
            <div class="form-group">
              <input type="text" class="form-control" name="hoten" placeholder="Họ tên" required="required">
            </div>
            <div class="form-group">
              <input type="text" class="form-control" name="phonenumber" placeholder="Số điện thoại" required="required">
            </div>
            <div class="form-group">
              <input type="password" id="psw_register" class="form-control" name="password" placeholder="Mật khẩu" required="required">
            </div>
            <div class="form-group">
              <input type="password" id="re_psw_register" class="form-control" name="re-password" placeholder="Nhập lại mật khẩu" required="required">
            </div>
            <div class="form-group">
              <button id="btn_dk--ok" type="sbm" class="btn btn-primary form-control">Thêm mới</button>
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