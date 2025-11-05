<?php
    include("inc/header.php"); 
    include("db_config.php"); // <-- 1. ADDED DATABASE CONNECTION

    // --- 2. ADDED ALL THE LOGIC TO FETCH MENU ITEMS ---

    // Function to fetch menu items for a specific category
    function get_menu_items($conn, $category) {
        $items = [];
        $stmt = $conn->prepare("SELECT name, description, price, currency FROM menu_items WHERE category = ?");
        $stmt->bind_param("s", $category);
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            $items[] = $row;
        }
        $stmt->close();
        return $items;
    }

    $menu_categories = [
        'menu1' => 'Dinner',
        'menu2' => 'Drinks',
        'menu3' => 'Launch', // Note: Your code says 'Launch', not 'Lunch'
        'menu4' => 'Dessert'
    ];
    
    $all_menu_items = [];
    foreach ($menu_categories as $tab_id => $category) {
        $all_menu_items[$tab_id] = get_menu_items($conn, $category);
    }
    
    // Close the connection
    $conn->close();
?>

    <div id="page-header" class="banner-area">
        <div class="bg-image bg-parallax overlay" style="background-image:url(./img/background01.jpg)"></div>
        <div class="home-wrapper">
            <div class="col-md-10 col-md-offset-1 text-center">
                <div class="home-content">
                    <h1 class="white-text">Our Menu</h1>
                    <h4 class="white-text lead">Authentic flavors, traditionally prepared.</h4>
                </div>
            </div>
        </div>
    </div>
    <div id="menu" class="section">
        <div class="container">
            <div class="row">

                <div class="section-header text-center">
                    <h4 class="sub-title">Discover</h4>
                    <h2 class="title">Our Menu</h2>
                </div>

                <ul class="menu-nav">
                    <li class="active"><a data-toggle="tab" href="#menu1">Dinner</a></li>
                    <li><a data-toggle="tab" href="#menu2">Drinks</a></li> 
                    <li><a data-toggle="tab" href="#menu3">Launch</a></li>
                    <li><a data-toggle="tab" href="#menu4">Dessert</a></li>
                </ul>
                
                <div id="menu-content" class="tab-content">

                    <?php 
                    $i = 1;
                    foreach ($menu_categories as $tab_id => $category): 
                        $is_active = ($i == 1) ? ' in active' : '';
                        $items = $all_menu_items[$tab_id];
                    ?>

                    <div id="<?php echo $tab_id; ?>" class="tab-pane fade<?php echo $is_active; ?>">
                        <div class="col-md-6">
                            <?php 
                            // Split items into two columns
                            $half = ceil(count($items) / 2);
                            $col1_items = array_slice($items, 0, $half);
                            
                            foreach ($col1_items as $item): 
                            ?>
                            <div class="single-dish">
                                <div class="single-dish-heading">
                                    <h4 class="name"><?php echo htmlspecialchars($item['name']); ?></h4>
                                    <h4 class="price"><?php echo htmlspecialchars($item['price']) . ' ' . htmlspecialchars($item['currency']); ?></h4>
                                </div>
                                <p><?php echo htmlspecialchars($item['description']); ?></p>
                            </div>
                            <?php endforeach; ?>
                        </div>

                        <div class="col-md-6">
                            <?php 
                            $col2_items = array_slice($items, $half);
                            
                            foreach ($col2_items as $item): 
                            ?>
                            <div class="single-dish">
                                <div class="single-dish-heading">
                                    <h4 class="name"><?php echo htmlspecialchars($item['name']); ?></h4>
                                    <h4 class="price"><?php echo htmlspecialchars($item['price']) . ' ' . htmlspecialchars($item['currency']); ?></h4>
                                </div>
                                <p><?php echo htmlspecialchars($item['description']); ?></p>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <?php $i++; endforeach; ?>
                </div>
                
                </div>
        </div>
    </div>

<?php
    include("inc/footer.php"); 
?>