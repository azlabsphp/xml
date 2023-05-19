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

use Drewlabs\XML\Contracts\XMLElementInterface;
use InvalidArgumentException;

/**
 * @property string $name
 * @property string $namespace
 * @property string|Node[] $value
 * @property XMLAttribute[] $attributes
 * 
 * @package Drewlabs\XML
 */
class XMLElement implements XMLElementInterface
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $namespace;

    /**
     * @var string|Node[]
     */
    private $value;

    /**
     * @var XMLAttribute[]
     */
    private $attributes;

    /**
     * 
     * @var bool
     */
    private $indent;

    /**
     * Creates class instance
     * 
     * @param string $name 
     * @param string|self[]|self $value 
     * @param string $namespace 
     * @param array $attributes 
     * @param null|string $xmlnamespace 
     * @return void 
     * @throws InvalidArgumentException 
     */
    public function __construct(string $name, $value = '', string $namespace = '', $attributes = [], string $xmlnamespace = null)
    {
        if (!\is_array($attributes) && !($attributes instanceof XMLAttribute) && !(null === $attributes)) {
            throw new \InvalidArgumentException(sprintf('Attribute property must be of type array or a %s', XMLAttribute::class));
        }
        $this->name = $name;
        $this->namespace = $namespace ?? '';
        $this->value = $value ?? '';
        $this->attributes = $attributes instanceof XMLAttribute ? [$attributes] : ($attributes ?? []);
        if ($xmlnamespace) {
            $this->attributes[] = new XMLAttribute('xmlns', $xmlnamespace);
        }
    }

    public function indent()
    {
        $this->indent = true;
        return $this;
    }

    public function getIndent()
    {
        return $this->indent;
    }

    public function __set($name, $value)
    {
        throw new \Exception(__CLASS__ . ' properties are not mutable.');
    }

    public function attributes()
    {
        return $this->attributes ? ($this->attributes instanceof XMLAttribute ? [$this->attributes] : $this->attributes) : [];
    }

    public function name(): string
    {
        return $this->name;
    }

    public function namespace()
    {
        return $this->namespace;
    }

    public function value()
    {
        return $this->value ? ($this->value instanceof self ? [$this->value] : $this->value) : '';
    }
}
