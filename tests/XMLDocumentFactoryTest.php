<?php

use Drewlabs\XML\XMLAttribute;
use Drewlabs\XML\XMLDocument;
use Drewlabs\XML\XMLDocumentFactory;
use Drewlabs\XML\XMLElement;
use PHPUnit\Framework\TestCase;

class XMLDocumentFactoryTest extends TestCase
{

    public function test_Create_XML_Document()
    {
        $document = XMLDocumentFactory::new()->create(
            new XMLDocument(
                new XMLElement(
                    'html',
                    [
                        new XMLElement(
                            'header',
                            '',
                            '',
                            [new XMLAttribute('lang', 'fr')]
                        ),
                        new XMLElement(
                            'body',
                            new XMLElement(
                                'p',
                                'Hello World'
                            ),
                            '',
                            [new XMLAttribute('class', ['ng-body', 'html-body'])]
                        )
                    ],
                    '',
                    [],
                    "http://www.w3.org/1999/xhtml"
                ),
                '1.1'
            )
        );

        file_put_contents(__DIR__ . '/Stubs/document.xml', $document);
        $this->assertTrue(false !== strpos($document, '<html xmlns="http://www.w3.org/1999/xhtml"><header lang="fr"></header><body class="ng-body html-body"><p>Hello World</p></body></html>'));
        $this->assertTrue(false !== strpos($document, '<?xml version="1.1" encoding="UTF-8"?>'));
    }
}
