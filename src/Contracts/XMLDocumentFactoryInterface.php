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

use Drewlabs\XML\Contracts\XMLDocumentInterface;

interface XMLDocumentFactoryInterface
{
    /**
     * Creates an xml document from `XMLDocumentInterface` definition
     * interface instance
     * 
     * @param XMLDocumentInterface $document
     * 
     * @return string|mixed 
     */
    public function create(XMLDocumentInterface $document);
}