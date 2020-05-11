<div class="dice-play">
<p>Omgångens poäng:</p>
<p class="dice-score"> <?= $roundScore ?></p>

<p>Senaste kast </p>
<p class="dice-score"> <?= $rollScore ?></p>

</div> <!-- Stänger dice-play --> 
<div class="dice-throw" >
<p><?= $currentPlayer->getName() ?>  </p>
<p>
<?php foreach ($currentPlayer->getPlayerHand()->getGraphics() as $value) : ?>
    <i class="dice-sprite <?= $value ?>"></i>
<?php endforeach; ?>
</p>
</div>
</div> <!-- Stänger dice-container --> 
<div class="dice-buttons">

<?php if ($badThrow) : ?>
    <form method="get" action="newround">
        <input type="submit" value="Fortsätt">
    </form>
<?php elseif ($isComputer) : ?>
    <form method="get" action="<?= $computerChoice[0] ?>">    
        <input type="submit" value="<?= $computerChoice[1] ?>">
    </form>
<?php else : ?>
    <form method="get" action="roll">    
        <input type="submit" value="Kasta">
    </form>
    <form method="get" action="save">
        <input type="submit" value="Spara">
    </form>
        
<?php endif ?>


<form method="get" action="init">

<input type="submit" value="Börja om">
</form>

</div> <!-- Stänger dice-buttons --> 
