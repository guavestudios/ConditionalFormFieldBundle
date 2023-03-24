<?php

use Guave\ConditionalFormFieldBundle\EventListener\CompileFormFieldsListener;
use Guave\ConditionalFormFieldBundle\EventListener\LoadFormFieldListener;
use Guave\ConditionalFormFieldBundle\EventListener\OutputFrontendTemplateListener;
use Guave\ConditionalFormFieldBundle\EventListener\ValidateFormFieldListener;

$GLOBALS['TL_HOOKS']['compileFormFields'][] = [CompileFormFieldsListener::class, '__invoke'];
$GLOBALS['TL_HOOKS']['loadFormField'][] = [LoadFormFieldListener::class, '__invoke'];
$GLOBALS['TL_HOOKS']['outputFrontendTemplate'][] = [OutputFrontendTemplateListener::class, '__invoke'];
$GLOBALS['TL_HOOKS']['validateFormField'][] = [ValidateFormFieldListener::class, '__invoke'];
