<!doctype html>
<html lang="en">

<?php

/**************
* PIN is 4474 *
**************/

/*********** EDIT THIS INFORMATION ONLY ********************/
$department = "CSCI"; //CSCI, CIS, etc
$class      = "100"; //116, 202, etc - as string
$class_name = "Survey of Computing"; // HTML5/CSS3, Intro to Web Development, etc
$quarter    = "Winter"; // Fall, Winter, Spring, Summer
$year       = "2015"; // 2013, 2014, etc - as string
/*********** DON'T EDIT ANYTHING BELOW THIS LINE ***********/

define(TITLE, "$department {$class}: $class_name");
define(RIBBON, "{$quarter} {$year}");
define(TABLE, strtolower("tbl_{$class}_dir_{$year}_{$quarter}") ); // example: tbl_202_dir_2013_Winter

//sanitize input
function sanitize($input) {

    if(!isset($_POST["$input"]) || strlen(trim($_POST["$input"])) == 0)
    {
        global $error; //get access to $error var
        $error .= "No $input provided! ";
        return $error;
    } else {
        $input = mysql_real_escape_string(htmlspecialchars(strip_tags($_POST["$input"])));
        return $input;
    }
}

?>

<head>
	<meta charset="utf-8">
	<title><?php echo $class; ?> Directory</title>
        <link rel="stylesheet" href="dir.styles.css" />
        <link rel="stylesheet" href="3d-corner-ribbons.css" />

	<!--[if lt IE 9]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
</head>

<body>
<div class="wrapper"> 
    <!-- START RIBBON -->
        <div class="ribbon ribbon-yellow ribbon-large">
            <div class="banner">
                <div class="text"><a href="http://en.wikipedia.org/wiki/Easter_egg_%28media%29"><?php echo RIBBON; ?></a></div>
            </div>
        </div>
    <!-- END RIBBON -->


<h1>Class Directory</h1>
<h3><?php echo TITLE; ?></h3>


    <form method="post" action="">
        <label for='firstName'>First Name: </label><input type='text' name='firstName' id='firstName' size='20'/><br />
        <label for='lastName'>Last Name: </label><input type='text' name='lastName' id='lastName' size='20' /><br />
        <label for='userName'>Username:</label><input type='text' name='userName' id='userName' size='20' /><br />
        <label for='pin'>PIN:</label><input type='password' name='pin' id='pin' size='10' />
            <span style="color: red">(Provided by Instructor)</span><br />
        <label for='submit'></label><input type='submit' name='submit' id='submit' value='Add Student' />

    </form>

<?php

    //connect to the DB Server
    include "db_cnxn.php"; //include the DB connection code

    //select the database
    @mysql_select_db("tyoungblood") OR die("Error accessing the database!");
    //print "Successfully selected the database.<br />";

    //create the table, be sure to change the name to the appropriate year and quarter
            $sqlCreate = "CREATE TABLE IF NOT EXISTS `" . TABLE ."` (
                                `studentID` int(4) NOT NULL AUTO_INCREMENT,
                                `firstName` varchar(20) NOT NULL,
                                `lastName` varchar(20) NOT NULL,
                                `userName` varchar(20) NOT NULL,
                                PRIMARY KEY (`studentID`))";
            @mysql_query($sqlCreate) OR die("Unable to create the table.");


    //display existing student data
    echo "<hr>\n";
    echo "<h2>Students</h2>\n";
    $query = "SELECT * FROM " . TABLE . " ORDER BY lastName";

    $result = mysql_query($query);

    if(mysql_num_rows($result) == 0)
    {
        //echo "Your query returned no rows.";
    }
    else //display student names as HTML links
    {

        echo "<ul>\n";

        while ($row = mysql_fetch_array($result))
        {
            echo "\t<li><a href='http://ned.highline.edu/~{$row['userName']}/{$class}/'>{$row['lastName']}, {$row['firstName']}</a></li>\n";
        }

        echo "</ul>\n";
    }

    if(isset($_POST['submit'])) //check to make sure form has been submitted
    {

        if($_POST['pin'] != $pin)
        {
            echo "<h3 style='color:red;'>Invalid PIN!</h3>
                    <p>The PIN is provided by the instructor
                    (either in class or via a video walkthrough
                    of this page). Check <a href=\"http://canvas.highline.edu\">Canvas</a>  and
                    look for a video about creating your class home page.</p>";
        } else {
            $error = ""; // set an error flag to an empty string

            $firstName = sanitize(firstName);
            $lastName = sanitize(lastName);
            $userName = sanitize(userName);

            //insert data
            $checkForDuplicate = "SELECT * FROM " . TABLE . " WHERE userName ='$userName'";

            $duplicateFound = mysql_query($checkForDuplicate);

            if($error=="") { // there were no errors returned from sanitize()

                if(mysql_num_rows($duplicateFound)==FALSE)  { // the user doesn't already exist in DB

                $insertStudent = "INSERT INTO " . TABLE . " VALUES
                       (NULL, '$firstName', '$lastName', '$userName')";


                @mysql_query($insertStudent) OR die("Unable to insert student info.");

                header('Location: ' . $_SERVER['REQUEST_URI'] ); //reload current page to display new user

                } else {

                    echo "<h1 style='color:red;'>That user already exists!</h1>";
                }

            } else { // sanitize() returned at least 1 errors

                echo "<br><h3 style='color:red;'>ERROR: $error</h3>";
            }

        }
    } //end if(isset)

?>
</div> <!-- wrapper -->
</body>
</html>