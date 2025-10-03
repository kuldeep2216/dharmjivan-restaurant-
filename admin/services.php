<?php
$title = 'Service';
require_once("layouts/header.php");
include("config/connection.php");
$datas = mysqli_query($con, "SELECT * FROM `services` ORDER BY 'id' DESC");
// $datas = mysqli_query($con, "SELECT * FROM `services`");
?>
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Services</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Services</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Services</h3>
            <!-- Button trigger modal -->
            <a href="service_create.php" class="btn btn-primary float-right">Add</a>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Id</th>
                  <th>Name</th>
                  <th>Image</th>
                  <th>Discription</th>
                  <th>Price</th>
                  <th>Approx Time</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $i = 1;
                while ($row = mysqli_fetch_assoc($datas)) {
                ?>
                  <tr>
                    <td><?= $i ?></td>
                    <td><?= $row["name"] ?></td>
                    <td><a href="<?php echo '../admin/images/services/' . $row['service_image']; ?>" target="_blank">
                      <img src="<?php echo '../admin/images/services/' . $row['service_image']; ?>" height="100px" width="100px" alt="image of services">
                    </a></td>
                    <td><?= $row["description"] ?></td>
                    <td><?= $row["price"] ?></td>
                    <td><?= $row["approx_time"] ?></td>
                    <td><?php if($row['status'] == 1){echo "Active"; }else{ echo "Inactive"; } ?></td>
                    <td>
                      <div class="btn-group" role="group" aria-label="Basic example">
                        <a type="button" class="btn btn-danger" href="service/delete.php?id=<?= $row["id"] ?>" onclick="return confirm('Are you sure?')">Delete</a>
                        <a type="button" class="btn btn-info" href="service_edit.php?id=<?= $row["id"] ?>">Edit</a>
                      </div>
                    </td>
                  </tr>
                <?php
                  $i++;
                }
                ?>

              </tbody>
              <tfoot>
                <tr>
                  <th>Id</th>
                  <th>Name</th>
                  <th>Image</th>
                  <th>Discription</th>
                  <th>Price</th>
                  <th>Approx Time</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </tfoot>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
      </div>
    </div>
  </div>
</section>

<?php
require_once("layouts/footer.php");
?>