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

use Drewlabs\XML\Contracts\XMLDocumentFactoryInterface;
use Drewlabs\XML\Contracts\XMLDocumentInterface;

class XMLDocumentFactory implements XMLDocumentFactoryInterface
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

    /**
     * Creates new XML document factory instance
     * 
     * @return XMLDocumentFactory 
     */
    public static function new()
    {
        $xml = new \XMLWriter();
        $xml->openMemory();
        return new self($xml);
    }

    public function create(XMLDocumentInterface $document)
    {
        $this->xml->startDocument($document->version(), $document->encoding(), $document->standalone());
        if ($root = $document->getRoot()) {
            $root = is_iterable($root) ? $root : [$root];
            foreach ($root as $iteration) {
                $this->xml->writeRaw(XMLElementFactory::new()->create($iteration));
            }
        }
        $this->xml->endDocument();
        return $this->xml->outputMemory();
    }


    public function __destruct()
    {
        $this->xml->flush();
    }
}
