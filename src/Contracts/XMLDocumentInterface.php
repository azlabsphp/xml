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

interface XMLDocumentInterface
{
    /**
     * XML document version
     * 
     * @return string 
     */
    public function version(): string;

    /**
     * XML document encoding
     * 
     * @return string 
     */
    public function encoding(): string;

    /**
     * True if the xml document is a standalone document, else False
     * 
     * @return string|null 
     */
    public function standalone(): ?string;

    /**
     * Set the XML body node
     * 
     * @param XMLElementInterface|XMLElementInterface[] $value
     * 
     * @return self 
     */
    public function setRoot($value);

    /**
     * Returns the XML document body element. The body node is a single
     * node that might have one or many child nodes
     * 
     * @return XMLElementInterface|XMLElementInterface[]|null 
     */
    public function getRoot();

}