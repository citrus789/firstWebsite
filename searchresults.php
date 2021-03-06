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
  $result = $conn-> query($sql);


  while($row = $result -> fetch_array(MYSQLI_ASSOC)) {
    if($row["Email"] == $username) {
      $recposition = $row["Position"];
      $rectype = $row["Type"];
      $recskill1 = $row["Skill1"];
      $recskill2 = $row["Skill2"];
      $recskill3 = $row["Skill3"];
      $recskill4 = $row["Skill4"];
      $recskill5 = $row["Skill5"];
      $skillyear1 = $row["Years1"];
      $skillyear2 = $row["Years2"];
      $skillyear3 = $row["Years3"];
      $skillyear4 = $row["Years4"];
      $skillyear5 = $row["Years5"];
      $recdate = $row["Start"];
      $reclevel = $row["Level"];
      $recyear = $row["Year"];
      $recprog1 = $row["Program1"];
      $recprog2 = $row["Program2"];
      $recprog3 = $row["Program3"];
      $recgpa = $row["GPA"];
      $recremote = $row["Remote"];
      if ($recremote == 3) {
        $recaddress = $row["Address"];
        $reccity = $row["City"];
        $recregion = $row["Region"];
        $reccountry = $row["Country"];
      }
      $previousmessage = $row['SentMessage'];
      $previousmessage = unserialize($previousmessage);
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
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <link rel = "stylesheet" href = "styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Yanone+Kaffeesatz&display=swap" rel="stylesheet">
  </head>
  <body>
    <header>

      <a href="home.html"><button class = "homebutton">Home</button></a>
      <nav>
        <ul class = "topnavlinks">
          <li><a class="active" href="search.php">Search</a></li>
          <li><a href="messages.php">Postings</a></li>
          <li><a href="editprofile.php">Profile</a></li>
        </ul>
      </nav>
      <a href="logout.php"><button class = "logoutbutton">Logout</button></a>

    </header>
    <div class = "searchresultscontainer">
      <form action="savesearch.php" method = "POST" class = "previoussearch"> <!--previous search form-->
        <div class = "previoussearchmaincontainer">
          <div class = "previoussearchcontainer">
            <div style = "height: auto; width: auto;">
              <h3 class = "recjob">Position</h3>
              <table>

                <tr>
                  <td>Position: </td>
                  <td><input type = "search" name = "recposition" placeholder = "Position" value="<?php print isset($recposition) ? $recposition : ''; ?>"></td>
                </tr>
                <tr>
                  <td>Type: </td>
                  <td>
                    <?php
                      if (is_null($rectype) or empty($rectype)) {
                    ?>
                    <select id="rectype" name="rectype">
                      <option value="NULL">Select</option>
                      <option value="Full Time">Full Time</option>
                      <option value="Part Time">Part Time</option>
                      <option value="Casual">Casual</option>
                      <option value="Temporary">Temporary</option>
                      <option value="Seasonal">Seasonal</option>
                      <option value="Internship">Internship</option>
                      <option value="Contract">Contract</option>
                    </select>
                    <?php } else {?>
                    <select id="rectype" name="rectype">
                      <option value="NULL"<?php if ($rectype== "NULL"): ?> selected="selected"<?php endif; ?>>Select</option>
                      <option value="Full Time"<?php if ($rectype== "Full Time"): ?> selected="selected"<?php endif; ?>>Full Time</option>
                      <option value="Part Time"<?php if ($rectype== "Part Time"): ?> selected="selected"<?php endif; ?>>Part Time</option>
                      <option value="Casual"<?php if ($rectype== "Casual"): ?> selected="selected"<?php endif; ?>>Casual</option>
                      <option value="Temporary"<?php if ($rectype== "Temporary"): ?> selected="selected"<?php endif; ?>>Temporary</option>
                      <option value="Seasonal"<?php if ($rectype== "Seasonal"): ?> selected="selected"<?php endif; ?>>Seasonal</option>
                      <option value="Internship"<?php if ($rectype== "Internship"): ?> selected="selected"<?php endif; ?>>Internship</option>
                      <option value="Contract"<?php if ($rectype== "Contract"): ?> selected="selected"<?php endif; ?>>Contract</option>
                    </select>
                    <?php } ?>
                  </td>
                </tr>
                <tr class="blank_row"><td bgcolor="lightblue" colspan="3">&nbsp;</tr>
                  <td>Skills</td>
                  <td>Minumum Years Experience</td>
                </tr>
                <tr>
                  <td><input type = "search" name = "recskill1" placeholder = "Skill 1" value="<?php print isset($recskill1) ? $recskill1 : ''; ?>"></td>
                  <td><input type = "number" name = "skillyear1" placeholder = "Years of Experience" value="<?php print isset($skillyear1) ? $skillyear1 : ''; ?>"></td>
                </tr>
                <tr>
                  <td><input type = "search" name = "recskill2" placeholder = "Skill 2" value="<?php print isset($recskill2) ? $recskill2 : ''; ?>"></td>
                  <td><input type = "number" name = "skillyear2" placeholder = "Years of Experience" value="<?php print isset($skillyear2) ? $skillyear2 : ''; ?>"></td>

                </tr>
                <tr>
                  <td><input type = "search" name = "recskill3" placeholder = "Skill 3" value="<?php print isset($recskill3) ? $recskill3 : ''; ?>"></td>
                  <td><input type = "number" name = "skillyear3" placeholder = "Years of Experience" value="<?php print isset($skillyear3) ? $skillyear3 : ''; ?>"></td>

                </tr>
                <tr>
                  <td><input type = "search" name = "recskill4" placeholder = "Skill 4" value="<?php print isset($recskill4) ? $recskill4 : ''; ?>"></td>
                  <td><input type = "number" name = "skillyear4" placeholder = "Years of Experience" value="<?php print isset($skillyear4) ? $skillyear4 : ''; ?>"></td>

                </tr>
                <tr>
                  <td><input type = "search" name = "recskill5" placeholder = "Skill 5" value="<?php print isset($recskill5) ? $recskill5 : ''; ?>"></td>
                  <td><input type = "number" name = "skillyear5" placeholder = "Years of Experience" value="<?php print isset($skillyear5) ? $skillyear5 : ''; ?>"></td>

                </tr>
                <tr class="blank_row"><td bgcolor="lightblue" colspan="3">&nbsp;</tr>

                <tr>
                  <td>Starting Date:</td>
                  <td><input type = "date" name = "recdate" value = "<?php print isset($recdate) ? $recdate : ''; ?>"></td>
                </tr>

              </table>
            </div>
            <div class = previouseducation style = "height: auto; width: auto;">
              <h3 class = "receducation">Education</h3>
              <table>
                <tr>
                  <td>Minimum Education: </td>
                  <td>
                    <?php
                      if (is_null($reclevel) or empty($reclevel)) {
                    ?>
                    <select id="lev" name="reclevel">
                      <option value="" disabled selected>Select</option>
                      <option value="1">High School</option>
                      <option value="2">Associates</option>
                      <option value="3">Bachelor's</option>
                      <option value="4">Master's</option>
                      <option value="5">Doctorate</option>
                    </select>
                    <?php } else {?>
                    <select id="lev" name="reclevel">
                      <option value=""<?php if ($reclevel== ""): ?> selected="selected"<?php endif; ?>>Select</option>
                      <option value="1"<?php if ($reclevel== "1"): ?> selected="selected"<?php endif; ?>>High School</option>
                      <option value="2"<?php if ($reclevel== "2"): ?> selected="selected"<?php endif; ?>>Associates</option>
                      <option value="3"<?php if ($reclevel== "3"): ?> selected="selected"<?php endif; ?>>Bachelor's</option>
                      <option value="4"<?php if ($reclevel== "4"): ?> selected="selected"<?php endif; ?>>Master's</option>
                      <option value="5"<?php if ($reclevel== "5"): ?> selected="selected"<?php endif; ?>>Doctorate</option>
                    </select>
                    <?php } ?>
                  </td>
                </tr>
                <tr>
                  <td>Year:</td>
                  <td>
                    <?php
                      if ($recyear == 0) {
                    ?>
                    <select id="yr" name="recyear">
                      <option value="0" disabled selected>Select</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                      <option value="5">5</option>
                      <option value="6">6</option>
                      <option value="7">Graduated</option>
                    </select>
                    <?php } else {?>
                    <select id="yr" name="recyear">
                      <option value="0"<?php if ($recyear== "0"): ?> selected="selected"<?php endif; ?>>Select</option>
                      <option value="1"<?php if ($recyear== "1"): ?> selected="selected"<?php endif; ?>>1</option>
                      <option value="2"<?php if ($recyear== "2"): ?> selected="selected"<?php endif; ?>>2</option>
                      <option value="3"<?php if ($recyear== "3"): ?> selected="selected"<?php endif; ?>>3</option>
                      <option value="4"<?php if ($recyear== "4"): ?> selected="selected"<?php endif; ?>>4</option>
                      <option value="5"<?php if ($recyear== "5"): ?> selected="selected"<?php endif; ?>>5</option>
                      <option value="6"<?php if ($recyear== "6"): ?> selected="selected"<?php endif; ?>>6</option>
                      <option value="7"<?php if ($recyear== "7"): ?> selected="selected"<?php endif; ?>>Graduated</option>
                    </select>
                    <?php } ?>
                  </td>
                </tr>
                <tr>
                  <td>Top 3 Program / Major: </td>
                  <td><input type = "search" name = "recprog1" placeholder = "1" value="<?php print isset($recprog1) ? $recprog1 : ''; ?>"></td>
                </tr>
                <tr>
                  <td></td>
                  <td><input type = "search" name = "recprog2" placeholder = "2" value="<?php print isset($recprog2) ? $recprog2 : ''; ?>"></td>
                </tr>
                <tr>
                  <td></td>
                  <td><input type = "search" name = "recprog3" placeholder = "3" value="<?php print isset($recprog3) ? $recprog3 : ''; ?>"></td>
                </tr>
                <tr>
                  <td>Minimum GPA:</td>
                  <td><input type = "search" name = "recgpa" placeholder = "GPA / 4.00" value="<?php print isset($recgpa) ? $recgpa : ''; ?>"></td>
                </tr>
              </table>
              <h3 class = "reclocation">Job Location</h3>
              <table class = "recremote" id = "recremote">
                <tr>
                  <td>Remote?</td><td width = "20%"></td>
                  <td>
                    <?php
                    if ($recremote == "") {
                     ?>
                    <select id="remote" name="recremote" required>
                      <option value="" disabled selected>Select</option>
                      <option value="1">Yes</option>
                      <option value="2">Temporarily</option>
                      <option value="3">No</option>
                    </select>
                    <?php
                  } else {
                     ?>
                   <select id="remote" name="recremote" required>
                     <option value=""<?php if ($recremote == ""): ?> selected="selected"<?php endif; ?>>Select</option>
                     <option value="1"<?php if ($recremote == "1"): ?> selected="selected"<?php endif; ?>>Yes</option>
                     <option value="2"<?php if ($recremote == "2"): ?> selected="selected"<?php endif; ?>>Temporarily</option>
                     <option value="3"<?php if ($recremote == "3"): ?> selected="selected"<?php endif; ?>>No</option>
                   </select>
                 <?php } ?>
                  </td>
                </tr>
              </table>
              <div class = "reclocationinfo" id = "reclocationinfo">
                <table>
                  <tr>
                    <td>Address: </td>
                    <td><input type ="search" name ="recaddress" placeholder = "Line 1" value="<?php print isset($recaddress) ? $recaddress : ''; ?>"></td>
                  </tr>
                  <tr>
                    <td>City / Town: </td>
                    <td><input type = "search" id = reccity name = "reccity" placeholder = "City / Town" value="<?php print isset($reccity) ? $reccity : ''; ?>" required></td>
                  </tr>
                  <tr>
                    <td>State / Province: </td>
                    <td><input type = "search" id = recregion name = "recregion" placeholder = "State / Province" value="<?php print isset($recregion) ? $recregion : ''; ?>" required></td>
                  </tr>
                  <tr>
                    <td>Country: </td>
                    <td><input type = "search" id = reccountry name = "reccountry" placeholder = "Country" value="<?php print isset($reccountry) ? $reccountry : ''; ?>" required></td>
                  </tr>
                </table>
              </div>
            </div>

            <script>

              $(document).ready(function() {
                <?php $required = "False"; ?>
                $('#remote').on('change', function() {
                  if (this.value == '3')
                  {
                    $("#reclocationinfo").show();
                    <?php $required = "True"; ?>
                  }
                  else
                  {
                    $("#reclocationinfo").hide();
                    <?php $required = "False"; ?>
                  }
                });
              });
              $(document).ready(function() {
                $('#remote').on('change', function() {
                  if (this.value == '3')
                  {
                    $("#reclocationinfo").show();
                    $('#reccity').attr('required',true);
                    $('#recregion').attr('required',true);
                    $('#reccountry').attr('required',true);
                  }
                  else
                  {
                    $("#reclocationinfo").hide();
                    $('#reccity').attr('required',false);
                    $('#recregion').attr('required',false);
                    $('#reccountry').attr('required',false);
                  }
                });
              });

              var check50 = "FALSE";
              var check25 = "FALSE";
              var check10 = "FALSE";
              var sendcount = 0;

            </script>
          </div>
          <div class = submitprevioussearch style="text-align:center">
            <input id = "search" type="submit" value="Search Users" name="search" onclick="submitted()">
          </div>
        </div>
      </form><!--previous search form-->

      <div class = "userlist" id = "userlist"> <!--list of search results-->
        <form action="sendmessage.php" method = "POST" class = "sendmessage"> <!--job posting form-->
          <div class = "message" id = "message"> <!--send message container-->
            <h3>Send Job Posting</h3>
            <div class = "positioninfo">
              <div class = "positionrole">
                <input type = "text" name = "positionrole" id = "positionrole" placeholder = "Position" required = "required" value = "<?php print isset($previousmessage->position) ? $previousmessage->position : ''; ?>">
              </div>
              <div class = "separator">&nbsp;</div>
              <div class = "companyinfo">
                <input type = "text" name = "companyinfo" id = "companyinfo" placeholder = "Company" required = "required" value = "<?php print isset($previousmessage->company) ? $previousmessage->company : ''; ?>">
              </div>
              <div class = "separator">&nbsp;</div>
              <div class = "typeinfo">
                <?php
                  if (is_null($rectype) or empty($rectype)) {
                ?>
                <select id="rectype2" name="positiontype" required>
                  <option value="">Select</option>
                  <option value="Full Time">Full Time</option>
                  <option value="Part Time">Part Time</option>
                  <option value="Casual">Casual</option>
                  <option value="Temporary">Temporary</option>
                  <option value="Seasonal">Seasonal</option>
                  <option value="Internship">Internship</option>
                  <option value="Contract">Contract</option>
                </select>
                <?php } else {?>
                <select id="rectype2" name="positiontype" required>
                  <option value=""<?php if ($rectype== ""): ?> selected="selected"<?php endif; ?>>Select</option>
                  <option value="Full Time"<?php if ($rectype== "Full Time"): ?> selected="selected"<?php endif; ?>>Full Time</option>
                  <option value="Part Time"<?php if ($rectype== "Part Time"): ?> selected="selected"<?php endif; ?>>Part Time</option>
                  <option value="Casual"<?php if ($rectype== "Casual"): ?> selected="selected"<?php endif; ?>>Casual</option>
                  <option value="Temporary"<?php if ($rectype== "Temporary"): ?> selected="selected"<?php endif; ?>>Temporary</option>
                  <option value="Seasonal"<?php if ($rectype== "Seasonal"): ?> selected="selected"<?php endif; ?>>Seasonal</option>
                  <option value="Internship"<?php if ($rectype== "Internship"): ?> selected="selected"<?php endif; ?>>Internship</option>
                  <option value="Contract"<?php if ($rectype== "Contract"): ?> selected="selected"<?php endif; ?>>Contract</option>
                </select>
                <?php } ?>
              </div>
            <!-- </div> -->
            <!-- <div class = "salaryrange"> -->
              <div class = "salarystart">
                <input type = "text" name = "salarystart" id = "salarystart" placeholder = "Min Salary" required value = "<?php print isset($previousmessage->salarystart) ? $previousmessage->salarystart : ''; ?>">
              </div>
              <div class = "separator">&nbsp;</div>
              <div class = "salaryend">
                <input type = "text" name = "salaryend" id = "salaryend" placeholder = "Max Salary" value = "<?php print isset($previousmessage->salaryend) ? $previousmessage->salaryend : ''; ?>">
              </div>
              <div class = "separator">&nbsp;</div>
              <div class = currency style = "height: 30px; text-align: center; margin-top: 7px; display: inline-block; width: 25px">Or</div>
              <div class = "separator">&nbsp;</div>
              <div class = "salarystart">
                <input type = "text" name = "hourlywage" id = "wage" placeholder = "Hourly Wage" required value = "<?php print isset($previousmessage->wage) ? $previousmessage->wage : ''; ?>">
              </div>
              <div class = "separator">&nbsp;</div>
              <div class = "currency">
                <?php if (!property_exists($previousmessage, 'currency') or $previousmessage->currency == "") { ?>
                <select id="currency" name="currency" required = "required">
                  <option value="" selected disabled>Currency</option>
                  <option value="USD">USD</option>
                  <option value="CAD">CAD</option>
                  <option value="EUR">EUR</option>
                </select>
              <?php } else { ?>
                <select id="currency" name="currency" required = "required">
                  <option value="NULL" selected disabled>Currency</option>
                  <option value="USD"<?php if ($previousmessage->currency == "USD"): ?> selected="selected"<?php endif; ?>>USD</option>
                  <option value="CAD"<?php if ($previousmessage->currency == "CAD"): ?> selected="selected"<?php endif; ?>>CAD</option>
                  <option value="EUR"<?php if ($previousmessage->currency == "EUR"): ?> selected="selected"<?php endif; ?>>EUR</option>
                </select>
              <?php } ?>
              </div>
            </div>
            <div class = "writemessage">
              <textarea type = "text" id = "writemessage" name = "writemessage" placeholder = "Write a job posting you want to send to users" required = "required"><?php print isset($previousmessage->message) ? $previousmessage->message : ''; ?></textarea>
            </div>
            <div class = "sendmessage">
              <div class = "sendbutton">
                <button type = 'button' id = "previewmessage" onclick="previewposting()">Preview Posting</button>
              </div>
            </div>
            <div class = "viewpostingscard" id = "viewpostingscard"  style = "display: none; margin-top: 10px; margin-bottom: 10px;">
              <div class = "viewpostingtitle" id = "previewtitle" style = " font-size: 35px;">
                <!-- This part needs to be updated dynamically-->
              </div>
              <div class = "moreinfo" style = "margin-left: 10px; font-size: 30px" id = "previewsalary">
                <!-- This part needs to be updated dynamically-->
              </div>

              <div class = "isremote" style = "font-size: 30px">
                <div class = "remote?" id = "previewremote"> </div> <!-- This part needs to be updated dynamically-->
              </div>

              <div class = "isremote" style = "font-size: 30px">
                <div class = "remote?" id = "previewtype"> </div> <!-- This part needs to be updated dynamically-->
              </div>
              <div class = "isremote" style = "font-size: 30px">
                <div class = "remote?" id = "previewlocation"> </div> <!-- This part needs to be updated dynamically-->
              </div>
              <div class = "postingdetails" style = "display: inline-block; float: left; margin-left: 20px; width: 80%; margin-bottom: 10px;">
                <h4>Job Description</h4>
                <div id = "previewdesc"></div><!-- This part needs to be updated dynamically-->
              </div>
            </div>
            <div class = "sendmessage" id = "selectusersendmessage" style = "display: none">

              <div class = "sendbutton">
                <input id = "sendmessage" type="submit" value="Send Posting (0)" name="sendmessage" onclick="submitted()">
              </div>
              <div class = "selectnumber">
                <select id="selectnumber" name="selectnumber">
                  <option value="NULL" selected>Send to top number of users</option>
                  <option value="10">10</option>
                  <option value="25">25</option>
                  <option value="50">50</option>
                  <option value="100">100</option>
                  <option value="150">150</option>
                  <option value="200">200</option>
                </select>
              </div>
              <?php if (isset($_GET['senderror'])) { ?>
                <div class = "senderror" style = "text-align: center"><?php echo $_GET['senderror']; ?></div>
              <?php } ?>
            </div>
          </div> <!--send message container-->

          <script>
            var submit = document.getElementById("sendmessage");
            submit.value = ("Send Posting (").concat(sendcount).concat(")");
            if (sendcount == 0) {
              submit.style.color = "gray";
              submit.disabled = true;
            }
            else {
              submit.style.color = "black";
              submit.disabled = false;
            }
            jQuery(function ($) {
              var $inputs = $('input[name=salarystart],input[name=hourlywage]');
              $inputs.on('input', function () {
                $inputs.not(this).prop('required', !$(this).val().length);
              });
            });

            function previewposting() {
              var previewposting = document.getElementById("viewpostingscard");
              var previewmessage = document.getElementById("previewmessage");

              var previewtitle = document.getElementById("previewtitle");
              var previewsalary = document.getElementById("previewsalary");
              var previewremote = document.getElementById("previewremote");
              var previewtype = document.getElementById("previewtype");
              var previewlocation = document.getElementById("previewlocation");
              var previewid = document.getElementById("previewid");
              var previewdesc = document.getElementById("previewdesc");
              var send = document.getElementById("selectusersendmessage");

              if (previewposting.style.display == 'none') {
                previewposting.style.display = 'block';
                previewmessage.innerHTML = 'Hide Posting';
                send.style.display = 'block';
                previewtitle.innerHTML = document.getElementById("positionrole").value + " at " + document.getElementById("companyinfo").value;
                if (document.getElementById("salarystart").value && document.getElementById("salaryend").value) {
                  previewsalary.innerHTML = "$ " + document.getElementById("salarystart").value + " - " + document.getElementById("salaryend").value;
                }
                else if (document.getElementById("salarystart").value) {
                  previewsalary.innerHTML = "$ " + document.getElementById("salarystart").value;
                }
                else {
                  previewsalary.innerHTML = "$ " + document.getElementById("wage").value;
                }
                if (document.getElementById("currency").value) {
                  previewsalary.innerHTML += " " + document.getElementById("currency").value;
                }
                if (document.getElementById("remote") == 1) {
                  previewremote.innerHTML = "Remote";
                }
                else if (document.getElementById("remote") == 2) {
                  previewremote.innerHTML = "Temporarily Remote";
                }
                else {
                  previewremote.innerHTML = "In Person";
                  previewlocation.innerHTML = document.getElementById("reccity").value + " " + document.getElementById("recregion").value + " " + document.getElementById("reccountry").value;
                }
                previewtype.innerHTML = document.getElementById("rectype2").value;
                previewdesc.innerHTML = document.getElementById("writemessage").value;

              }
              else {
                previewposting.style.display = 'none';
                previewmessage.innerHTML = 'Preview Posting';
                send.style.display = 'none';
              }
            }
          </script>

          <?php
          $user = "SELECT Email, FirstName, LastName, Bio, Image, Education1, Education2, Education3, Experience1, Experience2, Experience3, Experience4, Experience5, Skill1, Skill2, Skill3, Skill4, Skill5, Skill6, Skill7, City, Region, Country FROM user_login ORDER BY (SELECT score.`$username` FROM score WHERE score.Email = user_login.Email) DESC";
          $scores = "SELECT * FROM score ORDER BY `$username` DESC";
          $scoreselect = $conn->query($scores);
          $select = $conn->query($user);
          $numcard = 0;
          $i = 0;
          while($row = $select->fetch_array(MYSQLI_ASSOC) and $score = $scoreselect->fetch_array(MYSQLI_ASSOC)) {
            if (!isset($row['Image']) or empty($row['Image'])) {
              $profilepic = "img/defaultprofile.PNG";
            }
            else {
              $profilepic = "img/".$row['Image'];
            }
            // echo $row['Email'];
            if ($numcard == 0 or $numcard % 3 == 0) {
            ?><div id = "usercardpage" class = "usercardpage"><?php
            }

            if ((empty($row['Education1']) and empty($row['Education2']) and empty($row['Education3'])) or ($row['Education1'] == "NULL" and $row['Education2'] == "NULL" and $row['Education3'] == "NULL")) {
              $haseducation = "False";
            }
            else {
              $haseducation = "True";
            }
            if (!empty($row['Education1']) and $row['Education1'] != "NULL") {
              if (isset(unserialize($row['Education1'])->level)) {
                $greatesteducation = unserialize($row['Education1']);
                // echo "why doesn't this work?";
              }
            }
            if ((!empty($row['Education1']) and $row['Education1'] != "NULL") and (!empty($row['Education2']) and $row['Education2'] != "NULL")) {
              if (isset(unserialize($row['Education1'])->level) and isset(unserialize($row['Education2'])->level)) {
                if ((int)(unserialize($row['Education1'])->level) > (int)(unserialize($row['Education2'])->level)) {
                  $greatesteducation = unserialize($row['Education1']);
                }
                else {
                  $greatesteducation = unserialize($row['Education2']);
                }
              }
            }
            if ((!empty($row['Education1']) and $row['Education1'] != "NULL") and (!empty($row['Education2']) and $row['Education2'] != "NULL") and (!empty($row['Education3']) and $row['Education3'] != "NULL")) {
              if (isset(unserialize($row['Education1'])->level) and isset(unserialize($row['Education2'])->level) and isset(unserialize($row['Education3'])->level)) {
                if ((int)(unserialize($row['Education1'])->level) > (int)(unserialize($row['Education2'])->level) and (int)(unserialize($row['Education1'])->level) > (int)(unserialize($row['Education3'])->level)) {
                  $greatesteducation = unserialize($row['Education1']);
                }
                else if ((int)(unserialize($row['Education2'])->level) > (int)(unserialize($row['Education1'])->level) and (int)(unserialize($row['Education2'])->level) > (int)(unserialize($row['Education3'])->level)) {
                  $greatesteducation = unserialize($row['Education2']);
                }
                else {
                  $greatesteducation = unserialize($row['Education3']);
                }
              }
            }
            ?>

            <div id = "usercard" class = "usercard">
              <div class = "userimage">
                <img src="<?php echo $profilepic; ?>" height="200" width="200" border-radius="50%" background-color="white" class="imgthumbnail" />
              </div>
              <div class = "userinfo">
                <div class = "username">
                  <h1><?php echo $row['FirstName']; echo " "; echo $row['LastName'];?></h1>
                </div>
                <div class = "usereducation">
                  <?php

                  if ($haseducation == "True") {
                    if ((int)($greatesteducation->level) > 0 and (int)($greatesteducation->year) > 0 and !empty($greatesteducation->school) and !empty($greatesteducation->program)) {
                      if ($greatesteducation->level == "1") {
                        $level = "high school";
                      }
                      if ($greatesteducation->level == "2" or $greatesteducation->level == "3") {
                        $level = "undergraduate";
                      }
                      if ($greatesteducation->level == "4") {
                        $level = "master's";
                      }
                      if ($greatesteducation->level == "5") {
                        $level = "PhD";
                      }
                      if ($greatesteducation->year < 7) {
                        echo "<h3>Year ".$greatesteducation->year." ".$level." student at ".$greatesteducation->school.", ".$greatesteducation->program."</h3>";
                      }
                      else {
                        if ($greatesteducation->level == "1") {
                          $level = "High School Diploma.";
                        }
                        if ($greatesteducation->level == "2") {
                          $level = "Associate of ".$greatesteducation->program;
                        }
                        if ($greatesteducation->level == "3") {
                          $level = "Bachelor of ".$greatesteducation->program;
                        }
                        if ($greatesteducation->level == "4") {
                          $level = "Master of ".$greatesteducation->program;
                        }
                        if ($greatesteducation->level == "5") {
                          $level = "PhD in ".$greatesteducation->program;
                        }
                        echo "<h3>Graduated from ".$greatesteducation->school.", ".$level."</h3>";
                      }
                    }
                    else if (!empty($greatesteducation->school) and !empty($greatesteducation->level) and !empty($greatesteducation->program)) {
                      if ($row['Level'] == "1") {
                        $level = "High School";
                      }
                      if ($row['Level'] == "2" or $row['Level'] == "3") {
                        $level = "Undergraduate";
                      }
                      if ($row['Level'] == "4") {
                        $level = "Master's";
                      }
                      if ($row['Level'] == "5") {
                        $level = "PhD";
                      }
                      if ($row['Year'] < 7) {
                        echo "<h3>".$level." student at ".$row['School'].", ".$row['Program']."</h3>";
                      }
                    }
                    else if (!empty($greatesteducation->school) and !empty($greatesteducation->program)) {
                      echo "<h3>".$greatesteducation->program." student at ".$greatesteducation->school."</h3>";
                    }
                    else if (!empty($greatesteducation->school)) {
                      echo "<h3>Student at ".$greatesteducation->school."</h3>";
                    }
                    else if (!empty($greatesteducation->program)) {
                      echo "<h3>".$greatesteducation->program." student</h3>";
                    }
                  }
                   ?>
                </div>
                <div class = "userjob">
                  <?php
                  $objects = array("Experience1", "Experience2", "Experience3", "Experience4", "Experience5");
                  foreach ($objects as $value) {
                    if ($row[$value] != "NULL" and !empty($row[$value])) {
                      if (unserialize($row[$value])->end == "Present") {
                        echo "<div class = currentjob><h3>".unserialize($row[$value])->role." at ".unserialize($row[$value])->company."</h3></div>";
                      }
                    }
                  }
                    ?>
                </div>
              </div>
              <div class = userstat>
                <div class = "usermatch">
                  <input type="checkbox" onchange="isChecked(this,'elem')" name = "send[]" class = "sendcheckbox" value = "<?php print isset($row['Email']) ? $row['Email'] : ''; ?>">
                </div>

                <div class = "matchscore">
                  <?php echo "".(string)$score["$username"].""; ?>
                </div>
              </div>
              <script>
              jQuery(document).ready(function($) {
                document.getElementById("selectnumber").onchange = function() {
                  var submit = document.getElementById('sendmessage');
                  var container = document.getElementById("userlist");
                  var divs = container.getElementsByClassName("usercard");
                  var divs2 = container.getElementsByClassName("userstat");
                  if(this.value == "NULL") {
                    // if (check25 == "TRUE" || check50 == "TRUE" || check10 == "TRUE") {
                    $('[name="send[]"]').slice(0, 200).prop("checked", false);
                    for (var i = 0; i < divs.length; i++) {
                      divs[i].setAttribute('style', 'background-color: white');
                      divs2[i].setAttribute('style', 'background-color: white');
                    }
                    check50 = "FALSE";
                    check25 = "FALSE";
                    check10 = "FALSE";
                  }
                  // }
                  if(this.value == "10") {

                    // if (check25 == "TRUE" || check50 == "TRUE") {
                    $('[name="send[]"]').slice(2, 200).prop("checked", false);
                    for (var i = 2; i < divs.length; i++) {
                      // console.log(divs);
                      divs[i].setAttribute('style', 'background-color: white');
                      divs2[i].setAttribute('style', 'background-color: white');
                    }
                    check50 = "FALSE";
                    check25 = "FALSE";
                    // }
                    $('[name="send[]"]').slice(0, 2).prop("checked", true);
                    for (var i = 0; i < 2; i++) {
                      divs[i].setAttribute('style', 'background-color: palegreen');
                      divs2[i].setAttribute('style', 'background-color: palegreen');

                    }
                    sendcount += 10;
                    check10 = "TRUE";
                  }
                  else if (this.value == "25") {
                    // if (check50 == "TRUE") {
                    $('[name="send[]"]').slice(3, 200).prop("checked", false);
                    for (var i = 3; i < divs.length; i++) {
                      divs[i].setAttribute('style', 'background-color: white');
                      divs2[i].setAttribute('style', 'background-color: white');

                    }
                    check50 = "FALSE";
                    // }
                    $('[name="send[]"]').slice(0, 3).prop("checked", true);
                    for (var i = 0; i < 3; i++) {
                      divs[i].setAttribute('style', 'background-color: palegreen');
                      divs2[i].setAttribute('style', 'background-color: palegreen');

                    }
                    check25 = "TRUE";
                  }
                  else if (this.value == "50") {
                    $('[name="send[]"]').slice(0, 5).prop("checked", true);
                    for (var i = 0; i < 5; i++) {
                      divs[i].setAttribute('style', 'background-color: palegreen');
                      divs2[i].setAttribute('style', 'background-color: palegreen');

                    }
                    check50 = "TRUE";
                  }
                  sendcount = document.querySelectorAll('input[type="checkbox"]:checked').length;
                  var submitvalue = ("Send Posting (").concat(sendcount).concat(")");
                  // console.log(submitvalue);
                  document.getElementById("sendmessage").setAttribute('value', submitvalue);
                  if (sendcount == 0) {

                    submit.style.color = "gray";
                    submit.disabled = true;
                  }
                  else {
                    submit.style.color = "black";
                    submit.disabled = false;
                  }
                };
              });
              function isChecked(elem) {
                elem.parentNode.parentNode.style.background = (elem.checked) ? 'palegreen' : 'white';
                elem.parentNode.parentNode.parentNode.style.background = (elem.checked) ? 'palegreen' : 'white';
                sendcount = document.querySelectorAll('input[type="checkbox"]:checked').length;
                var submitvalue = ("Send Posting (").concat(sendcount).concat(")");
                // console.log(submitvalue);
                document.getElementById("sendmessage").setAttribute('value', submitvalue);
                if (sendcount == 0) {

                  submit.style.color = "gray";
                  submit.disabled = true;
                }
                else {
                  submit.style.color = "black";
                  submit.disabled = false;
                }
              }
              </script>
            </div> <!--end of each usercard-->

            <?php $numcard ++;
            if ($numcard % 3 == 0) {
              $end = true;
              ?> </div> <?php
            }
            else {
              $end = false;
            }
          }
          if ($end == false) {
            ?> </div> <?php
          }
          if ($numcard > 3) { ?>
            <table class = "searchnav" id = "searchnav" style = "height: 25px;">
              <tr></tr>
            </table>
            <script>
              <?php
              //Warning: unreadable shit below!!!

              for ($i = 1; $i <= ceil($numcard / 3); $i++) { ?>
                console.log("loop");
                $("#searchnav").find('tr').each(function() {
                  $(this).append("<td id = searchnav<?php echo $i; ?> name = <?php echo $i; ?> onclick = showpage(this)><?php echo $i; ?></td>");
                });
                <?php if ($i == 1) {?>
                  document.getElementById("searchnav1").setAttribute("class", "active");
                  var currentpage = document.getElementsByClassName("usercardpage");
                  currentpage[0].style.display = "block";
                  <?php for ($j = 1; $j < ceil($numcard / 3); $j++) { ?>
                    currentpage[<?php echo $j;?>].style.display = "none";
            <?php }
                }
              } ?>
              function showpage(elem) {
                var table = document.getElementById("searchnav");
                var currentpage = document.getElementsByClassName("usercardpage");

                for (let row of searchnav.rows) {
                  for(let cell of row.cells) {
                    cell.removeAttribute("class");
                  }
                }

                <?php for ($j = 0; $j < ceil($numcard / 3); $j++) { ?>
                  currentpage[<?php echo $j; ?>].style.display = "none";
                <?php } ?>
                elem.setAttribute("class", "active");
                currentpage[Number(elem.getAttribute("name") - 1)].style.display = "block";
              }
            </script>
          <?php } ?>
        <!-- </div> -->
        </form>
      </div> <!--job posting form-->
    </div> <!--list of search results-->
  </body>
</html>

<?php
$result->close();
$conn->close();
?>
