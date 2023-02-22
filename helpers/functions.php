<?php

declare(strict_types=1);

function readMore(string $body): string {

    return substr($body, 0, 100).'...';
}
?>
