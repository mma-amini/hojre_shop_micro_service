<?php

namespace App\Libraries;

class Helpers {
    // Function for basic field validation (present and neither empty nor only white space
    public static function isNullOrEmptyString($str): bool {
        return ($str === null || trim($str) === '');
    }
}