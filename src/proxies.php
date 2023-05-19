<?php


namespace Drewlabs\XML\Proxy;

use Drewlabs\XML\XMLAttribute;
use Drewlabs\XML\XMLDocument;
use Drewlabs\XML\Contracts\XMLAttributeInterface;
use Drewlabs\XML\Contracts\XMLElementInterface;
use Drewlabs\XML\XMLElement;

/**
 * Creates an XML element instance
 * 
 * @param string $name 
 * @param string|self[]|self $value 
 * @param string $namespace 
 * @param array $attributes 
 * @param null|string $xmlnamespace 
 * @return XMLElementInterface 
 * @throws InvalidArgumentException 
 */
function Element(string $name, $value = '', string $namespace = '', $attributes = [], string $xmlnamespace = null)
{
    return new XMLElement($name, $value, $namespace, $attributes, $xmlnamespace);
}


/**
 * Creates an XML attribute instance
 * 
 * @param string $name 
 * @param string|string[] $value 
 * @return XMLAttributeInterface 
 */
function Attribute(string $name, $value = '')
{
    return new XMLAttribute($name, $value);
}

/**
 * Creates new XML document instance
 * 
 * @param XMLElementInterface|XMLElementInterface[] $root
 * @param string $version 
 * @param string $encoding 
 */
function Document($root, string $version = '1.0', $encoding = 'utf-8')
{
    return new XMLDocument($root, $version, $encoding);
}
