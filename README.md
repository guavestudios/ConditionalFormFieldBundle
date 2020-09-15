# Conditional Form Field Bundle
This contao module allows you to set conditional fields in a for to hide or show based on a different field

### Requirements
Contao >4 (tested with 4.8)

### Install
`composer require guave/conditionalformfield-bundle`

### Examples
only display the field when value of field 'foo' is 'bar' and 'bla' is 'yes'
```
$foo == 'bar' && $bla == 'yes'
```

You can also check the array (e.g. multiple checkboxes or select menu):
```
in_array('bar', $foo)
```

To validate a single checkbox simply compare its value:
```
$foo == '1'
```
