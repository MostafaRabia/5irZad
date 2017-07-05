<?php
	include 'config.php';
	$result = "SELECT * FROM `audios` WHERE `type`='حديث'";
	$query = mysqli_query($link,$result);
	$rows = [];
	while ($row=mysqli_fetch_array($query)){
		$rows[] = $row;
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>الأربعين النووية</title>
	<link rel="stylesheet" type="text/css" href="resources/css/foundation.min.css"/>
	<script type="text/javascript" src="resources/js/jquery.js"></script>
	<script type="text/javascript" src="js/Del.js"></script>
	<script type="text/javascript" src="resources/js/foundation.min.js"></script>
	<script type="text/javascript" src="js/amplitude.min.js"></script>
	<script type="text/javascript" src="js/functions.js"></script>
	<link rel="icon" href="img/books.png">
	<link rel="stylesheet" type="text/css" href="css/style.css"/>
</head>
<body>
	<div class="navbar">
		<a href="/"><img src='img/Zad.png'/></a>
		<h4>تعلم فليس المرء يولد عالماً</h4>
	</div>
	<div class="row">
			<div class="large-8 medium-10 small-11 large-centered medium-centered small-centered columns" id="amplitude-player">
				<div class="row">
					<div class="large-12 medium-12 small-12 columns" id="amplitude-right">
						<?php
							foreach ($rows as $row) {
									echo '<div class="song amplitude-song-container amplitude-play-pause" amplitude-song-index="'.$row['id_audio'].'">
								<div class="song-now-playing-icon-container">
									<div class="play-button-container"></div>
									<img class="now-playing" src="img/now-playing.svg"/>
								</div>
								<span class="song-duration">'.$row['duration'].'</span>
								<div class="song-meta-data">
									<span class="song-title">'.$row['name'].'</span>
								</div>
							</div>';
							}
						?>
					</div>
					<div class="large-12 medium-12 small-12 columns" id="amplitude-left">
						<div id="player-left-bottom">
							<div id="time-container">
								<span class="current-time">
									<span class="amplitude-current-minutes" amplitude-main-current-minutes="true"></span>:<span class="amplitude-current-seconds" amplitude-main-current-seconds="true"></span>
								</span>
								<input type="range" class="amplitude-song-slider" amplitude-main-song-slider="true"/>
								<span class="duration">
									<span class="amplitude-duration-minutes" amplitude-main-duration-minutes="true"></span>:<span class="amplitude-duration-seconds" amplitude-main-duration-seconds="true"></span>
								</span>
							</div>

							<div id="control-container">
								<div id="repeat-container">
									<div class="amplitude-repeat" id="repeat"></div>
								</div>
							
								<div id="central-control-container">
									<div id="central-controls">
										<div class="amplitude-prev" id="previous"></div>
										<div class="amplitude-play-pause" amplitude-main-play-pause="true" id="play-pause"></div>
										<div class="amplitude-next" id="next"></div>
									</div>
								</div>
								
								<div id="shuffle-container">
									<div class="amplitude-shuffle amplitude-shuffle-off" id="shuffle"></div>
								</div>
							</div>
							
							<div id="meta-container">
								<span amplitude-song-info="name" amplitude-main-song-info="true" class="song-name"></span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	<script type="text/javascript">
		Amplitude.init({
			"songs": [
						{},
				<?php
					foreach ($rows as $row) {
						echo '{
								"name": "'.$row['name'].'",
								"url": "'.$row['url'].'"},';
					}
				?>
			]
		});	
	</script>
</body>
</html>