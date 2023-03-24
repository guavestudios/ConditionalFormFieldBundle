# Conditional Form Field Bundle

This contao module allows you to set conditional fields in a for to hide or show based on a different field

## Requirements

- Contao 4.13+
- PHP 7.4 or 8.0+

### Install

```BASH
$ composer require guave/conditionalformfield-bundle
```

### Examples

only display the field when value of field 'foo' is 'bar' and 'bla' is 'yes'

```PHP
$foo == 'bar' && $bla == 'yes'
```

You can also check the array (e.g. multiple checkboxes or select menu):

```PHP
in_array('bar', $foo)
```

To validate a single checkbox simply compare its value:

```PHP
$foo == '1'
```
