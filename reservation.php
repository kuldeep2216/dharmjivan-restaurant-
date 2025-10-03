<?php
	include("inc/header.php");
?>
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
							// Include DB config if not already included
							if (!isset($conn)) {
								include("db_config.php"); 
								$close_conn = true;
							} else {
								$close_conn = false;
							}

							// Fetch hours from the new database table
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

										// Revert the 12:00 pm to its original '12:00 pm' format as per your hardcoded source
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

							if ($close_conn) {
								$conn->close();
							}
							?>
						</ul>
					</div>
				</div>
					</div>
				</div>
			</div>
		<?php
	include("inc/footer.php");
	?>