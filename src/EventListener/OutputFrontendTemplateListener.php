<?php

namespace Guave\ConditionalFormFieldBundle\EventListener;

use Contao\CoreBundle\ServiceAnnotation\Hook;

/**
 * @Hook("outputFrontendTemplate")
 */
class OutputFrontendTemplateListener
{
    /**
     * Inject JavaScript
     *
     * @param string $buffer
     * @param string $template
     * @return string
     */
    public function __invoke(string $buffer, string $template): string
    {
        $arrForms = $GLOBALS['CONDITIONALFORMFIELDS'];
        foreach ($arrForms as $formId => $arrFields) {
            $arrTriggerFields = $this->generateTriggerFields($arrFields);
            $arrConditions = $this->generateConditions($arrFields);
            $arrAllFields = array_unique(array_merge($arrTriggerFields, array_keys($arrConditions)));

            $buffer = str_replace(
                '</body>',
                $this->generateJS($formId, $arrTriggerFields, $arrConditions, $arrAllFields) . '</body>',
                $buffer
            );
        }

        return $buffer;
    }

    /**
     * Generates the JS per form
     *
     * @param string $formId
     * @param array $arrTriggerFields
     * @param array $arrConditions
     * @param array $arrAllFields
     * @return string
     */
    private function generateJS(
        string $formId,
        array $arrTriggerFields,
        array $arrConditions,
        array $arrAllFields
    ): string {
        return '';
    }

    /**
     * @param array $arrFields
     * @return array
     */
    private function generateConditions(array $arrFields): array
    {
        $arrConditions = [];
        foreach ($arrFields as $name => $strCondition) {
            $arrConditions[$name] = $this->generateCondition($strCondition, 'js');
        }

        return $arrConditions;
    }

    /**
     * @param string $strCondition
     * @param string $strLanguage
     * @return string
     */
    private function generateCondition(string $strCondition, string $strLanguage): string
    {
        if ($strLanguage === 'js') {
            $strCondition = preg_replace("/\\$([A-Za-z0-9_]+)/u", 'values.$1', $strCondition);
        } else {
            $strCondition = str_replace('in_array', '@in_array', $strCondition);
            $strCondition = preg_replace("/\\$([A-Za-z0-9_]+)/u", '$arrPost[\'$1\']', $strCondition);
        }

        return 'return (' . $strCondition . ');';
    }

    /**
     * @param array $arrFields
     * @return array
     */
    private function generateTriggerFields(array $arrFields): array
    {
        $arrTriggerFields = [];
        foreach ($arrFields as $strCondition) {
            if (preg_match_all('/\\$([A-Za-z0-9_]+)/u', $strCondition, $arrMatches)) {
                if ($arrMatches[1]) {
                    $arrTriggerFields = array_unique(array_merge($arrTriggerFields, $arrMatches[1]));
                }
            }
        }

        // The array must not be associative, see #32
        return array_values($arrTriggerFields);
    }
}
