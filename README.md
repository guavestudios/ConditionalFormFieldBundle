> ![Deprecated](https://img.shields.io/badge/!-deprecated-red?style=for-the-badge)
>
> This Repo is no longer maintained. Please use [terminal42/contao-conditionalformfields](https://github.com/terminal42/contao-conditionalformfields)

# Conditional Form Field Bundle

This contao module allows you to set conditional fields in a for to hide or show based on a different field

## Requirements

- Contao 5.0+
- PHP 8.1+

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
