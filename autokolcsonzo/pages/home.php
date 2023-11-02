<div class="row">
    <?php
    foreach ($db->osszesAuto() as $row) {
        $image = null;
        if (file_exists("./autok/" . $row['marka'] . ".jpg")) {
            $image = "./autok/" . $row['marka'] . ".jpg";
        } else if (file_exists("./autok/" . $row['marka'] . ".jpeg")) {
            $image = "./autok/" . $row['marka'] . ".jpeg";
        } else if (file_exists("./autok/" . $row['marka'] . ".png")) {
            $image = "./autok/" . $row['marka'] . ".png";
        } else {
            $image = "./images/noimage.png";
        }
        $card = '<div class="card" style="width: 18rem;">
                    <img src="'.$image.'" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">' . $row['marka'] . '</h5>' .
                '<p class="card-text">gyártási idő: ' . $row['gyartasi_ido'] . '</p>' .
                '<p class="card-text">nálunk: ' . $row['nyilvantartasban'] . '</p>' .
                '<a href="index.php?menu=home&id=' . $row['autoid'] . '" class="btn btn-primary">Kiválaszt</a>
                    </div>
                </div>
            ';
        echo $card;
    }
    ?>

</div>