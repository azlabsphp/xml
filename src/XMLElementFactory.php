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
use Drewlabs\XML\Contracts\XMLElementFactoryInterface;
use Drewlabs\XML\Contracts\XMLElementInterface;
use XMLWriter;

class XMLElementFactory implements XMLElementFactoryInterface
{
    /**
     * Private instance of {XMLWriter}.
     *
     * @var \XMLWriter
     */
    private $xml;

    /**
     * Creates new class instance
     * 
     * @param XMLWriter $xml 
     */
    private function __construct(\XMLWriter $xml)
    {
        $this->xml = $xml;
    }

    /**
     * Creates new XML element factory instance
     * 
     * @return self 
     */
    public static function new()
    {
        $xml = new \XMLWriter();
        // // Use memomry for string output
        $xml->openMemory();
        return new self($xml);
    }

    public function create(XMLElementInterface $element)
    {
        $startElement = $element->namespace() && !empty($element->namespace()) ? sprintf('%s%s', $element->namespace() . ':', $element->name()) : $startElement = sprintf('%s', $element->name());

        if ($element->getIndent()) {
            $this->xml->setIndent(true);
        }

        $this->xml->startElement($startElement);

        // Write XML Element attributes
        $this->createNodeAttributesIfExists(new XMLAttributeFactory($this->xml), $element->attributes());

        // Write XML element values
        if (($value =  $element->value()) && \is_array($value) && \count($value)) {
            foreach ($value as $current) {
                $this->xml->writeRaw($this->create($current));
            }
        }
        if (!($value instanceof XMLElementInterface) && !\is_array($value)) {
            $this->xml->text((string) ($value ?? ''));
        }
        $this->xml->endElement();

        // Return the constructed xml element
        return $this->xml->outputMemory();
    }

    private function createNodeAttributesIfExists(XMLAttributeFactoryInterface $factory, $attributes)
    {
        if ($attributes && \is_array($attributes) && \count($attributes)) {
            foreach ($attributes as $value) {
                $this->xml = $factory->create($value);
            }
        }
    }

    public function __destruct()
    {
        // $this->xml->flush();
        // unset($this->xml);
    }
}
