
<h1>Vinnare är <?= $winner ?></h1>

<form method="get" action="init">
    <input id="submit" type="submit" name="doInit" value="Börja om">
</form>

</div> 
<div class="dice-histogram"><?= $histogram->printHistogram() ?></div> 