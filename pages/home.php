<?php
foreach_file($ROOT . "/posts", function ($file) use ($MARKDOWN) {
    if ($file === '_example.md') return
    $post = extract_post($GLOBALS["ROOT"] . "/posts/$file", $MARKDOWN);
    $title = $post["data"]["title"];
    $slug = str_replace(" ", "-", strtolower($title));
    $content= $post["content"];
    
    echo <<<ARTICLE
<article>
    <header>
        <h2><a href="#$slug">$title</a></h2>
    </header>
    $content
</article>
ARTICLE;
});
