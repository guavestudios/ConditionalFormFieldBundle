<?php

namespace Guave\ConditionalFormFieldBundle\EventListener;

use Contao\CoreBundle\ServiceAnnotation\Hook;
use Contao\Form;
use Contao\Widget;

class LoadFormFieldListener
{
    protected static array $fieldSets;

    /**
     * Apply conditional settings
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

        // Set the CSS class only for fieldsets
        if ($widget->isConditionalFormField) {
            $widget->class = 'cffs-' . $widget->id;
        }

        return $widget;
    }
}
