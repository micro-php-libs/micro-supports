<?php
/**
 * This file is part of DBCSoft Standard Package
 *
 * (c) Ty Huynh <hongty.huynh@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace MicroPhpLibs\RavelSupports;

use Illuminate\Support\Traits\Macroable;

class CommonHelper
{
    use Macroable;

    /**
     * @param string $trait
     * @param mixed $instance
     * @return bool
     */
    public static function hasUse(string $trait, $instance)
    {
        return in_array($trait, class_uses($instance));
    }
}
