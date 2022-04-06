<?php
//Require database in this file & image helpers
/** @var mysqli $db */
require_once "includes/database.php";

$mark = "";
//Check if Post isset, else do nothing
if (isset($_POST['submit'])) {
    //Postback with the data showed to the user, first retrieve data from 'Super global'
    $reserverenId = mysqli_escape_string($db, $_POST['id']);
    $name = mysqli_escape_string($db, $_POST['naam']);
    $telnr = mysqli_escape_string($db, $_POST['telefoonnummer']);
    $mail = mysqli_escape_string($db, $_POST['mail']);
    $datum = mysqli_escape_string($db, $_POST['datum']);
    $time = mysqli_escape_string($db, $_POST['tijd']);
    $personen = mysqli_escape_string($db, $_POST['personen']);
    $opmerkingen = mysqli_escape_string($db, $_POST['opmerkingen']);

//Check if data is valid & generate error if not so

    $errors = "";
    if ($name == "" || $telnr == "" || $mail == "" || $datum == "" || $time == "") {
        $errors = '* Field is mandatory';
        $mark = '*';
    }

    if (!is_numeric($personen) || strlen($personen) != 1 && strlen($personen) != 2) {
        $errors = '*' ;
        $mark = '* Field is mandatory';
    }

    //Update the reservation in the database
    $stmt = $db->prepare("UPDATE `reserveringssysteem`
                  SET naam = ?, `telefoonnummer` = ?, `mail` = ?, `datum` = ?, `tijd` = ?, `personen` = ?, `opmerkingen` = ?
                  WHERE `id` = ?");
    $stmt->bind_param("sisssisi", $name, $telnr, $mail, $datum, $time, $personen, $opmerkingen, $reserverenId);

    $stmt->execute();

    //Save variables to array so the form won't break
    //This array is build the same way as the db result
    $reserveren = [
        'id' => $reserverenId,
        'naam' => $name,
        'telefoonnummer' => $telnr,
        'mail' => $mail,
        'datum' => $datum,
        'tijd' => $time,
        'personen' => $personen,
        'opmerkingen' => $opmerkingen,
    ];

    //Update the reservation in the database

    if (empty($errors)) {
        header('Location: overzicht.php');
        exit;
    } else {
        $errors = 'Something went wrong in your database query: ' . mysqli_error($db);
    }


} else if (isset($_GET['id'])) {
    //Retrieve the GET parameter from the 'Super global'
    $reserverenId = $_GET['id'];

    //Get the record from the database result
    $query = "SELECT * FROM reserveringssysteem WHERE id = " . mysqli_escape_string($db, $reserverenId);
    $result = mysqli_query($db, $query);
    if (mysqli_num_rows($result) == 1) {
        $reserveren = mysqli_fetch_assoc($result);
    } else {
        // redirect when db returns no result
        header('Location: overzicht.php');
        exit;
    }
} else {
    header('Location: overzicht.php');
    exit;
}

//Close connection
mysqli_close($db);
?>
<!doctype html>
<html lang="en">
<head>
    <title>Edit - <?= $reserveren['id'] . ' - ' . $reserveren['naam'] ?></title>
    <span><?= $mark ?> </span>
    <meta charset="utf-8"/>
    <link rel="stylesheet" type="text/css" href="css/editstyle.css"/>
</head>
<body>
<style>
    h1 {
        color: white;
    }
</style>
<h1>Edit - <?= $reserveren['id'] . ' - ' . $reserveren['naam'] ?></h1>


<?php if (isset($success)) { ?>
    <p class="success">Je reservering is bijgewerkt in de database</p>
<?php } ?>


<form action="<?= htmlspecialchars($_SERVER['REQUEST_URI']); ?>" method="post" enctype="multipart/form-data">
    <div class="data-field">
        <label for="Uw Naam">Naam</label>
        <input id="naam" type="text" placeholder="Uw Naam" name="naam" value="<?= $reserveren['naam'] ?>"/>
        <span class="errors"><span><?= $errors ?></span></span>
    </div>
    <div class="data-field">
        <label for="Uw Telefoonnummer">Telefoonnummer</label>
        <input id="telefoonnummer" type="text" placeholder="Uw Telefoonnummer" name="telefoonnummer" value="<?= $reserveren['telefoonnummer'] ?>"/>
        <span class="errors"><span><?= $errors ?></span></span>
    </div>
    <div class="data-field">
        <label for="Uw E-mail">Email</label>
        <input id="email" type="email" placeholder="Uw E-mail" name="mail" value="<?= $reserveren['mail'] ?>"/>
        <span class="errors"><span><?= $errors ?></span></span>
    </div>
    <div class="data-field">
        <label for="dd-mm-jjjj">Datum</label>
        <input id="dd-mm-jjjj" type="date" placeholder="Datum" name="datum" value="<?= $reserveren['datum'] ?>" />
        <span class="errors"><span><?= $errors ?></span></span>
    </div>
    <div class="data-field">
        <label for="Tijd">Tijd</label>
        <input id="tijd" type="time" placeholder="Tijd" name="tijd" value="<?= $reserveren['tijd'] ?>" />
        <span class="errors"><span><?= $errors ?></span></span>
    </div>
    <div class="data-field">
        <label for="Aantal Personen">Aantal Personen</label>
        <input id="personen" type="number" placeholder="Aantal Personen" name="personen" value="<?= $reserveren['personen'] ?>"/>
        <span class="errors"><span><?= $errors ?></span></span>
    </div>
    <div class="data-field">
        <label for="Opmerkingen">Opmerkingen</label>
        <input id="opmerkingen" type="text" placeholder="Opmerkingen" name="opmerkingen" value="<?= $reserveren['opmerkingen'] ?>"/>
        <span class="errors"><span><?= $errors ?></span></span>
    </div>
    <div class="data-submit">
        <input type="hidden" name="id" value="<?= $reserverenId ?>"/>
        <input type="submit" class="btn" name="submit" value="Save"/>
    </div>
</form>
<form action="overzicht.php">
    <input type="submit" class="btn" value="Ga terug naar reserveringslijst"/>
</form>
</body>
</html>