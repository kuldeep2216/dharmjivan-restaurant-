<?php
$title = 'Contact Us';
require_once("layouts/header.php");
include("config/connection.php");
$datas = mysqli_query($con, "SELECT * FROM `contact`");
?>
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Contact</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Contact</li>
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
            <h3 class="card-title">Contact</h3>
            <!-- Button trigger modal -->
            <!-- <a href="user_create.php" class="btn btn-primary float-right">Add</a> -->
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Id</th>
                  <th>Name</th>
                  <th>Mobile</th>
                  <th>Subject</th>
                  <th>Message</th>
                  <th>Date</th>
                  <!-- <th>Time</th> -->
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
                    <td><?= $row["mobile"] ?></td>
                    <td><?= $row["subject"] ?></td>                    
                    <td><?= $row["message"] ?></td>                    
                    <td><?= date("d/m/Y", strtotime($row["created_at"])) ?></td>                    
                    <!-- <td><?= date("h:i:sa", strtotime($row["created_at"])) ?></td>                   -->
                    <td>
                      <div class="btn-group" role="group" aria-label="Basic example">
                        <a type="button" class="btn btn-danger" href="contact/delete.php?id=<?= $row["id"] ?>" onclick="return confirm('Are you sure?')">Delete</a>
                        <a type="button" class="btn btn-info" href="contact_view.php?id=<?= $row["id"] ?>">View</a>
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
                  <th>Mobile</th>
                  <th>Subject</th>
                  <th>Message</th>
                  <th>Date</th>
                  <!-- <th>Time</th> -->
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