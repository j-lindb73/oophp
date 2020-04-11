<?php


require __DIR__ . "/autoload.php";
require __DIR__ . "/config.php";
// require __DIR__ . "/session.php";

// Take care of incoming
$doInit = $_POST["doInit"] ?? null;
$doGuess = $_POST["doGuess"] ?? null;
$doCheat = $_POST["doCheat"] ?? null;
$guess = $_POST["guess"] ?? null;
$number = $_POST["number"] ?? null;
$tries = $_POST["tries"] ?? null;


// if ((!isset($_SESSION["guess"])) || $doInit)  {
if ($doInit || $number === null) {
    $number = rand(1, 100);
    $tries = 5;
} elseif ($doGuess) {
    $tries -= 1;
    if ($guess === $number) {
        $res = "Correct!";
    } elseif ($guess > $number) {
        $res = "Too high";
    } else {
        $res = "Too low";
    }
}
//
// $number = $_SESSION["number"]);
// $tries = $_SESSION["tries"]);

?>

<html>
<body>


<form method="post">
    <input type="text" name="guess">
    <input type="hidden" name="number" value="<?= $number ?>">
    <input type="hidden" name="tries" value="<?= $tries ?>">
    <input type="submit" name="doGuess" value="Make a guess">
    <input type="submit" name="doInit" value="Restart">
    <input type="submit" name="doCheat" value="Cheat">

</form>

<?php if ($doGuess) : ?>
    <p>Your guess: <?= $guess ?> is <b><?= $res ?></b></p>
<?php endif; ?>

<?php if ($doCheat) : ?>
    <p>CHEAT Current number is <?= $number ?>. </p>
<?php endif; ?>

<pre>
<?php

var_dump($doGuess);
?>

</body>
</html>
