<?php

/**
 * Test textfilters
 */
$app->router->get("textfilter", function () use ($app) {
    $title = "Test textfilter | oophp";

    $tf = new Lefty\TextFilter\MyTextFilter;

    $bbcodeRaw = "[b]Bold text[/b] [i]Italic text[/i] [url=http://dbwebb.se]a link to dbwebb[/url].";
    $bbcode = $tf->parse($bbcodeRaw, ["bbcode"]);

    $linkRaw = <<<EOD
    This link should for example be made clickable: http://dbwebb.se 
    and so should this link http://dbwebb.se/kod-exempel/function_to_make_links_clickable/
    and so should this: http://dbwebb.se/kod-exempel/function_to_make_links_clickable#id.
    EOD;

    $link = $tf->parse($linkRaw, ["link"]);

    $mdRaw = <<<EOD
### Header level 3 {#id3}

Here will be a table.
    
| Header 1 | Header 2     | Header 3 | Header 4      |
|----------|:-------------|:--------:|--------------:|
| Data 1   | Left aligned | Centered | Right aligned |
| Data     | Data         | Data     | Data          |

Here is a paragraph with some **bold** text and some *italic* text and a [link to dbwebb.se](http://dbwebb.se).
EOD;

    $md = $tf->parse($mdRaw, ["markdown"]);

    $newlineRaw = <<<EOD
Tanken är att 


denna text kommer 3 rader ner...
EOD;

    $newline = $tf->parse($newlineRaw, ["nl2br"]);
    

    $app->page->add("textfilter/textfilterTest", [
        "bbcodeRaw" => $bbcodeRaw,
        "bbcode" => $bbcode,
        "linkRaw" => $linkRaw,
        "link" => $link,
        "mdRaw" => $mdRaw,
        "md" => $md,
        "newlineRaw" => $newlineRaw,
        "newline" => $newline
    ]);

    return $app->page->render([
        "title" => $title,
    ]);
});
