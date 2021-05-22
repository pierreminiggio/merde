<?php

$wikiFile = __DIR__ . DIRECTORY_SEPARATOR . 'wiki.html';

if (! file_exists($wikiFile)) {
    $curl = curl_init('https://fr.wikipedia.org/wiki/Liste_de_langages_de_programmation');
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    file_put_contents($wikiFile, curl_exec($curl));
}

$wikiPage = file_get_contents($wikiFile);

$splitOnLetterContainersStart = explode('class="colonnes">', $wikiPage);

$languages = [];

foreach ($splitOnLetterContainersStart as $splitOnLetterContainerStartIndex => $splitOnLetterContainerStart) {
    if ($splitOnLetterContainerStartIndex === 0) {
        continue;
    }

    if ($splitOnLetterContainerStartIndex === 26) {
        $splitOnLetterContainerStart = explode('id="Notes_et_références"', $splitOnLetterContainerStart, 2)[0];
    }

    $splitOnLanguagesLinkStart = explode('<a href="', $splitOnLetterContainerStart);
    
    foreach ($splitOnLanguagesLinkStart as $splitOnLanguageLinkStartIndex => $splitOnLanguageLinkStart) {
        if ($splitOnLanguageLinkStartIndex === 0) {
            continue;
        }

        $splitOnLanguageLinkEnd = explode('">', $splitOnLanguageLinkStart, 2);
        
        if (count($splitOnLanguageLinkEnd) !== 2) {
            continue;
        }

        $linkBodyAndAfter = $splitOnLanguageLinkEnd[1];

        $splitOnLanguageLinkClose = explode('</a>', $linkBodyAndAfter, 2);

        if (count($splitOnLanguageLinkClose) !== 2) {
            continue;
        }

        $maybeALanguage = strip_tags($splitOnLanguageLinkClose[0]);

        if (
            in_array(
                $maybeALanguage,
                [
                    '',
                    '(en)',
                    '[1]',
                    '[2]',
                    '[3]',
                    '[4]',
                    '[5]',
                    '[6]',
                    '[7]',
                    '[8]',
                    '[9]',
                    '[10]',
                    '[11]',
                    '[12]'
                ]
            )
        ) {
            continue;
        }
        
        if (! in_array($maybeALanguage, $languages)) {
            $languages[] = $maybeALanguage;
        }
    }
}
echo    '<head>
<title>Les languages de merde</title>
<!--FrontEnd by BeowolfK-->
<!--<meta http-equiv="refresh" content="10" >-->
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="title" content="Les languages de merde">
<meta name="description" content="Voici la liste de tous les languages qui puent grave la merde">
<meta property="og:type" content="website">
<meta property="og:url" content="https://merde.ggio.fr/">
<meta property="og:title" content="Les languages de merde">
<meta property="og:description" content="Voici la liste de tous les languages qui puent grave la merde">
<meta property="og:image" content="http://assets.stickpng.com/images/5897a52fcba9841eabab614b.png">
<link rel="icon" href="http://assets.stickpng.com/images/5897a52fcba9841eabab614b.png">
<style>
    @keyframes animation{
        0%{
            opacity: 0;
            top: -10%;
            transform: translateX(20px) rotate(0deg);
        }
        10%{
            opacity: 1;
        }
        20%{
            transform: translateX(-20px) rotate(45deg);
        }
        40%{
            transform: translateX(-20px) rotate(90deg);
        }
        60%{
            transform: translateX(20px) rotate(180deg);
        }
        80%{
            transform: translateX(-20px) rotate(180deg);
        }
        100%{
            top: 110%;
            transform: translateX(-20px) rotate(225deg);
        }
    }
    *{
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        overflow-x: hidden;

    }
    p{
        padding: 5px;
    }
    body{
        position: relative;
        width: 100%;
        height: 100vh;
        background: radial-gradient(rgb(249, 249, 6),rgb(230, 230, 25))
    }
    #title{
        padding: 20px;
        font-family: \'Pattaya\', sans-serif; 
        text-align:center;
        z-index:1;
    }
    #languages{
        text-align:center;
        font-family: \'Newsreader\', serif;
        font-size: 20px;
        margin-top: 15px;
        z-index:1;
    }
    .caca{
        font-size: 50px;
        z-index: -1;
    }
    .set{
        position: fixed; !important
        position: absolute;
        bottom:0;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        pointer-events: none;
        overflow-y: hidden;

    }
    .set div{
        position: absolute;
        display: block;
        z-index: -1;

    }
    .set1{
        transform: scale(1);
        filter: blur(2px);
    }
    .set2{
        transform: scale(4);
        filter: blur(3px);
    }
    .set3{
        transform: scale(2);
    }
    .set div:nth-child(1){
        left:20%;
        animation: animation 15s linear infinite;
        animation-delay: -7s;
    }
    .set div:nth-child(2){
        left:80%;
        animation: animation 25s linear infinite;
        animation-delay: -15s;
    }
    .set div:nth-child(3){
        left:70%;
        animation: animation 25s linear infinite;
        animation-delay: -17s;
    }
    .set div:nth-child(4){
        left:0%;
        animation: animation 20s linear infinite;
        animation-delay: -5s;
    }
    .set div:nth-child(5){
        left:85%;
        animation: animation 23s linear infinite;
        animation-delay: -10s;
    }
    .set div:nth-child(6){
        left:0%;
        animation: animation 17s linear infinite;
    }
    .set div:nth-child(7){
        left:15%;
        animation: animation 19s linear infinite;
        animation-delay: -10s;
    }
    .set div:nth-child(8){
        left:60%;
        animation: animation 20s linear infinite;
    }
    .set div:nth-child(9){
        left:30%;
        animation: animation 20s linear infinite;
        animation-delay: -15s;
    }
    .set div:nth-child(10){
        left:10%;
        animation: animation 30s linear infinite;
        animation-delay: -8s;
    }



</style>
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Pattaya&amp;display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Newsreader&amp;display=swap" rel="stylesheet">

</head>';
echo '<h1 id="title">Voici la liste de tous les langages qui puent grave la merde</h1>';
echo '<div id="languages">';
foreach ($languages as $languageIndex => $language) {
    echo '<p>' . $language . ' c\'est de la merde</p>';
};
echo '</div>' . '<div class="set set1">
<div class="caca">💩</div>
<div class="caca">💩</div>
<div class="caca">💩</div>
<div class="caca">💩</div>
<div class="caca">💩</div>
<div class="caca">💩</div>
<div class="caca">💩</div>
<div class="caca">💩</div>
<div class="caca">💩</div>
<div class="caca">💩</div>

</div>
<div class="set set2">
<div class="caca">💩</div>
<div class="caca">💩</div>
<div class="caca">💩</div>
<div class="caca">💩</div>
<div class="caca">💩</div>
<div class="caca">💩</div>
<div class="caca">💩</div>
<div class="caca">💩</div>
<div class="caca">💩</div>
<div class="caca">💩</div>

</div>
<div class="set set3">
<div class="caca">💩</div>
<div class="caca">💩</div>
<div class="caca">💩</div>
<div class="caca">💩</div>
<div class="caca">💩</div>
<div class="caca">💩</div>
<div class="caca">💩</div>
<div class="caca">💩</div>
<div class="caca">💩</div>
<div class="caca">💩</div>

</div>';
