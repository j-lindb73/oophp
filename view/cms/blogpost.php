<?php

namespace Anax\View;

?>


<article>
    <header>
        <h1><?= e($content->title) ?></h1>
        <p><i>Published: <time datetime="<?= e($content->published_iso8601) ?>" pubdate><?= e($content->published) ?></time></i></p>
    </header>
    <?= $content->data ?>
</article>
