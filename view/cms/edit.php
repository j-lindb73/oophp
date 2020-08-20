<?php

namespace Anax\View;

/**
 * Render content within an article.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());

//var_dump($content);

?>



<form method="post">
    <fieldset>
    <legend>Edit</legend>
    <input type="hidden" name="contentId" value="<?= e($content->id) ?>"/>

    <p>
        <label>Title:<br> 
        <input type="text" name="contentTitle" value="<?= e($content->title) ?>"/>
        </label>
    </p>

    <p>
        <label>Path:<br> 
        <input type="text" name="contentPath" value="<?= e($content->path) ?>"/>
    </p>

    <p>
        <label>Slug:<br> 
        <input type="text" name="contentSlug" value="<?= e($content->slug) ?>"/>
    </p>

    <p>
        <label>Text:<br> 
        <textarea name="contentData"><?= e($content->data) ?></textarea>
     </p>

     <p>
         <label>Type:<br> 
         <input type="text" name="contentType" value="<?= e($content->type) ?>"/>
     </p>

     <p>
         <label>Filter:<br> 
         <input type="text" name="contentFilter" value="<?= e($content->filter) ?>"/>
     </p>

     <p>
         <label>Publish:<br> 
         <input type="datetime" name="contentPublish" value="<?= e($content->published) ?>"/>
     </p>

    <p>
        <button type="submit" name="doSave"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</button>
        <button type="reset"><i class="fa fa-undo" aria-hidden="true"></i> Reset</button>
        <button type="submit" name="doDelete"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
    </p>
    </fieldset>
</form>
