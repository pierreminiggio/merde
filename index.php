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

foreach ($languages as $languageIndex => $language) {
    if ($languageIndex > 0) {
        echo '<br>';
    }
    echo $language . ' c\'est de la merde';
}
