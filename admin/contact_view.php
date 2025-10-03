<?php
$title = 'Appoitment';
require_once("layouts/header.php");
include("config/connection.php");

$datas = mysqli_query($con, "SELECT * FROM `contact` WHERE `id` = '" . $_GET['id'] . "'");

$data = mysqli_fetch_assoc($datas);
// print_r($data);

?>
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Contact Us</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Contact Us</li>
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
                        <h3 class="card-title">Contact Us</h3>
                        <!-- Button trigger modal -->
                        <!-- <a href="category_create.php" class="btn btn-primary float-right">Add</a> -->
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        <div class="row">
                        <div class="col-lg-6 col-12">
                                <div class="form-group">
                                    <label for="CategoryName">Date : </label> <?= date("d/m/Y", strtotime($data["created_at"])) ?>
                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
                                <div class="form-group">
                                    <label for="CategoryName">Time : </label> <?= date("h:i:sa", strtotime($data["created_at"])) ?>
                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
                                <div class="form-group">
                                    <label for="CategoryName">Customer Name : </label> <?= $data['name'] ?>
                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
                                <div class="form-group">
                                    <label for="CategoryName">Customer Mobile : </label> <?= $data['mobile'] ?>
                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
                                <div class="form-group">
                                    <label for="CategoryName">Subject : </label> <?= $data['subject'] ?>
                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
                                <div class="form-group">
                                    <label for="CategoryName">Message : </label> <?= $data['message'] ?>
                                </div>
                            </div>
                            <?php if($data['is_read'] == 0){?>
                            <div class="col-lg-6 col-12">

                                <form action="contact/contact_process_update.php" method="post">
                                    <input type="hidden" name="id" value="<?=$data["id"]?>">
                                        <div class="form-group">
                                            <label for="CategoryName">Accept Inquiry : </label>
                                            <select class="form-control" name="is_read">
                                                <option value="1">Read</option>
                                                <option value="0">Unread</option>
                                            </select>
                                        </div>
                                        <a href="javascript:history.go(-1)" class="btn btn-danger" title="Return to the previous page">Back</a>
                                        <input type="submit" value="submit" class="btn btn-primary">

                                </form>
                            </div>
                            <?php }else{?>
                            <div class="col-lg-6 col-12">
                                <div class="form-group">
                                    <label for="CategoryName">Status : </label> <?php if($data['is_read']==1){echo "Read";} ?>
                                </div>
                            </div>
                            
                            
                        </div>
                        <a href="javascript:history.go(-1)" class="btn btn-danger" title="Return to the previous page">Back</a>
                    <?php }?>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</section>

<?php
require_once("layouts/footer.php");
?>