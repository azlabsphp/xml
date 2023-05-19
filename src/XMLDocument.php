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

namespace Drewlabs\XML;

use Drewlabs\XML\Contracts\XMLDocumentInterface;
use Drewlabs\XML\Contracts\XMLElementInterface;
use InvalidArgumentException;

class XMLDocument implements XMLDocumentInterface
{
    /**
     * @var string
     */
    private $version = '1.0';

    /**
     * @var string
     */
    private $encoding = 'utf-8';

    /**
     * @var string|null
     */
    private $standalone;

    /**
     * @var XMLElementInterface|XMLElementInterface[]
     */
    private $root;

    /**
     * Creates class instances
     * 
     * @param XMLElementInterface|XMLElementInterface[] $root
     * @param string $version 
     * @param string $encoding 
     * @param string|null $standalone 
     */
    public function __construct($root, string $version = '1.0', $encoding = 'utf-8', string $standalone = null)
    {
        $this->version = $version ?? '1.0';
        $this->encoding = $encoding ?? 'utf-8';
        $this->standalone = $standalone;
        $this->setRoot($root);
    }

    /**
     * Creates new XML document factory instance
     * 
     * @param XMLElementInterface|XMLElementInterface[] $root
     * @param string $version 
     * @param string $encoding 
     * @param string|null $standalone 
     * @return XMLDocument 
     */
    public static function new($root, string $version = '1.0', $encoding = 'utf-8', string $standalone = null)
    {
        return new self($root, $version, $encoding, $standalone);
    }

    public function version(): string
    {
        return $this->version;
    }

    public function encoding(): string
    {
        return $this->encoding;
    }

    public function standalone(): ?string
    {
        return $this->standalone;
    }

    public function setRoot($value)
    {
        if (!is_iterable($value) && !($value instanceof XMLElementInterface)) {
            throw new InvalidArgumentException(sprintf('Expect document root to be an instance of %s or an iterable of %s', XMLElementInterface::class, XMLElementInterface::class));
        }
        $this->root = $value;
        return $this;
    }

    public function getRoot()
    {
        return $this->root;
    }
}
