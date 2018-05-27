<?php
function starts_with(string $string, string $query) {
    return substr($string, 0, strlen($query)) === $query;
}

function ends_with(string $string, string $query) {
    return substr($string, strlen($string) - strlen($query)) === $query;
}

function extract_post($path, $parser) {
    $file = file_get_contents($path);
    $data = null;
    if (starts_with($file, "---")) {
        preg_match("/---\n([\s\S]*)\n\.\.\.\n?/iuU", $file, $matches);
        $file = str_replace($matches[0], "", $file);
        $data = spyc_load($matches[1]);
        while (preg_grep("/.+@(en|sv)/", array_keys($data))) {
            $keys = preg_grep("/.+@(en|sv)/", array_keys($data));
            preg_match("/(.+)@(en|sv)/", $keys[0], $match);
            $data[$match[1]] = 
                $match[2] === "sv" && $GLOBALS["LANG"] === "sv" ? $data[$keys[0]] :
                $match[2] === "sv" && $GLOBALS["LANG"] === "en" ? $data[$keys[1]] :
                $match[2] === "en" && $GLOBALS["LANG"] === "sv" ? $data[$keys[1]] :
                $match[2] === "en" && $GLOBALS["LANG"] === "en" ? $data[$keys[0]] :
                ""
            ;
            unset($data[$keys[0]]);
            unset($data[$keys[1]]);
        }
    }

    $languageContent = explode("<hr />", $parser->text($file));
    $swedish = $languageContent[0];
    $english = $languageContent[1];
    $content = $GLOBALS["LANG"] === "sv" ? $swedish : $GLOBALS["LANG"] === "en" ? $english : "";

    return [
        "content" => $content,
        "data" => $data
    ];
}

function foreach_dir(string $path, callable $callback) {
    if (file_exists($path)) foreach (scandir($path) as $file) {
        if ($file === "." || $file === "..") continue;
        $callback($file);
    }
}

function foreach_file(string $path, callable $callback) {
    if (file_exists($path)) foreach (scandir($path) as $file) {
        if ($file === "." || $file === ".." || !is_file($path."/".$file)) continue;
        // call_user_func($callback, $file);
        $callback($file);
    }
}
