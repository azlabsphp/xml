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

use Drewlabs\XML\XMLAttribute;
use Drewlabs\XML\XMLElement;
use Drewlabs\XML\XMLElementFactory;
use PHPUnit\Framework\TestCase;

/** @package Drewlabs\Support\Tests\Unit */
class XMLElementFactoryTest extends TestCase
{
    public function testCreateXMLElement()
    {
        $xml = new \XMLWriter();
        $xml->openMemory();
        $element = XMLElementFactory::new()->create(
            new XMLElement(
                'BaseRequest',
                new XMLElement(
                    'RequestData',
                    new XMLElement(
                        'PingID',
                        99
                    ),
                    'ser',
                    new  XMLAttribute(
                        'xsi:type',
                        'PingRequest'
                    ),
                    'http://gtplimited.com/',
                ),
                'gtp'
            )
        );

        file_put_contents(__DIR__ . '/Stubs/resources.xml', $element);
        $xml->startDocument();
        $xml->writeRaw($element);
        $xml->endDocument();
        $this->assertSame($element, '<gtp:BaseRequest><ser:RequestData xsi:type="PingRequest" xmlns="http://gtplimited.com/"><PingID>99</PingID></ser:RequestData></gtp:BaseRequest>');
    }
}
