<h1>Ideal Spouse Age Calculator</h1>
<!-- by: Tyler Youngblood -->
<!-- from: http://www.dack.com/misc/optimum_age.html -->
<!-- http://cis.highline.edu/outreach/ -->

<link rel="stylesheet" href="http://ned.highline.edu/~tostrander/116/styles.css">

<form method="get" action="">

    First:  <input type="text" name="firstName" /><br />
    Last:   <input type="text" name="lastName" /><br />
    Age:    <input type="text" name="age" size="3" /></br/>

    <input type="radio" name="gender" value="male" />Male<br/>
    <input type="radio" name="gender" value="female" />Female<br/>

    <input type="submit" name="submit" value="Submit" /><br />

</form>

<?php
//check to see if the form has been submitted
if (isset($_GET['submit']))
{
    //if the form has been submitted ...
    $lastName = $_GET['lastName'];
    $age = $_GET['age'];
    $gender = $_GET['gender'];

    if($gender=="male") {

        //calculate ideal age of wife
        $spouse_age = round($age / 2 + 7);

        //check to make sure spouse is 18+
        if ($spouse_age >= 18 ) {
            echo "Hello Mr. $lastName, you are $age years old.
                  Therefore your ideal spouse would be $spouse_age years old.";
        } else {
            echo "You're $age years old. That's too young to get married!";
        }

    } else {

        //gender is female, check to make sure she's 18+
        If ($age >= 18) {
            //calculate ideal age of husband
            $spouse_age = round( ($age - 7) * 2 ); //notice extra parentheses
            echo "Hello Miss. $lastName, you are $age years old.
                  Therefore your ideal spouse would be $spouse_age years old.";

        } else {
            echo "You're $age years old. That's too young to get married!";
        }

    } //end if($gender ...)

} //end if(isset...)

?>