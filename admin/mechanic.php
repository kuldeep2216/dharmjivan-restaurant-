<?php
$title = 'Mechanic';
require_once("layouts/header.php");
include("config/connection.php");
$datas = mysqli_query($con, "SELECT * FROM `mechanic`");

?>
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Mechanics</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Mechanic</li>
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
            <h3 class="card-title">Mechanics</h3>
            <!-- Button trigger modal -->
            <a href="mechanic_create.php" class="btn btn-primary float-right">Add</a>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Id</th>
                  <th>Name</th>
                  <!-- <th>Last Name</th> -->
                  <th>Exprince</th>
                  <th>Previous Work Station</th>
                  <th>Email</th>
                  <th>Mobile Number</th>
                  <th>Profile</th>
                  <th>Address</th>
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
                    <td><?= $row["fname"].' '.$row["lname"] ?></td>
                    <!-- <td><?= $row["lname"] ?></td> -->
                    <td><?= $row["exprince"] ?></td>
                    <td><?= $row["previous_work"] ?></td>
                    <td><?= $row["email"] ?></td>
                    <td><?= $row["mobile"] ?></td>
                    <td><img src="images/mechanic/<?= $row['profile'] ?>" height="100px" width="100px"></td>
                    <td><?= $row["address"] ?></td>
                    <td>
                      <div class="btn-group" role="group" aria-label="Basic example">
                        <a type="button" class="btn btn-danger" href="mechanic/delete.php?id=<?= $row["id"] ?>" onclick="return confirm('Are you sure?')">Delete</a>
                        <a type="button" class="btn btn-info" href="mechanic_edit.php?id=<?= $row["id"] ?>">Edit</a>
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
                  <!-- <th>Last Name</th> -->
                  <th>Exprince</th>
                  <th>Previous Work Station</th>
                  <th>Email</th>
                  <th>Mobile Number</th>
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