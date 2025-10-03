<?php
$title = 'Social Media Links';
require_once("layouts/header.php");
include("config/connection.php");
$datas = mysqli_query($con, "SELECT * FROM `social_media`;");
?>
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Social Media Links</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Social Media Links</li>
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
            <h3 class="card-title">Social Media Links</h3>
            <!-- Button trigger modal -->
            <!-- <a href="service_create.php" class="btn btn-primary float-right">Add</a> -->
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                    <th>Id</th>
                    <th>Whatsapp</th>
                    <th>Facebook</th>
                    <th>Instagrame</th>
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
                    <td><?= $row["whatsapp"] ?></td>
                    <td><?= $row["facebook"] ?></td>
                    <td><?= $row["instagram"] ?></td>
                    <td>
                      <div class="btn-group" role="group" aria-label="Basic example">
                        <a type="button" class="btn btn-info" href="social_media_edit.php?id=<?= $row["id"] ?>">Edit</a>
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
                  <th>Whatsapp</th>
                  <th>Facebook</th>
                  <th>Instagrame</th>
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