<form method="post" action="">
    
    <input type="text" name="num1" /><br />
    <input type="text" name="num2" /><br />
    <input type="submit" name="submit"
           value="Add Nums" /><br />

</form>

<?php

$num1 = $_POST['num1'];
$num2 = $_POST['num2'];

$result = $num1 / $num2; // 4 + 5 = 9

echo $result;



?>