<?php

namespace Guave\ConditionalFormFieldBundle\EventListener;

use Contao\CoreBundle\ServiceAnnotation\Hook;
use Contao\Form;
use Contao\FormFieldModel;
use Contao\Widget;
use Input;
use ReflectionClass;

class ValidateFormFieldListener
{
    protected static array $fieldSets;

    /**
     * Validate only if needed.
     *
     * @param Widget $widget
     * @param string $formId
     * @param array $formData
     * @param Form $form
     * @return Widget
     */
    public function __invoke(Widget $widget, string $formId, array $formData, Form $form): Widget
    {
        if (empty(static::$fieldSets[$form->id])) {
            return $widget;
        }

        $postData = $this->getFormPostData($formData['id']);

        foreach (static::$fieldSets[$form->id] as $fieldset) {
            foreach ($fieldset['fields'] as $fieldId) {
                if ($fieldId === $widget->id && !$fieldset['condition']($postData)) {
                    $reflection = new ReflectionClass($widget);
                    $errors = $reflection->getProperty('arrErrors');
                    $errors->setAccessible(true);
                    $errors->setValue($widget, []);

                    // Widget needs to be set to disabled (#17)
                    $widget->disabled = true;
                }
            }
        }

        return $widget;
    }

    /**
     * Get the form postdata
     *
     * @param int $formId
     * @return array
     */
    protected function getFormPostData(int $formId): array
    {
        static $data;

        if (!is_array($data)) {
            $data = [];
            $fieldModels = FormFieldModel::findPublishedByPid($formId);

            if ($fieldModels !== null) {
                foreach ($fieldModels as $fieldModel) {
                    $data[$fieldModel->name] = Input::post($fieldModel->name);
                }
            }
        }

        return $data;
    }
}
