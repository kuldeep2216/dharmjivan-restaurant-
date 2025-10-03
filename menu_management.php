<?php
// 1. AUTHENTICATION CHECK - MUST BE THE FIRST LINE
include("auth_check.php"); 

// Include the centralized database configuration
include("db_config.php"); 

// --- Process Delete Request ---
if (isset($_GET['delete_id']) && is_numeric($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    
    $stmt = $conn->prepare("DELETE FROM menu_items WHERE id = ?");
    $stmt->bind_param("i", $delete_id);
    
    if ($stmt->execute()) {
        header("Location: menu_management.php?status=deleted");
        exit();
    } else {
        $delete_error = "Error deleting item: " . $stmt->error;
    }
    $stmt->close();
}

// --- Process ADD ITEM Request ---
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == 'add_item') {
    // Get and sanitize form data
    $category = $conn->real_escape_string($_POST['category']);
    $name = $conn->real_escape_string($_POST['name']);
    $description = $conn->real_escape_string($_POST['description']); 
    // Ensure price is converted to a float/double for the 'd' parameter
    $price = floatval($_POST['price']);
    $currency = $conn->real_escape_string($_POST['currency']);

    // Prepare and bind SQL statement
    $sql = "INSERT INTO menu_items (category, name, description, price, currency) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    
    // CORRECT bind_param: s (category), s (name), s (description), d (price/decimal), s (currency)
    $stmt->bind_param("sssds", $category, $name, $description, $price, $currency); 

    if ($stmt->execute()) {
        header("Location: menu_management.php?status=added");
        exit();
    } else {
        $insert_error = "Error adding item: " . $stmt->error;
    }
    $stmt->close();
}


// --- Fetch all menu items for display ---
$menu_items = [];
$categories = ['Dinner', 'Drinks', 'Launch', 'Dessert']; 

foreach ($categories as $cat) {
    $sql = "SELECT * FROM menu_items WHERE category = ? ORDER BY id ASC";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $cat);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $menu_items[$cat] = [];
    while ($row = $result->fetch_assoc()) {
        $menu_items[$cat][] = $row;
    }
    $stmt->close();
}

// *** START: Standalone Admin HTML Structure with Custom CSS ***
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Menu Management</title>
    <link type="text/css" rel="stylesheet" href="css/bootstrap.min.css"/>
    <link type="text/css" rel="stylesheet" href="css/style.css"/>
    <style>
        body {padding-top: 20px; background-color: #f9f9f9;}
        .admin-logo-container { 
            background-color: #fff; 
            border-bottom: 1px solid #ECECEC; 
            margin-bottom: 30px; 
            max-width: 1150px; 
            margin-left: auto;
            margin-right: auto;
            border-radius: 4px; 
        }
        /* Use Flexbox to ensure spacing between the two elements */
        .admin-header-content {
            display: flex; 
            justify-content: space-between; /* Pushes items to opposite ends */
            align-items: center;
            /* Using padding: 10px 30px 10px 15px to ensure the button sits correctly */
            padding: 10px 30px 10px 15px; 
        }
        /* Style the logo wrapper to remove its float property inherited from style.css */
        .admin-header-content .logo {
            float: none; /* Override default float:left */
        }
        #menu-management.section { padding-top: 20px; }
    </style>
</head>
<body>

    <div class="admin-logo-container">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 admin-header-content">
                    
                    <a class="logo" href="index.php">
                        <img src="./img/logo.png" alt="Dharmjivan Restaurant Logo">
                    </a>
                    
                    <a href="logout.php" class="main-button btn-xs" style="background-color: #888; padding: 8px 15px;">Log Out</a>
                </div>
            </div>
        </div>
    </div>
    <div id="menu-management" class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-header text-center">
                    <h4 class="sub-title">Admin Panel</h4>
                    <h2 class="title">Menu Management</h2>
                </div>

                <div style="margin-bottom: 30px; text-align: center;">
                    <a href="admin_panel.php" class="main-button" style="margin-right: 10px;">Manage Reservations</a>
                    <a href="hours_management.php" class="main-button" style="margin-left: 10px;">Manage Hours</a>
                </div>

                <?php if (isset($_GET['status'])): ?>
                    <div class="alert alert-success text-center">
                        <?php 
                            if ($_GET['status'] == 'added') echo "Menu item successfully added!";
                            if ($_GET['status'] == 'deleted') echo "Menu item successfully deleted!";
                        ?>
                    </div>
                <?php endif; ?>
                <?php if (isset($insert_error)): ?>
                    <div class="alert alert-danger text-center"><?php echo $insert_error; ?></div>
                <?php endif; ?>
                <?php if (isset($delete_error)): ?>
                    <div class="alert alert-danger text-center"><?php echo $delete_error; ?></div>
                <?php endif; ?>

                <div class="panel panel-default">
                    <div class="panel-heading"><h3 class="panel-title">Add New Menu Item</h3></div>
                    <div class="panel-body">
                        <form method="POST" action="menu_management.php" class="form-horizontal">
                            <input type="hidden" name="action" value="add_item">

                            <div class="form-group">
                                <label for="category" class="col-sm-2 control-label">Category</label>
                                <div class="col-sm-10">
                                    <select class="form-control" id="category" name="category" required>
                                        <option value="Dinner">Dinner</option>
                                        <option value="Drinks">Drinks</option>
                                        <option value="Launch">Launch</option>
                                        <option value="Dessert">Dessert</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">Item Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="name" name="name" placeholder="E.g., Paneer Tikka" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="description" class="col-sm-2 control-label">Description</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="description" name="description" placeholder="A short description">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="price" class="col-sm-2 control-label">Price</label>
                                <div class="col-sm-4">
                                    <input type="number" step="0.01" class="form-control" id="price" name="price" placeholder="E.g., 300" required>
                                </div>
                                <label for="currency" class="col-sm-2 control-label">Currency</label>
                                <div class="col-sm-4">
                                    <select class="form-control" id="currency" name="currency">
                                        <option value="Rs.">Rs.</option>
                                        <option value="£">£</option>
                                        <option value="$">$</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10 text-center">
                                    <button type="submit" class="main-button">Add Item</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <?php foreach ($menu_items as $category => $items): ?>
                    <div class="panel panel-info" style="margin-top: 40px;">
                        <div class="panel-heading"><h3 class="panel-title"><?php echo htmlspecialchars($category); ?> Menu Items (<?php echo count($items); ?>)</h3></div>
                        <div class="panel-body">
                            <?php if (!empty($items)): ?>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Description</th>
                                                <th>Price</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($items as $item): ?>
                                                <tr>
                                                    <td><?php echo htmlspecialchars($item['id']); ?></td>
                                                    <td><?php echo htmlspecialchars($item['name']); ?></td>
                                                    <td><?php echo htmlspecialchars($item['description']); ?></td>
                                                    <td><?php echo htmlspecialchars($item['price']) . ' ' . htmlspecialchars($item['currency']); ?></td>
                                                    <td>
                                                        <a href="menu_management.php?delete_id=<?php echo $item['id']; ?>" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a>
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
                <?php endforeach; ?>

                <div style="margin-top: 20px; text-align: center;">
                    <a href="index.php" class="main-button">Go to Home Page</a>
                </div>

            </div>
        </div>
    </div>
</div>

<?php
$conn->close();
?>

</body>
</html>