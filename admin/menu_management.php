<?php
// 1. START SESSION AND INCLUDE CONNECTION
// This logic must run BEFORE any HTML is sent
session_start();
require_once("config/connection.php"); // Get $con database connection

$insert_error = '';
$delete_error = '';
$status_msg = '';

// 2. PROCESS ACTIONS (DELETE OR ADD)
// This block now runs before header.php, so redirects will work.

// --- Process Delete Request ---
if (isset($_GET['delete_id']) && is_numeric($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    
    // Use prepared statement
    $stmt = mysqli_prepare($con, "DELETE FROM menu_items WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $delete_id);
    
    if (mysqli_stmt_execute($stmt)) {
        header("Location: menu_management.php?status=deleted");
        exit(); // Stop script and redirect
    } else {
        $delete_error = "Error deleting item: " . mysqli_stmt_error($stmt);
    }
    mysqli_stmt_close($stmt);
}

// --- Process ADD ITEM Request ---
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == 'add_item') {
    // Get and sanitize form data
    $category = mysqli_real_escape_string($con, $_POST['category']);
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $description = mysqli_real_escape_string($con, $_POST['description']); 
    $price = floatval($_POST['price']); // Ensure price is a float
    $currency = mysqli_real_escape_string($con, $_POST['currency']);

    // Prepare and bind SQL statement
    $sql = "INSERT INTO menu_items (category, name, description, price, currency) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($con, $sql);
    
    mysqli_stmt_bind_param($stmt, "sssds", $category, $name, $description, $price, $currency); 

    if (mysqli_stmt_execute($stmt)) {
        header("Location: menu_management.php?status=added");
        exit(); // Stop script and redirect
    } else {
        $insert_error = "Error adding item: " . mysqli_stmt_error($stmt);
    }
    mysqli_stmt_close($stmt);
}


// 3. IF NO ACTION WAS TAKEN, LOAD THE PAGE NORMALLY
// The header file will check for a valid session
$title = 'Menu Management';
require_once("layouts/header.php"); 


// --- Handle Status Messages (for successful redirects) ---
if (isset($_GET['status'])) {
    if ($_GET['status'] == 'added') {
        $status_msg = "Menu item successfully added!";
    }
    if ($_GET['status'] == 'deleted') {
        $status_msg = "Menu item successfully deleted!";
    }
}

// --- Fetch all menu items for display ---
$menu_items = [];
$categories = ['Dinner', 'Drinks', 'Launch', 'Dessert']; 

foreach ($categories as $cat) {
    $sql = "SELECT * FROM menu_items WHERE category = ? ORDER BY id ASC";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "s", $cat);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    $menu_items[$cat] = [];
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $menu_items[$cat][] = $row;
        }
    }
    mysqli_stmt_close($stmt);
}
?>

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Menu Management</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                    <li class="breadcrumb-item active">Menu Management</li>
                </ol>
            </div>
        </div>
    </div></section>

<section class="content">
    <div class="container-fluid">
        
        <?php if (!empty($status_msg)): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php echo $status_msg; ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>
        <?php if (!empty($insert_error)): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error adding item:</strong> <?php echo $insert_error; ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>
        <?php if (!empty($delete_error)): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error deleting item:</strong> <?php echo $delete_error; ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>

        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Add New Menu Item</h3>
            </div>
            <form method="POST" action="menu_management.php" class="form-horizontal">
                <input type="hidden" name="action" value="add_item">
                <div class="card-body">
                    <div class="form-group row">
                        <label for="category" class="col-sm-2 col-form-label">Category</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="category" name="category" required>
                                <option value="Dinner">Dinner</option>
                                <option value="Drinks">Drinks</option>
                                <option value="Launch">Launch</option>
                                <option value="Dessert">Dessert</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Item Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="name" name="name" placeholder="E.g., Paneer Tikka" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="description" class="col-sm-2 col-form-label">Description</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="description" name="description" placeholder="A short description">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="price" class="col-sm-2 col-form-label">Price</label>
                        <div class="col-sm-4">
                            <input type="number" step="0.01" class="form-control" id="price" name="price" placeholder="E.g., 300" required>
                        </div>
                        <label for="currency" class="col-sm-2 col-form-label">Currency</label>
                        <div class="col-sm-4">
                            <select class="form-control" id="currency" name="currency">
                                <option value="Rs.">Rs.</option>
                                <option value="£">£</option>
                                <option value="$">$</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-center">
                    <button type="submit" class="btn btn-primary">Add Item</button>
                </div>
                </form>
        </div>
        <div class="row">
            <?php foreach ($menu_items as $category => $items): ?>
                <div class="col-lg-6">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title"><?php echo htmlspecialchars($category); ?> Menu (<?php echo count($items); ?>)</h3>
                        </div>
                        <div class="card-body">
                            <?php if (!empty($items)): ?>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered menu-table">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Price</th>
                                                <th style="width: 50px;">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($items as $item): ?>
                                                <tr>
                                                    <td><?php echo htmlspecialchars($item['id']); ?></td>
                                                    <td>
                                                        <strong><?php echo htmlspecialchars($item['name']); ?></strong><br>
                                                        <small><?php echo htmlspecialchars($item['description']); ?></small>
                                                    </td>
                                                    <td><?php echo htmlspecialchars($item['price']) . ' ' . htmlspecialchars($item['currency']); ?></td>
                                                    <td>
                                                        <a href="menu_management.php?delete_id=<?php echo $item['id']; ?>" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure you want to delete this item?');">
                                                            <i class="fas fa-trash"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php else: ?>
                                <p class="text-center">No items found in the <?php echo htmlspecialchars($category); ?> category.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        </div></section>
<?php
require_once("layouts/footer.php");
?>

<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

<script>
  $(function () {
    // Initialize DataTables for all tables with the class 'menu-table'
    $(".menu-table").DataTable({
      "responsive": true,
      "lengthChange": true,
      "autoWidth": false,
      "paging": true,
      "ordering": true,
      "info": true,
      "order": [[ 0, "asc" ]] // Order by ID ascending
    });
  });
</script>