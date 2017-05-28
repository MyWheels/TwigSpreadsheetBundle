<?php

namespace MewesK\TwigSpreadsheetBundle\Twig\TokenParser;

use MewesK\TwigSpreadsheetBundle\Twig\Node\XlsSheetNode;

/**
 * Class XlsSheetTokenParser
 *
 * @package MewesK\TwigSpreadsheetBundle\Twig\TokenParser
 */
class XlsSheetTokenParser extends AbstractTokenParser
{
    /**
     * @param \Twig_Token $token
     *
     * @return XlsSheetNode
     * @throws \Twig_Error_Syntax
     */
    public function parse(\Twig_Token $token)
    {
        // parse attributes
        $title = new \Twig_Node_Expression_Constant(null, $token->getLine());
        if (!$this->parser->getStream()->test(\Twig_Token::PUNCTUATION_TYPE) && !$this->parser->getStream()->test(\Twig_Token::BLOCK_END_TYPE)) {
            $title = $this->parser->getExpressionParser()->parseExpression();
        }
        $properties = $this->parseProperties($token);
        $this->parser->getStream()->expect(\Twig_Token::BLOCK_END_TYPE);

        // parse body
        $body = $this->parseBody();

        // return node
        return new XlsSheetNode($title, $properties, $body, $token->getLine(), $this->getTag());
    }

    /**
     * @return string
     */
    public function getTag()
    {
        return 'xlssheet';
    }
}
