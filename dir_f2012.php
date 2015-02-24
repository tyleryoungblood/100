<head>
    <link href="dir.styles.css" rel="stylesheet" type="text/css" />
</head>

<body>

<h1 style="margin: 0px">Class Directory</h1>
<h3 style="margin-top: 0px">CSCI 100: Survey of Computing (Fall 2012)</h3>


    <form method="post" action="">
        <label for='firstName'>First Name: </label><input type='text' name='firstName' id='firstName' size='20'/><br />
        <label for='lastName'>Last Name: </label><input type='text' name='lastName' id='lastName' size='20' /><br />
        <label for='userName'>Username:</label><input type='text' name='userName' id='userName' size='20' /><br />
        <label for='pin'>PIN:</label><input type='password' name='pin' id='pin' size='10' /><br />
        <label for='submit'></label><input type='submit' name='submit' id='submit' value='Add Student' />

    </form>

    <?php

    //connect to the DB Server
    //include "../../db_cnxn.php"; //include the DB connection code
    include "db_cnxn.php"; //include the DB connection code

    //select the database
    @mysql_select_db("tyoungblood") OR die("Error accessing the database!");
    //print "Successfully selected the database.<br />";

    //create the table, be sure to change the name to the appropriate year and quarter
            $sqlCreate = "CREATE TABLE IF NOT EXISTS `tbl_100_dir_2012_fall` (
                                `studentID` int(4) NOT NULL AUTO_INCREMENT,
                                `firstName` varchar(20) NOT NULL,
                                `lastName` varchar(20) NOT NULL,
                                `userName` varchar(20) NOT NULL,
                                PRIMARY KEY (`studentID`))";
            @mysql_query($sqlCreate) OR die("Unable to create the table.");

    //display existing student data
    echo "<h1>Students</h1>";
    $query = "SELECT * FROM tbl_100_dir_2012_fall ORDER BY lastName";

    $result = mysql_query($query);

    if(mysql_num_rows($result) == 0)
    {
        //echo "Your query returned no rows.";
    }
    else //display student names as HTML links
    {
        $half_students = mysql_num_rows($result) /2;
        $i = 0;
        $col2 = 0;


        while ($row = mysql_fetch_array($result))
        {
            if ($i < $half_students)
            {

                echo "<li class='licol-1'><a href='http://ned.highline.edu/~{$row['userName']}/100'>{$row['lastName']}, {$row['firstName']}</a></li>\n";
                $i++;
            }
            else
            {
                if ($col == 0)
                {
                    $top = $i * 15;
                    echo "<li class='licol-2' style='margin-top:-${top}px'><a href='http://ned.highline.edu/~{$row['userName']}/100'>{$row['lastName']}, {$row['firstName']}</a></li>\n";
                    $i++;
                    $col++;
                }
                else
                {
                    echo "<li class='licol-2'><a href='http://ned.highline.edu/~{$row['userName']}/100'>{$row['lastName']}, {$row['firstName']}</a></li>\n";
                    $i++;
                }


            }

        }

    }

    if(isset($_POST['submit'])) //check to make sure form has been submitted
    {

        if($_POST['pin'] != $pin)
        {
            echo "Invalid PIN Number entered!";
        }
        else
        {
            //sanitize input
            $firstName = htmlspecialchars(strip_tags($_POST['firstName']));
            $lastName = htmlspecialchars(strip_tags($_POST['lastName']));
            $userName = htmlspecialchars(strip_tags($_POST['userName']));

            //insert data
            $insertStudent = "INSERT INTO tbl_100_dir_2012_fall VALUES
                       (NULL, '$firstName', '$lastName', '$userName')";

            @mysql_query($insertStudent) OR die("Unable to insert student info.");
                //echo mysql_affected_rows($cnxn) . " student inserted.<br />";

            header( 'Location: http://ned.highline.edu/~tyoungblood/100/dir.php' );

        }


    } //end if(isset)







    ?>

</body>