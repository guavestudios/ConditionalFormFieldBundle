<?php

$GLOBALS['TL_DCA']['tl_form_field']['palettes']['__selector__'][] = 'isConditionalFormField';
$GLOBALS['TL_DCA']['tl_form_field']['palettes']['fieldsetfsStart'] = str_replace(';{expert_legend', ',isConditionalFormField;{expert_legend', $GLOBALS['TL_DCA']['tl_form_field']['palettes']['fieldsetfsStart']);
$GLOBALS['TL_DCA']['tl_form_field']['palettes']['fieldsetStart'] = str_replace(';{expert_legend', ',isConditionalFormField;{expert_legend', $GLOBALS['TL_DCA']['tl_form_field']['palettes']['fieldsetStart']);
$GLOBALS['TL_DCA']['tl_form_field']['subpalettes']['isConditionalFormField'] = 'conditionalFormFieldCondition';

$GLOBALS['TL_DCA']['tl_form_field']['fields']['isConditionalFormField'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_form_field']['isConditionalFormField'],
    'exclude' => true,
    'inputType' => 'checkbox',
    'eval' => ['submitOnChange' => true, 'tl_class' => 'clr'],
    'sql' => "char(1) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_form_field']['fields']['conditionalFormFieldCondition'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_form_field']['conditionalFormFieldCondition'],
    'exclude' => true,
    'inputType' => 'textarea',
    'eval' => ['mandatory' => true, 'decodeEntities' => true, 'style' => 'height:40px', 'tl_class' => 'clr'],
    'sql' => "text NULL",
];
