<?php if ($check == 1000) {
	echo "<p> Fill in the form correnctly </p>";
}
else {
	echo "<p> User Created </p>";
}

echo $msg;

header("Location: /auths/login");
?>
