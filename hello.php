<form method="get" action="">

    <input type="text"
           name="firstName" /><br />

    <input type="submit"
           name="submit"
           value="Submit" /><br />

</form>

<?php

$firstName = $_GET['firstName'];

echo "Hello $firstName";

?>