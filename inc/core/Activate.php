<?php
/**
 * @package LibraryBookSearch
*/

namespace INC_DIR\core;

class Activate
{
    public static function activate() {
        flush_rewrite_rules();
    }
}