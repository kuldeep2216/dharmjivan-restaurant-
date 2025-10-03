<?php
$title = 'User';
require_once("layouts/header.php");
include("config/connection.php");
$datas = mysqli_query($con, "SELECT * FROM `users`");
?>
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Users</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Users</li>
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
            <h3 class="card-title">Users</h3>
            <!-- Button trigger modal -->
            <!-- <a href="customer_create.php" class="btn btn-primary float-right">Add</a> -->
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Id</th>
                  <th>First Name</th>
                  <th>Last Name</th>
                  <th>Email</th>
                  <th>Mobile</th>
                  <th>Gender</th>
                  <th>Profile</th>
                  <th>Address</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                while ($row = mysqli_fetch_assoc($datas)) {
                ?>
                  <tr>
                    <td><?= $row["id"] ?></td>
                    <td><?= $row["fname"] ?></td>
                    <td><?= $row["lname"] ?></td>
                    <td><?= $row["user_email"] ?></td>
                    <td><?= $row["mobile"] ?></td>
                    <td><?= $row["gender"] ?></td>
                    <td><img src="images/profile/<?= $row['profile'] ?>" height="100px" width="100px"></td>
                    <!-- <td><?= $row["profile"] ?></td> -->
                    <td><?= $row["address"] ?></td>
                    <td>
                      <div class="btn-group" role="group" aria-label="Basic example">
                        <a type="button" class="btn btn-danger" href="customers/delete.php?id=<?= $row["id"] ?>" onclick="return confirm('Are you sure?')">Delete</a>
                        <a type="button" class="btn btn-info" href="customer_edit.php?id=<?= $row["id"] ?>">Edit</a>
                      </div>
                    </td>
                  </tr>
                <?php
                }
                ?>

              </tbody>
              <tfoot>
              <tr>
                  <th>Id</th>
                  <th>First Name</th>
                  <th>Last Name</th>
                  <th>Email</th>
                  <th>Mobile</th>
                  <th>Gender</th>
                  <th>Profile</th>
                  <th>Address</th>
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