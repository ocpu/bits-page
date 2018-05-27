<?php
$routes = [
    "/^\/$|^\/home\/?|^\/home.html/" => [
        "title" => $LANG === "sv" ? "Hem" : "Home",
        "path" => "/",
        "page" => "home"
    ],
    "/^\/about\/?|^\/about.html/" => [
        "title" => $LANG === "sv" ? "Om" : "About",
        "path" => "/about",
        "page" => "about"
    ]
];
