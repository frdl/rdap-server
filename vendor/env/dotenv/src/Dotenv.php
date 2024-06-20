<?php

declare(strict_types=1);

namespace Env;

use \ErrorException;
use \ValueError;

use function \parse_ini_file;
use function \realpath;

use const \INI_SCANNER_RAW;
use const \INI_SCANNER_TYPED;

final class Dotenv
{
    public static function toArray(string $path, bool $strict = true): array
    {
        $realpath = realpath($path);
        if (false === $realpath) {
            throw new ValueError("File `$path` not found");
        }
        $env = parse_ini_file(
            filename: $realpath,
            process_sections: false,
            scanner_mode: ($strict)
                ? INI_SCANNER_RAW
                : INI_SCANNER_TYPED
        );
        if ($env) {
            return $env;
        }
        throw new ErrorException("Unable to parse $realpath");
    }
}
