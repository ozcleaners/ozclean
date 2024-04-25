<?php
/**
 * Attribute Values Unique Type Enum Value
 */
\App\Helpers\Query::changeColumnEnumValues([
    'table_name' => 'attribute_values',
    'column_name' => 'unique_name',
    'enum_values' => [
        'Zone', 'Gender', 'Calculator Setting', 'Equation Type', 'Service Type', 'Counter Type', 'Calculation Type', 'Input Type', 'Radio Type'
    ],
]);


?>
