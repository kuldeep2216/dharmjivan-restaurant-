<?php
	include("inc/header.php");
	include("db_config.php"); // Include DB config

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
		'menu3' => 'Launch',
		'menu4' => 'Dessert'
	];
	$all_menu_items = [];
	foreach ($menu_categories as $tab_id => $category) {
		$all_menu_items[$tab_id] = get_menu_items($conn, $category);
	}
    
    // NOTE: Keep connection open for now, as we need it later for Opening Hours too.
?>
		<div id="home" class="banner-area">

			<div class="bg-image bg-parallax overlay" style="background-image:url(./img/background02.jpg)"></div>
			<div class="home-wrapper">

				<div class="col-md-10 col-md-offset-1 text-center">
					<div class="home-content">
						<h1 class="white-text">Welcome To Dharmjivan Restaurant</h1>
						<h4 class="white-text lead">Experience authentic flavors and traditional dishes, handcrafted with the highest quality ingredients since 2025.</h4>
						<a href="index.php#menu"><button class="main-button">Discover Menu</button></a>
					</div>
				</div>

			</div>

		</div>
		<div id="about" class="section">

			<div class="container">

				<div class="row">

					<div class="section-header text-center">
						<h4 class="sub-title">About Us</h4>
						<h2 class="title">Dharmjivan Restaurant</h2>
					</div>
					<div class="col-md-5">
						<h4 class="lead">Welcome to Dharmjivan Restaurant. Since 2025, Offering Traditional Dishes of the highest quality.</h4>
					</div>
					<div class="col-md-7">
						<p>At Dharmjivan Restaurant, our passion is preserving and serving authentic regional cuisine. We are dedicated to selecting only the freshest, locally-sourced ingredients to prepare dishes that respect time-honored recipes. Our dining experience is crafted to transport you to the heart of tradition with every meal. Whether you are joining us for a family celebration or a quiet dinner, expect quality, warmth, and flavor that has defined us since our founding in 2025.</p>
					</div>
					<div class="col-md-12">
						<div id="Gallery" class="owl-carousel owl-theme">

							<div class="Gallery-item">

								<div class="Gallery-img" style="background-image:url(./img/image01.jpg)"></div>
								</div>
							<div class="Gallery-item">

								<div class="Gallery-img" style="background-image:url(./img/image02.jpg)"></div>
								<div class="Gallery-img" style="background-image:url(./img/image03.jpg)"></div>
								</div>
							<div class="Gallery-item">

								<div class="item-column">
									<div class="Gallery-img" style="background-image:url(./img/image04.jpg)"></div>
									<div class="Gallery-img" style="background-image:url(./img/image05.jpg)"></div>
									</div>

								<div class="item-column">
									<div class="Gallery-img" style="background-image:url(./img/image06.jpg)"></div>
									<div class="Gallery-img" style="background-image:url(./img/image07.jpg)"></div>
									</div>

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div id="menu" class="section">

			<div class="bg-image bg-parallax overlay" style="background-image:url(./img/background01.jpg)"></div>
			<div class="container">

				<div class="row">

					<div class="section-header text-center">
						<h4 class="sub-title">Discover</h4>
						<h2 class="title white-text">Our Menu</h2>
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
		<div id="reservation" class="section">

			<div class="bg-image" style="background-image:url(./img/background03.jpg)"></div>
			<div class="container">

				<div class="row">

					<div class="col-md-6 col-md-offset-1 col-sm-10 col-sm-offset-1">
						<form class="reserve-form row" method="POST" action="process_reservation.php">
							<div class="section-header text-center">
								<h4 class="sub-title">Reservation</h4>
								<h2 class="title white-text">Book Your Table</h2>
							</div>

							<div class="col-md-6">
								<div class="form-group">
									<label for="name">Name:</label>
									<input class="input" type="text" placeholder="Name" id="name" name="name" required>
								</div>
								<div class="form-group">
									<label for="phone">Phone:</label>
									<input class="input" type="tel" placeholder="Phone" id="phone" name="phone" required>
								</div>
								<div class="form-group">
									<label for="date">Date:</label>
									<input class="input" type="date" id="date" name="date" required>
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group">
									<label for="email">Email:</label>
									<input class="input" type="email" placeholder="Email" id="email" name="email">
								</div>
								<div class="form-group">
									<label for="guests">Number of Guests:</label>
									<select class="input" id="guests" name="guests">
										<option value="1">1 Person</option>
										<option value="2">2 People</option>
										<option value="3">3 People</option>
										<option value="4">4 People</option>
										<option value="5">5 People</option>
										<option value="6">6 People</option>
									</select>
								</div>
								<div class="form-group">
								  <label for="time">Time:</label>
								  <input class="input" type="time" id="time" name="time" required>
								</div>
							</div>

							<div class="col-md-12 text-center">
								<button class="main-button" type="submit">Book Now</button>
							</div>

						</form>
					</div>
					
                    <div class="col-md-4 col-md-offset-0 col-sm-10 col-sm-offset-1">
						<div class="opening-time row">
							<div class="section-header text-center">
								<h2 class="title white-text">Opening Time</h2>
							</div>
							<ul>
                                <?php
                                // Fetch hours from the database table (connection is still open from the start of the file)
                                $hours_sql = "SELECT day_name, hours_open, hours_close FROM opening_hours ORDER BY day_id";
                                $hours_result = $conn->query($hours_sql);

                                if ($hours_result->num_rows > 0) {
                                    while($row = $hours_result->fetch_assoc()) {
                                        $day = htmlspecialchars($row['day_name']);
                                        
                                        if (empty($row['hours_open']) || empty($row['hours_close'])) {
                                            $hours = "Closed";
                                        } else {
                                            // Format the time from 'HH:MM:SS' to 'H:MM am/pm'
                                            $open_time = date('g:i a', strtotime($row['hours_open']));
                                            $close_time = date('g:i a', strtotime($row['hours_close']));
                                            $hours = $open_time . " – " . $close_time;

                                            // Ensure time format is consistent with original
                                            $hours = str_replace("12:00 pm", "12:00 pm", $hours);
                                        }
                                ?>
                                    <li>
                                        <h4 class="day"><?php echo $day; ?></h4>
                                        <h4 class="hours"><?php echo $hours; ?></h4>
                                    </li>
                                <?php
                                    }
                                } else {
                                     echo '<li><h4 class="day">Hours N/A</h4><h4 class="hours">Please check back later.</h4></li>';
                                }
                                ?>
							</ul>
						</div>
					</div>
                    </div>
			</div>
		</div>
		<?php
    // Close the DB connection since it's no longer needed
    $conn->close();
	include("inc/footer.php");
	?>