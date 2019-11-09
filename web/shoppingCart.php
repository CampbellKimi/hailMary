<?php
session_start();
?>

<!DOCTYPE html> 
<html> 
    <head> 
        <meta charset = "utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>My Cats Shopping Cart!</title> 
        <link rel = "stylesheet"
        type = "text/css"
        href = "shoppingCart.css" >
        <form action = "shoppingCartView.php" method = "GET">

    </head>
    <body>
        <h1> Pick the Cat You Want To Love!</h1>
        <table>
  <tr>
    <th>Cats</th>
    <th>Picture</th>
  </tr>
  <tr>
    <td width = ><input type="checkbox" name="okitty" id= "orangeKitty" value="<?php echo "".$_SESSION['oKitty'].""; ?>"> Orange Kitty</td>
    <td><img src = "OrangeKitty.jpg" alt = "okitty" class = "image"></td>
  </tr>
  <tr>
    <td><input type="checkbox" name="gkitty" id= "greyKitty" value="<?php echo "".$_SESSION['gKitty'].""; ?>"> Grey Kitty</td>
    <td><img src = "GreyKitty.jpg" alt = "gkitty" class = "image"></td>
  </tr>
  <tr>
  <td><input type="checkbox" name="bkitty" id= "blackKitty" value="<?php echo "".$_SESSION['bKitty'].""; ?>"> Black Kitty</td>
  <td><img src = "BlackKitty.jpg" alt = "bkitty" class = "image"></td>
  </tr>
  <tr>
  <td><input type="checkbox" name="mkitty" id= "MKitty" value="<?php echo "".$_SESSION['mKitty'].""; ?>"> Yo Mamas Kitty</td>
  <td><img src = "MommaKitty.jpg" alt = "mkitty" class = "image"></td>
  </tr>
</table>
<button type = "submit" onclick = "location.href='shoppingCartView.php'">
        Add To My Cart <br/>
<button type = "submit">
        Check out with my kitties!
    </button>
    <?php
if(isset($_POST['submit'])){//to run PHP script on submit
if(!empty($_POST['check_list'])){
// Loop to store and display values of individual checked checkbox.
foreach($_POST['check_list'] as $selected){
echo $selected."</br>";
}
}
}
?>
    </body>
</form>
    </html>