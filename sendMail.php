<?php
if($_POST){
    $name = $_POST['name'];
    $phone = $_POST['number'];
//send email
    mail("info@fensterdichtungen.org", "Rückruf verlangt von " .$name, "Hallo, der potentielle Kunde/Kunde '". $name . "'' wuenscht sich einen Rueckruf von Ihnen. Sie erreichen Ihn unter der Rufnummer: " . $phone . " Danke!");
}
?>