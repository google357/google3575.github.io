<?php
// Start session to access session variables
session_start();

// Check if user is logged in, if not redirect to login page
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

// Get user's email from session
$email = $_SESSION['email'];

// Load user data from JSON file
$users = json_decode(file_get_contents('users.json'), true);

// Check if user exists in the data
if (isset($users[$email])) {
    $user_id = $users[$email]['user_id']; // Assuming user_id exists
    $username = $users[$email]['username'];
    $balance = $users[$email]['balance'];
} else {
    // If user doesn't exist (unlikely if they reached this page after successful login),
    // redirect to login page
    header("Location: login.php");
    exit();
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" type="text/css" href="styles.css">
	<title>Form Reviews</title>
</head>
<body>

	<div class="wrapper">
		<h3>👏 Send Feedback !!!</h3>
		<?php echo $user_id; ?>
		<form action="process_form.php" method="POST">
		    <div class="rating">
				<input type="number" name="rating" hidden>
				<i class='bx bx-star star' style="--i: 0;"></i>
				<i class='bx bx-star star' style="--i: 1;"></i>
				<i class='bx bx-star star' style="--i: 2;"></i>
				<i class='bx bx-star star' style="--i: 3;"></i>
				<i class='bx bx-star star' style="--i: 4;"></i>
			</div>
			<textarea name="opinion" cols="30" rows="5" placeholder="Your opinion..."></textarea>
			<div class="btn-group">
				<button type="submit" class="btn submit">Submit</button>
				<button type="button" class="btn cancel" onclick="window.history.back();">Cancel</button>
			</div>
		</form>
	</div>
    <script src="script.js"></script>
</body>
</html>
