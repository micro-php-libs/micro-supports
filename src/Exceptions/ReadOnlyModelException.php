<?php
/**
 * This file is part of DBCSoft Standard Package
 *
 * (c) Ty Huynh <hongty.huynh@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace MicroPhpLibs\MicroSupports\Exceptions;

use RuntimeException;

class ReadOnlyModelException extends RuntimeException
{
    /**
     * @param string $functionName
     * @param string $modelClassName
     * {@inheritDoc}
     */
    public function __construct(string $functionName, string $modelClassName, int $code = 0, \Throwable $previous = null)
    {
        $message = sprintf('Calling [%s] method on read-only model [%s] is not allowed.', $functionName, $modelClassName);
        parent::__construct($message, $code, $previous);
    }
}
