<?php
session_start();
if(isset($_SESSION["Email"]) || $_SESSION['loggedin'] == true) {
  $username = $_SESSION['Email'];

  $conn = new mysqli("localhost","root", "", "website");
  // Check connection
  if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  $result = $conn-> query("SELECT * FROM user_login");


  while($row = $result -> fetch_array(MYSQLI_ASSOC)) {
    if($row["Email"] == $username) {
      $firstname = $row['FirstName'];
      $lastname = $row['LastName'];
      $email = $row['Email'];
      $email2 = $row['Email2'];
      $phone = $row['Phone'];
      $country = $row['Country'];
      $region = $row['Region'];
      $city = $row['City'];
      $level = $row['Level'];
      $school = $row['School'];
      $program = $row['Program'];
      $year = $row['Year'];
      $gpa = $row['GPA'];
      if ($row['Experience1'] != "NULL") {
        $experience1 = unserialize($row['Experience1']);
        echo "Fuck";
      }
      if (!is_null($row['Skill1'])) {
        $skill1 = unserialize($row['Skill1']);
      }
      $award1 = $row['Award1'];
      $position1 = $row['Position1'];
      $type = $row['Type1'];
      $remote = $row['Remote'];
      $image = $row['Image'];
      if(!empty($image)) {
        $profilepic = "img/".$image;
      }
      else {
        $profilepic = "img/defaultprofile.PNG";
      }
      //echo $profilepic;

      //echo $row['Image'];
      $bio = $row['Bio'];
    }
  }

}
?>
<html>
  <head>
    <meta charset = "UTF-8">
    <meta name = "description" content = "This is my first experimental website">

    <title>First Website</title>
    <link rel = "stylesheet" href = "styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Yanone+Kaffeesatz&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

  </head>
  <body>
    <div class="topnav">
      <a href="searchresults.php">Search</a>
      <a href="messages.html">Messages</a>
      <a class="active" href="editprofile.php">Profile</a>
      <a href="logout.php">Logout</a>
    </div>
    <div class = "bottomnav">
      <a class = "active" href="editprofile.php">Edit Profile</a>
      <a href="viewprofile.php">View Profile</a>
    </div>

    <div class="profilecontainer">

      <form action="saveprofile.php" method = "POST" enctype='multipart/form-data' class="form" id = "editprofileform">
        <script>
         var numskills = 1;
         var numexperience = 1;
         var numawards = 1;
         var numpositions = 1;
        </script>
        <h1 class = "editprofiletitle">Edit Profile</h1>

          <h3 class = "basicinfotitle">Basic Information</h3>

          <div class = "profileimage">
            <div class = "changeimage">
              <div class = "showimage">
                <img src="<?php echo $profilepic; ?>" height="200" width="200" border-radius="50%" background-color="white" class="imgthumbnail" />
                <div class="overlay"></div>
              </div>
              <div class = "imagefile">
                <label for="fileupload" class="customfileupload">
                  <i class="fa fa-cloud-upload" class = "customfileupload"></i> Change Image
                </label>
                <input id="fileupload" type="file" name = "image"/>
              </div>
            </div>
            <div class = "bio">
              <textarea type = "text" id = "bio" name = "Bio" placeholder = "Write a short introduction about yourself in 200 characters maximum. What opportunities are you looking for?" maxlength = 200><?php print isset($bio) ? $bio : ''; ?></textarea>
            </div>
            <div class="clear"></div>
          </div>
          <style type="text/css">
            .clear{clear:both;}
          </style>
          <div class = "basicinfo">
            <font size = "20">
            <table>
              <font size = 15>
              <tr>
                <td>First Name: </td>
                <td>
                   <input type="text" class="firstname" name = 'FirstName' value="<?php print isset($firstname) ? $firstname : ''; ?>">
                </td>

                <td>Last Name: </td>
                <td>
                   <input type="text" class="lastname" name = 'LastName' value="<?php print isset($lastname) ? $lastname : ''; ?>">
                </td>
              </tr>

              <tr>
                <td>Phone Number: </td>
                <td>
                  <input type="text" class="phonenumber" name = 'Phone' placeholder="Phone Number" value="<?php print isset($phone) ? $phone : ''; ?>">
                </td>
                <td>Email: </td>
                <td>
                  <input type="text" class="email" name = 'Email' value="<?php print isset($email) ? $email : ''; ?>">
                </td>
              </tr>

              <tr>
                <td>Country: </td>
                <td>
                  <input type="text" class="country" name = 'Country' placeholder="Country" value="<?php print isset($country) ? $country : ''; ?>">
                </td>
              </tr>
              <tr>
                <td>State/Region: </td>
                <td>
                  <input type="text" class="stateregion" name = 'Region' placeholder="State / Region" value="<?php print isset($region) ? $region : ''; ?>">
                </td>
              </tr>
              <tr>
                <td>City / Town: </td>
                <td>
                  <input type="text" class="citytown" name = 'City' placeholder="City / Town" value="<?php print isset($city) ? $city : ''; ?>">
                </td>
              </tr>
              </font>
            </table>
          </font>
          </div>
          <!--Education Section-->
          <h3 class = "educationtitle">Education</h3>
          <table class = "edu">
              <tr>
                <td>
                  <label for="lev">Education Level: </label>
                </td>
                <td>
                  <?php
                    if (is_null($level) or empty($level)) {
                  ?>
                  <select id="lev" name="Level">
                    <option value="NULL">Select</option>
                    <option value="1">High School</option>
                    <option value="2">Associates</option>
                    <option value="3">Bachelor's</option>
                    <option value="4">Master's</option>
                    <option value="5">Doctorate</option>
                  </select>
                  <?php } else {?>
                  <select id="lev" name="Level">
                    <option value="NULL"<?php if ($level== "NULL"): ?> selected="selected"<?php endif; ?>>Select</option>
                    <option value="1"<?php if ($level== "1"): ?> selected="selected"<?php endif; ?>>High School</option>
                    <option value="2"<?php if ($level== "2"): ?> selected="selected"<?php endif; ?>>Associates</option>
                    <option value="3"<?php if ($level== "3"): ?> selected="selected"<?php endif; ?>>Bachelor's</option>
                    <option value="4"<?php if ($level== "4"): ?> selected="selected"<?php endif; ?>>Master's</option>
                    <option value="5"<?php if ($level== "5"): ?> selected="selected"<?php endif; ?>>Doctorate</option>
                  </select>
                  <?php } ?>
                </td>
              </tr>
              <tr>
                <td>School: </td>
                <td>
                  <input type="text" class="school" name = 'School' placeholder="School" value="<?php print isset($school) ? $school : ''; ?>"/>
                </td>
              </tr>
              <tr>
                <td>Program / Major: </td>
                <td>
                  <input type="text" class="program" name = 'Program' placeholder="Program / Major" value="<?php print isset($program) ? $program : ''; ?>"/>
                </td>
              </tr>
              <tr>
                <td>
                  <label for="yr">Current Year of Study: </label>
                </td>
                <td>
                  <?php
                    if ($year == 0) {
                  ?>
                  <select id="yr" name="Year">
                    <option value="0">Select</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">Graduated</option>
                  </select>
                  <?php } else {?>
                  <select id="yr" name="Year">
                    <option value="0"<?php if ($year== "NULL"): ?> selected="selected"<?php endif; ?>>Select</option>
                    <option value="1"<?php if ($year== "1"): ?> selected="selected"<?php endif; ?>>1</option>
                    <option value="2"<?php if ($year== "2"): ?> selected="selected"<?php endif; ?>>2</option>
                    <option value="3"<?php if ($year== "3"): ?> selected="selected"<?php endif; ?>>3</option>
                    <option value="4"<?php if ($year== "4"): ?> selected="selected"<?php endif; ?>>4</option>
                    <option value="5"<?php if ($year== "5"): ?> selected="selected"<?php endif; ?>>5</option>
                    <option value="6"<?php if ($year== "6"): ?> selected="selected"<?php endif; ?>>6</option>
                    <option value="7"<?php if ($year== "0"): ?> selected="selected"<?php endif; ?>>Graduated</option>
                  </select>
                  <?php } ?>
                </td>
              </tr>
              <tr>
                <td>GPA: </td>
                <td>
                  <input type="text" class="gpa" name = 'GPA' placeholder="GPA / 4.00" value="<?php print $gpa != 0 ? $gpa : ''; ?>">
                </td>
              </tr>

          </table>

          <!--Skill Section-->
          <h3 class = "skillstitle">Skills</h3>
          <table class = "skills" id = "skills">
            <tr>
              <td>Skill</td>
              <td>Years Experience</td>
            </tr>
            <tr>
              <td>
                <input type="text" class="skill" name = "Skill[]" value = "<?php print isset($skill1->skill) ? $skill1->skill : ''; ?>"placeholder="Skill"/>
              </td>
              <td>
                <input type="number" class="skill" name = "YearsExp[]" value = "<?php print isset($skill1->year) ? $skill1->year : ''; ?>"placeholder="Years of Experience" max="100" min = "0"/>
              </td>
              <td>
                <button type="button" class="button addskill">New Skill</button>
              </td>
            </tr>
            <?php
            $skll = $conn->query("SELECT Email, Skill2, Skill3, Skill4, Skill5, Skill6, Skill7 FROM user_login");
            while($row = $skll -> fetch_array(MYSQLI_NUM)) {
              if($row[0] == $email) {
                for ($i = 1; $i < 7; $i++) {
                  if (is_null($row[$i]) or empty($row[$i])) {
                    continue;
                  }
                  else { ?>
                    <script>
                    $("#skills").append('<tr><td><input type="text" class="skill" name = "Skill[]" value = "<?php print isset(unserialize($row[$i])->skill) ? unserialize($row[$i])->skill : ''; ?>" placeholder="Skill"/><td><input type="number" class="skill" name = "YearsExp[]" value = "<?php print isset(unserialize($row[$i])->year) ? unserialize($row[$i])->year : ''; ?>"placeholder="Years of Experience" max="100" min = "0"/><td><input type = "button" value="Delete" onclick="deleteskill()"></tr>');
                    numskills++;
                </script>
        <?php }
            }
          }
        }
            ?>
            <script>
              $('.addskill').click(function() {

                if (numskills < 7) {
                  $("#skills").append('<tr><td><input type="text" class="skill" name = "Skill[]" placeholder="Skill"/><td><input type="number" class="skill" name = "YearsExp[]" placeholder="Years of Experience" max="100" min = "0"/><td><input type = "button" value="Delete" onclick="deleteskill()"></tr>');
                  numskills++;
                }
              });
              function deleteskill() {
                var td = event.target.parentNode;
                var tr = td.parentNode; // the row to be removed
                tr.parentNode.removeChild(tr);
                numskills--;
              }
            </script>
          </table>

          <!--Experience Section-->
          <h3 class = "experiencetitle">Experience</h3>
          <table class = "experience" id = "experience">
            <tr>
              <td>
                <input type="text" class="role" name = 'Role[]' value = "<?php print isset($experience1->role) ? $experience1->role : ''; ?>" placeholder="Role"/>
              </td>
              <td>
                <input type="text" class="company" name = 'Company[]' value = "<?php print isset($experience1->company) ? $experience1->company : ''; ?>" placeholder="Company"/>
              </td>
              <td>
                <button type="button" class="button addexperience">New Experience</button>
              </td>
            </tr>
            <tr>
              <td>I currently work here</td>
              <td><input type="checkbox" name = "Current[]" class = "currentcheckbox" value = "1" <?php print (isset($experience1->end) and ($experience1->end == "1")) ? "checked" : ''; ?>></td>
            </tr>
            <tr>
              <td>Start Date:</td>
              <td>
                <input type="date" name = 'StartDate[]' value = "<?php print isset($experience1->start) ? $experience1->start : ''; ?>"/>
              </td>
            </tr>
            <tr id="enddaterow[]">
              <td>End Date:</td>
              <td>
                <input type="date" name = 'EndDate[]' value = "<?php print isset($experience1->end) ? $experience1->end : ''; ?>" placeholder="End Date"/>
              </td>
            </tr>
            <?php

              #Role1, Company1, Start1, End1, Role2, Company2, Start2, End2, Role3, Company3, Start3, End3,
            $exp = $conn->query("SELECT Email, Experience2, Experience3, Experience4, Experience5 FROM user_login");
            while($row = $exp -> fetch_array(MYSQLI_NUM)) {

              if($row[0] == $email) {
                for ($i = 1; $i < 5; $i++) {

                  if (is_null($row[$i]) or empty($row[$i])) {
                    continue;
                  }
                  else { ?>
                    <script>
                    $("#experience").append('<tr class="blank_row"><td bgcolor="azure" colspan="3">&nbsp;</tr>');
                    $("#experience").append('<tr class="blank_row"><td bgcolor="azure" colspan="3">&nbsp;</tr>');
                    $("#experience").append('<tr><td><input type="text" class="role" name = "Role[]" value = "<?php print isset(unserialize($row[$i])->role) ? unserialize($row[$i])->role : ''; ?>" placeholder="Role"/><td><input type="text" class="company" name = "Company[]" value = "<?php print isset(unserialize($row[$i])->company) ? unserialize($row[$i])->company : ''; ?>"placeholder="Company"/><td><input type = "button" value="Delete" onclick="deleteexperience()"></tr>');
                    $("#experience").append('<tr><td>I currently work here<td><input type="checkbox" name="Current[]" class = "currentcheckbox" value = "1" <?php print (isset(unserialize($row[$i])->end) and unserialize($row[$i])->end == "1") ? "checked" : ''; ?>></tr>');
                    $("#experience").append('<tr><td>Start Date<td><input type="date" class="start" name = "StartDate[]" value = "<?php print isset(unserialize($row[$i])->start) ? unserialize($row[$i])->start : ''; ?>" placeholder="Start Date"/></tr>');
                    $("#experience").append('<tr id="enddaterow[]"><td>End Date<td><input type="date" class="end" name = "EndDate[]" value = "<?php print (isset(unserialize($row[$i])->end) and unserialize($row[$i])->end != "1") ? unserialize($row[$i])->end : ''; ?>" placeholder="End Date"/>');
                    numexperience++;
                </script>
        <?php }
            }
          }
        }
            ?>
            <script>
            $('.addexperience').click(function() {
              if (numexperience < 5) {
                $("#experience").append('<tr class="blank_row"><td bgcolor="azure" colspan="3">&nbsp;</tr>');
                $("#experience").append('<tr class="blank_row"><td bgcolor="azure" colspan="3">&nbsp;</tr>');
                $("#experience").append('<tr><td><input type="text" class="role" name = "Role[]" placeholder="Role"/> <td><input type="text" class="company" name = "Company[]" placeholder="Company"/><td><input type = "button" value="Delete" onclick="deleteexperience()"></tr>');
                $("#experience").append('<tr><td>I currently work here<td><input type="checkbox" name="Current[]" class = "currentcheckbox" value = "1"></tr>');
                $("#experience").append('<tr><td>Start Date <td><input type="date" class="start" name = "StartDate[]" placeholder="Start Date"/></tr>');
                $("#experience").append('<tr id="enddaterow[]"><td>End Date <td><input type="date" class="end" name = "EndDate[]" placeholder="End Date"/></tr>');
                numexperience++;
              }
             });
             function deleteexperience() {
               for (let i = 0; i < 6; i++) {
                 document.getElementById("experience").deleteRow((numexperience - 1) * 6 - 2);
               }
               numexperience--;
             }
            </script>
          </table>

          <!--Awards Section-->
          <h3 class = "awardstitle">Awards</h3>
          <table class = "awards" id = "awards">
            <tr>
              <td>
                <input type="text" class="award" name = "Award[]" value = "<?php print isset($award1) ? $award1 : ''; ?>"placeholder="Award"/>
              </td>

              <td>
                <button type="button" class="button addaward">New Award</button>
              </td>
            </tr>
            <?php
            $awrd = $conn->query("SELECT Email, Award2, Award3, Award4, Award5, Award6, Award7 FROM user_login");
            while($row = $skll -> fetch_array(MYSQLI_NUM)) {
              if($row[0] == $email) {
                for ($i = 1; $i < 7; $i++) {
                  if (is_null($row[$i]) or empty($row[$i])) {
                    continue;
                  }
                  else { ?>
                    <script>
                    $("#awards").append('<tr><td><input type="text" class="award" name = "Award[]" value = "<?php print isset($row[$i]) ? $row[$i] : ''; ?>" placeholder="Award"/><td><input type = "button" value="Delete" onclick="deleteaward()"></tr>');
                    numawards++;
                </script>
        <?php }
            }
          }
        }
            ?>
            <script>
              $('.addaward').click(function() {

                if (numawards < 7) {
                  $("#awards").append('<tr><td><input type="text" class="award" name = "Award[]" placeholder="Award"/><td><input type = "button" value="Delete" onclick="deleteaward()"></tr>');
                  numawards++;
                }
              });
              function deleteaward() {
                var td = event.target.parentNode;
                var tr = td.parentNode; // the row to be removed
                tr.parentNode.removeChild(tr);
                numawards--;
              }
            </script>
          </table>

          <!--Positions Seeking Section-->
          <h3 class = "positiontitle">Position Seeking</h3>
          <table class = "position" id = "position">
            <tr>
              <td>
                <input type="text" class="position" name = "Position[]" value = "<?php print isset($position1) ? $position1 : ''; ?>" placeholder="Position"/>
              </td>
              <td>
                <?php
                  if (is_null($type)) {
                ?>
                <select id="type" name="Type[]">
                  <option value="NULL" disabled selected>Select</option>
                  <option value="Full Time">Full Time</option>
                  <option value="Part Time">Part Time</option>
                  <option value="Casual">Casual</option>
                  <option value="Temporary">Temporary</option>
                  <option value="Seasonal">Seasonal</option>
                  <option value="Internship">Internship</option>
                  <option value="Contract">Contract</option>
                </select>
                <?php } else {?>
                <select id="yr" name="Type[]">
                  <option value="NULL"<?php if ($type== "NULL"): ?> selected="selected"<?php endif; ?>>Select</option>
                  <option value="Full Time"<?php if ($type== "Full Time"): ?> selected="selected"<?php endif; ?>>Full Time</option>
                  <option value="Part Time"<?php if ($type== "Part Time"): ?> selected="selected"<?php endif; ?>>Part Time</option>
                  <option value="Casual"<?php if ($type== "Casual"): ?> selected="selected"<?php endif; ?>>Casual</option>
                  <option value="Temporary"<?php if ($type== "Temporary"): ?> selected="selected"<?php endif; ?>>Temporary</option>
                  <option value="Seasonal"<?php if ($type== "Seasonal"): ?> selected="selected"<?php endif; ?>>Seasonal</option>
                  <option value="Internship"<?php if ($type== "Internship"): ?> selected="selected"<?php endif; ?>>Internship</option>
                  <option value="Contract"<?php if ($type== "Contract"): ?> selected="selected"<?php endif; ?>>Contract</option>
                </select>
                <?php } ?>
              </td>
              <td>
                <button type="button" class="button addposition">New Position</button>
              </td>
            </tr>

            <?php
            $pstn = $conn->query("SELECT Position2, Position3, Type2, Type3 FROM user_login");
            while($row = $skll -> fetch_array(MYSQLI_NUM)) {
              if($row[0] == $email) {
                for ($i = 1; $i < 3; $i++) {
                  if (empty($row[$i]) and empty($row[$i + 2])) {
                    continue;
                  }
                  else { ?>
                  <script>
                    $("#position").append('<tr><td><input type="text" class="position" name = "Position[]" value = "<?php print isset($row[$i]) ? $row[$i] : ''; ?>" placeholder="Position"/><td><?php if (is_null($row[$i + 2])) {?><select id="type" name="Type[]"><option value="NULL" disabled selected>Select</option><option value="Full Time">Full Time</option><option value="Part Time">Part Time</option><option value="Casual">Casual</option><option value="Temporary">Temporary</option><option value="Seasonal">Seasonal</option><option value="Internship">Internship</option><option value="Contract">Contract</option></select><?php } else {?><select id="type" name="Type[]"><option value="NULL"<?php if ($row[$i + 2]== "NULL"): ?> selected="selected"<?php endif; ?>>Select</option><option value="Full Time"<?php if ($row[$i + 2]== "Full Time"): ?> selected="selected"<?php endif; ?>>Full Time</option><option value="Part Time"<?php if ($row[$i + 2]== "Part Time"): ?> selected="selected"<?php endif; ?>>Part Time</option><option value="Casual"<?php if ($row[$i + 2]== "Casual"): ?> selected="selected"<?php endif; ?>>Casual</option><option value="Temporary"<?php if ($row[$i + 2]== "Temporary"): ?> selected="selected"<?php endif; ?>>Temporary</option><option value="Seasonal"<?php if ($row[$i + 2]== "Seasonal"): ?> selected="selected"<?php endif; ?>>Seasonal</option><option value="Internship"<?php if ($row[$i + 2]== "Internship"): ?> selected="selected"<?php endif; ?>>Internship</option><option value="Contract"<?php if ($row[$i + 2]== "Contract"): ?> selected="selected"<?php endif; ?>>Contract</option></select><?php } ?><td><input type = "button" value="Delete" onclick="deleteposition()"></tr>');
                    numpositions++;
                  </script>
        <?php }
            }
          }
        }
            ?>
            <script>
              $('.addposition').click(function() {

                if (numpositions < 3) {
                  $("#position").append('<tr><td><input type="text" class="position" name = "Position[]" placeholder="Position"/><td><select id="type" name="Type[]"><option value="NULL" disabled selected>Select</option><option value="Full Time">Full Time</option><option value="Part Time">Part Time</option><option value="Casual">Casual</option><option value="Temporary">Temporary</option><option value="Seasonal">Seasonal</option><option value="Internship">Internship</option><option value="Contract">Contract</option></select><td><input type = "button" value="Delete" onclick="deleteposition()"></tr>');
                  numpositions++;
                }
              });
              function deleteposition() {
                var td = event.target.parentNode;
                var tr = td.parentNode; // the row to be removed
                tr.parentNode.removeChild(tr);
                numpositions--;
              }
            </script>
          </table>
          <table class = "remoteornah">
            <tr>
              <td>Remote or In-Person?</td>
                <td>
                <?php
                if (is_null($remote)) {
              ?>
              <select id="remote" name="Remote">
                <option value="NULL" disabled selected>Select</option>
                <option value="1">Remote Only</option>
                <option value="2">In-Person Only</option>
                <option value="3">Both</option>

              </select>
              <?php } else {?>
              <select id="yr" name="Type[]">
                <option value="NULL"<?php if ($remote == "NULL"): ?> selected="selected"<?php endif; ?>>Select</option>
                <option value="1"<?php if ($remote == "1"): ?> selected="selected"<?php endif; ?>>Remote Only</option>
                <option value="2"<?php if ($remote == "2"): ?> selected="selected"<?php endif; ?>>In-Person Only</option>
                <option value="3"<?php if ($remote == "3"): ?> selected="selected"<?php endif; ?>>Both</option>

              </select>
              <?php } ?>
              </td>
            </tr>
          </table>
          <!--Save Profile-->
          <div style="text-align:center">
              <input id = "saveprofile" type="submit" value="Save Profile" name="saveprofile" onclick="submitted()">
          </div>
        </div>
      </form>
    </div>
  </body>

</html>
<?php
$result -> free_result();
$exp->free_result();
$awrd->free_result();
$pstn->free_result();
$skll->free_result();
$conn -> close();
?>
