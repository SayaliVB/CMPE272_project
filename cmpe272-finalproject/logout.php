<?php
// Initialize the session
session_start();

//script to send the logout message to children iframe
echo "<script>
function sendMessage(message) {
  const iframe = document.querySelectorAll('iframe');
  iframe.forEach(element => {
    element.contentWindow.postMessage(message, '*');
  });
}
function sendLogoutMessage(user_id){
  sendMessage({type: 'logout', user_id: user_id});
}
</script>";

// Unset all of the session variables
$id = $_SESSION['id'];
$_SESSION = array();

echo "<script>sendLogoutMessage($id)</script>";
// Destroy the session.
session_destroy();

// Redirect to login page
header("location: login.php");
exit;
?>
