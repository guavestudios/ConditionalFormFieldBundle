<?php
$debug = System::getContainer()->getParameter('kernel.environment') === 'dev' ? '' : '.min';
$GLOBALS['TL_JAVASCRIPT']['CONDITIONALFORMFIELD'] = 'bundles/guaveconditionalformfield/assets/conditionalformfields' . $debug . '.js';
