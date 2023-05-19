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

use Drewlabs\XML\Contracts\XMLAttributeInterface;

class XMLAttribute implements XMLAttributeInterface
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string|string[]
     */
    private $value;

    /**
     * Creates class intances
     * 
     * @param string $name 
     * @param string|string[] $value 
     */
    public function __construct(string $name, $value = '')
    {
        $this->name = $name;
        $this->value =  $value ?? '';
    }

    public function __set($name, $value)
    {
        throw new \Exception(__CLASS__ . ' properties are not mutable.');
    }

    public function name(): string
    {
        return $this->name;
    }

    public function value()
    {
        return is_array($this->value) ? implode(" ", $this->value) : (string)$this->value ?? '';
    }
}
