<?php

declare(strict_types=1);

/*
 * This file is part of the Drewlabs package.
 *
 * (c) Sidoine Azandrew <azandrewdevelopper@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Drewlabs\XML\Contracts;

interface XMLAttributeFactoryInterface
{
    /**
     * Create an xml string represeting the configuration
     * passed as parameter.
     *
     * @param XMLAttributeInterface[]|XMLAttributeInterface $config
     *
     * @return \XMLWriter
     */
    public function create($config);
}
