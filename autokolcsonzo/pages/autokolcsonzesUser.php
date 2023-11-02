<h1>Az autókölcsönzés kezdete</h1>
<?php
$userid= $_SESSION ['user']['userid'];
$autotid= filter_input(INPUT_GET, "autoid") ;
$auto=$db->getKivalasztottAuto($autoid);
if (filter_input(INPUT_POST, "autokolcsonzes", FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE)) {
    $autoid= filter_input(INPUT_POST, "autoid", FILTER_VALIDATE_INT);
    $userid= filter_input(INPUT_POST, "userid", FILTER_VALIDATE_INT);
    echo 'rögzítés';
}
var_dump($_SESSION);
echo '<p>Valóban szeretné a '.$aut['marka'].' nevű autónkat kikölcsönözni?</p>';
//- INSERT INTO `autokolcsonzes` (`autoid`, `userid`) VALUES ('3', '1');
if ($db->setAutokolcsonzes($autoid, $_SESSION ['user']['userid'])) {
    header('location: index.php?menu=home');
} else {
    echo 'Sikertelen rögzítés';
}
?>
<form method="POST">
    <input type="hidden" name="userid" value="<?php echo $userid; ?>">
    <input type="hidden" name="allatid" value="<?php echo $autoid; ?>">
<button type="submit" class="btn btn-danger" name="autokolcsonzes" value="1">Igen</button>
<a href="index.php?menu=home" class="btn btn-light">Mégsem</a>
</form>