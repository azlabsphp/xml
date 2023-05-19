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

use Drewlabs\XML\Contracts\XMLAttributeFactoryInterface;
use XMLWriter;

class XMLAttributeFactory implements XMLAttributeFactoryInterface
{
    /**
     * Private instance of {XMLWriter}.
     *
     * @var \XMLWriter
     */
    private $xml;

    /**
     * Creates class instance
     * 
     * @param XMLWriter $xml 
     */
    public function __construct(\XMLWriter $xml)
    {
        $this->xml = $xml;
    }

    public function create($attribute)
    {
        $this->xml->startAttribute($attribute->name());
        $this->xml->text((string) $attribute->value());
        $this->xml->endAttribute();
        return $this->xml;
    }

    public function __destruct()
    {
        // Provide cleanup implementation
    }
}
