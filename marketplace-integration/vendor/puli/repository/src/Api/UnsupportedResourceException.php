<?php

/*
 * This file is part of the puli/repository package.
 *
 * (c) Bernhard Schussek <bschussek@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Puli\Repository\Api;

use RuntimeException;

/**
 * Thrown when a specific implementation of {@link Resource\PuliResource} is not accepted by
 * the invoked method.
 *
 * @since  1.0
 *
 * @author Bernhard Schussek <bschussek@gmail.com>
 */
class UnsupportedResourceException extends RuntimeException
{
}
