<?php

declare(strict_types=1);

function readMore(string $content): string {

    return substr($content, 0, 100).'...';
}

//moet ik user zoekn met id uit cookie opslaan in users en die tonen in detail blog page

?>
