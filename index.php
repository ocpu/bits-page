<?php

$ROOT = __DIR__;
foreach_file(__DIR__ . "/lib", function ($file) {
    include_once __DIR__ . "/lib/$file";
});
foreach_file(__DIR__ . "/config", function ($file) {
    include_once __DIR__ . "/config/$file";
});

foreach ($routes as $matcher => $current_route) {
    if (preg_match($matcher, $_SERVER["REQUEST_URI"]))
        break;
}
?><!DOCTYPE html>
<html lang="<?=$LANG?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <?php foreach_file(__DIR__ . "/styles", function ($file) use ($current_route) {
        echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"/styles/$file\" media=\"screen\">";
    })?>
    <?php foreach_file(__DIR__ . "/styles/" . $current_route["page"], function ($file) use ($current_route) {
        echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"/styles/".$current_route["page"]."/$file\" media=\"screen\">";
    })?>
    <?php foreach_file(__DIR__ . "/js", function ($file) use ($current_route) {
        echo "<script type=\"text/javascript\" src=\"/js/$file\" async defer>";
    })?>
    <?php foreach_file(__DIR__ . "/js/" . $current_route["page"], function ($file) use ($current_route) {
            echo "<script type=\"text/javascript\" src=\"/js/".$current_route["page"]."/$file\" async defer>";
    })?>
    <title><?= $current_route["title"]?> - BITS</title>
</head>
<body>
    <header>
        <a href="/home"><img src="/img/bits-haj.png" alt="BITS logo"></a>
        <h1><?= $current_route["title"]?></h1>
    </header>
    <div class="content">
        <nav>
            <ul>
                <?php foreach ($routes as $_ => $meta) {
                    echo "<li><a href=\"".$meta["path"]."\">".$meta["title"]."</a></li>";
                }?>
            </ul>
        </nav>
        <main>
            <?php include __DIR__ . "/pages/".$current_route["page"].".php"; ?>
        </main>
    </div>

    <!-- Temporary TODO list -->
    <!-- <div style="position:fixed;top:0;right:0;width:10vw">
        <h1>Todo</h1>
        <ul>
            <li>Tentor</li>
            <li>Evenemang</li>
            <li>Contact</li>
            <li>Message board</li>
        </ul>
    </div> -->
    <footer>
        <div class="part1"></div>
        <div class="part2"></div>
        <div class="part3"></div>
    </footer>
</body>
</html>
