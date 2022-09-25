<?php
/**
 * @package LibraryBookSearch
*/

namespace INC_DIR\core;

class Deactivate
{
    public static function deactivate() {
        flush_rewrite_rules();
    }
}