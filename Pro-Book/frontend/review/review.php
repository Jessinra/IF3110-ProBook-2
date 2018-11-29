<?php global $activeNavbar; $activeNavbar=2; ?>
<!DOCTYPE html>
<html>
	<head>
		<title>Review Page</title>
		<meta content="width=device-width, initial-scale=1" name="viewport" />
		<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="/tugasbesar2_2018/Pro-Book/frontend/common_files/grid_system.css">
		<link rel="stylesheet" type="text/css" href="/tugasbesar2_2018/Pro-Book/frontend/common_files/navbar.css">
		<link rel="stylesheet" type="text/css" href="/tugasbesar2_2018/Pro-Book/frontend/review/style.css">
	</head>
	<body id="body">
		<?php include 'frontend/common_files/navbar.php' ?>
		<div class="container" id="content">
			<input type="text" class="hidden-input" id="book-id" name="book-id" value="<?php echo $book['ID'] ?>">
			<input type="text" class="hidden-input" id="order-id" name="order-id" value="<?php echo $purchase_id ?>">
			<div class="row" id="first-row">
				<div class="kolom-md-2">
				</div>
				<div class="kolom-md-4 display-block">
					<div class="display-center">
						<h1><?php echo $book['Title'] ?></h1>
						<h5><?php echo $book['Author'] ?></h5>	
					</div>		
				</div>
				<div class="kolom-md-4" id="book-image-div">
					<img id="book-image" src="<?php echo $book['Thumbnail'] ?>">
				</div>
			</div>
			<div class="row" id="second-row">
				<div class="kolom-md-2">
				</div>
				<div class="kolom-md-8">
					<h1>Add Rating</h1>
				</div>
			</div>
			<div class="row" id="third-row">
				<div class="kolom-md-2">
				</div>
				<div class="kolom-md-8">
					<div id="star-group">
						<div class="star-div" onclick="selectStar(1)">
							<img id="star1fill" class="review-star-full" src="/tugasbesar2_2018/Pro-Book/frontend/img_resource/starFull.png">
							<img id="star1" class="review-star" src="/tugasbesar2_2018/Pro-Book/frontend/img_resource/starEmpty.png">
						</div>
						<div class="star-div" onclick="selectStar(2)">
							<img id="star1fill" class="review-star-full" src="/tugasbesar2_2018/Pro-Book/frontend/img_resource/starFull.png">
							<img id="star1" class="review-star" src="/tugasbesar2_2018/Pro-Book/frontend/img_resource/starEmpty.png">
						</div>
						<div class="star-div" onclick="selectStar(3)">
							<img id="star1fill" class="review-star-full" src="/tugasbesar2_2018/Pro-Book/frontend/img_resource/starFull.png">
							<img id="star1" class="review-star" src="/tugasbesar2_2018/Pro-Book/frontend/img_resource/starEmpty.png">
						</div>
						<div class="star-div" onclick="selectStar(4)">
							<img id="star1fill" class="review-star-full" src="/tugasbesar2_2018/Pro-Book/frontend/img_resource/starFull.png">
							<img id="star1" class="review-star" src="/tugasbesar2_2018/Pro-Book/frontend/img_resource/starEmpty.png">
						</div>
						<div class="star-div" onclick="selectStar(5)">
							<img id="star1fill" class="review-star-full" src="/tugasbesar2_2018/Pro-Book/frontend/img_resource/starFull.png">
							<img id="star1" class="review-star" src="/tugasbesar2_2018/Pro-Book/frontend/img_resource/starEmpty.png">
						</div>
					</div>
				</div>
			</div>
			<div class="row" id="forth-row">
				<div class="kolom-md-2">
				</div>
				<div class="kolom-md-8">
					<h1>Add Comment</h1>
				</div>
			</div>
			<div class="row" id="fifth-row">
				<div class="kolom-md-2">
				</div>
				<div class="kolom-md-8">
					<textarea id="comment" name="comment"></textarea>
				</div>
			</div>
			<div class="row" id="sixth-row">
				<div class="kolom-md-2">
				</div>
				<div class="kolom-md-4">
					<button type="button" id="back-button" onclick="back()">Back</button>
				</div>
				<div class="kolom-md-4 align-right">
					<button type="button" id="submit-button" onclick="submit()">Submit</button>
				</div>
			</div>
		</div>
		<div id="overlay"><div id="feedback-modal"><h2>Thank you for the review</h2></div></div>
	</body>
	<script src="/tugasbesar2_2018/Pro-Book/frontend/review/script.js"></script>
</html>