<?php
session_start();
if(isset($_SESSION["Email"]) || $_SESSION['loggedin'] == true) {
  $username = $_SESSION['Email'];

  $conn = new mysqli("localhost","root", "", "website");
  // Check connection
  if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  $sql = "SELECT * FROM position";
  if ($result = $conn-> query($sql)) {
    $numcolumns = $result->field_count;
  }

  $postinglist = array();
  $postingcount = 0;
  while($row = $result -> fetch_array(MYSQLI_NUM)) {
    if($row[0] == $username) {
      for ($i = 26; $i < $numcolumns; $i++) {
        if ($row[$i] != "NULL" or !is_null($row[$i])) {
          array_push($postinglist, $row[$i]);
          $postingcount++;
        }
      }
    }
  }
}?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset = "UTF-8">
    <meta name = "description" content = "This is my first experimental website">

    <title>First Website</title>
    <link rel = "stylesheet" href = "styles.css">

    <link rel = "stylesheet" href = "styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Yanone+Kaffeesatz&display=swap" rel="stylesheet">
  </head>
  <body>
    <div class="topnav">
      <a href="search.php">Search</a>
      <a class="active" href="messages.php">Messages</a>
      <a href="editprofile.php">Profile</a>
      <a href="logout.php">Logout</a>
    </div>
    <div class = "postings">
      <h1 class = "postingstitle">Your Postings</h1>
      <?php
      $i = 0;
      for ($i = 0; $i < $postingcount - 1; $i++) {?>
        <div class = "postingcard">
          <h2 class = "postingtitle"><?php echo unserialize($postinglist[$i])->position." at ".unserialize($postinglist[$i])->company;?></h2>
        </div>
<?php } ?>
    </div>
  </body>
</html>
<?php
$result->close();
$conn->close();
?>