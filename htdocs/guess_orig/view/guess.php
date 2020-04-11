<html>
<head>
<link href="https://fonts.googleapis.com/css2?family=Indie+Flower&display=swap" rel="stylesheet">
<link rel="stylesheet" href="css/style.css" />
</head>
<body>
<header>
    <h1>Guess which number</h1>
    <h3>...between 1-100...</h3>
</header>
<form method="post" action="guess_process.php">
    <input type="text" name="guess">
    <p>
    <input id="submit" type="submit" name="doGuess" value="Make a guess">
    <input id="submit" type="submit" name="doInit" value="Restart">
    <input id="submit" type="submit" name="doCheat" value="Cheat">
    </p>
</form>

<p class="result"><?= $message ?></p>

<?php if ($doCheat) : ?>
    <p>CHEAT Current number is <?= $number ?>. </p>
<?php endif; ?>
