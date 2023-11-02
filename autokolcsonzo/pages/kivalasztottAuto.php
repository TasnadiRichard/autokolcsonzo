<?php
if (filter_input(INPUT_POST, "Adatmodositas", FILTER_VALIDATE_BOOL, FILTER_NULL_ON_FAILURE)) {
    $adatok = $_POST;
    var_dump($adatok);
    $autoid = filter_input(INPUT_POST, "autoid", FILTER_SANITIZE_NUMBER_INT);
    $marka = htmlspecialchars(filter_input(INPUT_POST, "marka"));
    $tipus = filter_input(INPUT_POST, "tipusSelect");
    $gyartasi_ido = filter_input(INPUT_POST, "gyartasi_ido");
    $kivitel = filter_input(INPUT_POST, "kivitelSelect");
    $nyilvantartasban = filter_input(INPUT_POST, "megjegyzes");
    $nyilvantartasban = filter_input(INPUT_POST, "nyilvantartasban");
    $from = null;
    $to = null;
    if ($_FILES['kepfajl']['error'] == 0) {
        $kiterjesztes = null;
        switch ($_FILES['kepfajl']['type']) {
            case 'image/png':
                $kiterjesztes = ".png";
                break;
            case 'image/jpeg':
                $kiterjesztes = ".jpg";
                break;
            default:
                break;
        }
        $from = $_FILES['kepfajl']['tmp_name'];
        $to = dir(getcwd());
        $to = $to->path . DIRECTORY_SEPARATOR . "autok" . DIRECTORY_SEPARATOR . $marka . $kiterjesztes;
        if (copy($from, $to)) {
            echo '<p>A kép feltöltés sikeres</p>';
        } else {
            echo '<p>A kép feltöltés sikertelen!</p>';
        }
    }
    if ($db->setKivalasztottAuto($autotid, $marka, $tipus, $gyartasi_ido, $kivitel, $megjegyzes, $nyilvantartasban)) {
        echo '<p>Az adatok módosítása sikeres</p>';
        header("Location: index.php?menu=home");
    } else {
        echo '<p>Az adatok módosítása sikertelen!</p>';
    }
} else {
    $adatok = $db->getKivalasztottAuto($id);
}
?>

<form method="post" action="index.php?menu=home&id=<?php echo $adatok['autoid']; ?>" enctype="multipart/form-data">
    <input type="hidden" name="allatid" value="<?php echo $adatok['autoid']; ?>">
    <div class="mb-3">
        <label for="marka" class="form-label">Autó márkája</label>
        <input type="text" class="form-control" name="marka" id="marka" value="<?php echo $adatok['marka']; ?>">
    </div>
    <div class="row">
        <div class="mb-3 col-6">
            <label for="tipusSelect" class="form-label">Autó típusa</label>
            <select id="tipusSelect" name="tipusSelect" class="form-select">
                <?php
                foreach ($db->getTipusok() as $value) {
                    if ($adatok['tipus'] == $value[0]) {
                        echo '<option selected value="' . $value[0] . '">' . $value[0] . '</option>';
                    } else {
                        echo '<option value="' . $value[0] . '">' . $value[0] . '</option>';
                    }
                }
                ?>

            </select>
        </div>
        <div class="mb-3 col-6">
            <label for="kivitelSelect" class="form-label">Kivitel</label>
            <select id="kivitelSelect" name="kivitelSelect" class="form-select">
                <?php
                foreach ($db->getKivitelek() as $value) {
                    if ($adatok['kivitel'] == $value[0]) {
                        echo '<option selected value="' . $value[0] . '">' . $value[0] . '</option>';
                    } else {
                        echo '<option value="' . $value[0] . '">' . $value[0] . '</option>';
                    }
                }
                ?>

            </select>
        </div>
    </div>
    <div class="row">
        <div class="mb-3 col-6">
            <label for="gyartasi_ido" class="form-label">Gyártási idő</label>
            <input type="date" class="form-control" name="gyartasi_ido" id="gyartasi_ido" max="<?php echo date("Y-m-d"); ?>" value="<?php echo $adatok['gyartasi_ido']; ?>">
        </div>
    </div>
    <div class="row">
        <div class="mb-3 col-6">
            <label for="nyilvantartasban" class="form-label">Nyilvántartásba vétel</label>
            <input type="date" class="form-control" name="nyilvantartasban" id="nyilvantartasban" max="<?php echo date("Y-m-d"); ?>"  value="<?php echo $adatok['gyartasi_ido']; ?>">
        </div>

    </div>
    <div class="row">
        <div class="mb-3 col-4">
            <label for="kepfajl" class="form-label">Képfájl</label>
            <input type="file" class="form-control" name="kepfajl" id="kepfajl" value="">
        </div>

    </div>
    <button type="submit" class="btn btn-success" value="1" name="Adatmodositas">Módosítás</button>
    <a href="index.php?menu=autokolcsonzesUser&autotid=<?php echo $adatok['autoid']; ?>" class="btn btn-primary">Autó kikölcsönzése</a>
</form>
<?php ?>