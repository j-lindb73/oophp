<?php

namespace Anax\View;

/**
 * Render content within an article.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());

?>


<h3>Textfilter</h3>

Nedan visas några exempel på text i råformat och dess mosvarighet när den körs igenom ett textfilter.
<h4>Bbcode</h4>
<p><u>Före:</u>
<?= $bbcodeRaw ?></p>
<p><u>Efter:</u>
<?= $bbcode ?></p>
<h4>Klickbara länkar</h4>
<p><u>Före:</u>
<?= $linkRaw ?></p>
<p><u>Efter:</u>
<?= $link ?></p>
<h4>Markdown text</h4>
<p><u>Före:</u>
<?= $mdRaw ?></p>
<p><u>Efter:</u>
<?= $md ?></p>
<h4>Newline till <?= htmlentities('<br>') ?></h4>
<p><u>Före:</u>
<?= $newlineRaw ?></p>
<p><u>Efter:</u>
<?= $newline ?></p>