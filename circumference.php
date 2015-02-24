<h1>Circumference Calculator</h1>

<!--create the form-->
<form method="get" action="">

    Radius: <input type="text"
           name="radius" /><br />

    <input type="submit"
           name="submit"
           value="Calculate!" /><br />

</form>

<?php

// retrieve the radius from the get array
$radius = $_GET['radius'];

$pi = 3.14159; //define ¹

// perform the calculation
// Circumference of a circle = 2 x ¹ x r
$circumference = 2 * $pi * $radius;

echo "A circle with a radius of $radius
      has a circumference of $circumference";

?>