<?php

namespace Guave\ConditionalFormFieldBundle\EventListener;

use Contao\CoreBundle\ServiceAnnotation\Hook;
use Contao\Form;
use Contao\FormFieldModel;

/**
 * @Hook("compileFormFields")
 */
class CompileFormFieldsListener
{
    protected static $fieldSets;

    /**
     * @param FormFieldModel[] $fields
     * @param string $formId
     * @param Form $form
     * @return array
     */
    public function __invoke(array $fields, string $formId, Form $form)
    {
        $formSubmitId = $form->id;
        $fieldSet = null;

        static::$fieldSets[$formSubmitId] = array();

        foreach ($fields as $field) {

            // Start the fieldset
            if (
                (($field->type === 'fieldset' && $field->fsType === 'fsStart') ||
                    $field->type === 'fieldsetStart') &&
                $field->isConditionalFormField
            ) {
                $fieldSet = $field->id;
                $condition = $this->generateCondition($field->conditionalFormFieldCondition, 'php');

                static::$fieldSets[$formSubmitId][$fieldSet] = array(
                    'condition' => function ($arrPost) use ($condition) {
                        return eval($condition);
                    },
                    'fields' => array(),
                );

                // JS
                $GLOBALS['CONDITIONALFORMFIELDS'][$formId][$field->id] = $field->conditionalFormFieldCondition;
                continue;
            }

            // Stop the fieldset
            if (
                ($field->type === 'fieldset' &&
                    $field->fsType === 'fsStop')
                || $field->type === 'fieldsetStop'
            ) {
                $fieldSet = null;
                continue;
            }

            if ($fieldSet === null) {
                continue;
            }

            static::$fieldSets[$formSubmitId][$fieldSet]['fields'][] = $field->id;
        }

        return $fields;
    }

    /**
     * @param string $strCondition
     * @param string $strLanguage
     * @return string
     */
    private function generateCondition(string $strCondition, string $strLanguage): string
    {
        if ($strLanguage === 'js') {
            $strCondition = preg_replace("/\\$([A-Za-z0-9_]+)/u", "values.$1", $strCondition);
        } else {
            $strCondition = str_replace('in_array', '@in_array', $strCondition);
            $strCondition = preg_replace("/\\$([A-Za-z0-9_]+)/u", '$arrPost[\'$1\']', $strCondition);
        }

        return 'return (' . $strCondition . ');';
    }
}
