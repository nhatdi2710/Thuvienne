<?php
function redirect(string $location): void {
    header("Location: $location", true, 302);
    exit;
}