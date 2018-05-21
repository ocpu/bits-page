<?php
preg_match("/en|sv/", $_SERVER["HTTP_ACCEPT_LANGUAGE"], $match); 
$LANG = $match[0] ?: "en";
$MARKDOWN = new Parsedown();
