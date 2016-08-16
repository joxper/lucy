<?php

$timezones = [];
foreach (timezone_identifiers_list() as $timezone) {
    $timezones[$timezone] = $timezone;
}

return [
    
    /**
     * CSS Skins.
     *
     * @var array
     */
    'skins' => [
        'black' => 'Black',
        'black-light' => 'Black Light',
        'blue' => 'Blue',
        'blue-light' => 'Blue Light',
        'green' => 'Green',
        'green-light' => 'Green Light',
        'purple' => 'Purple',
        'purple-light' => 'Purple Light',
        'red' => 'Red',
        'red-light' => 'Red Light',
        'yellow' => 'Yellow',
        'yellow-light' => 'Yellow Light',
    ],

    /**
     * Timezone list.
     *
     * @var array
     */
    'timezones' => $timezones,

    /**
     * App environment.
     *
     * @var array
     */
    'env' => [
        'local' => 'Local',
        'production' => 'Production',
    ],

    /**
     * Mails providers list.
     *
     * @var array
     */
    'mails' => [
        'log' => 'Log',
        'mail' => 'PHP\'s Mail Function',
        'sendmail' => 'Sendmail',
        'smtp' => 'SMTP',
    ],

    /**
     * Table column's types.
     *
     * @var array
     */
    'columns' => [
        'bigInteger' => 'BIGINT',
        'integer' => 'INTEGER',
        'mediumInteger' => 'MEDIUMINT',
        'smallInteger' => 'SMALLINT',
        'tinyInteger' => 'TINYINT',
        'boolean' => 'BOOLEAN',
        'char' => 'CHAR',
        'date' => 'DATE',
        'dateTime' => 'DATETIME',
        'longText' => 'LONGTEXT',
        'mediumText' => 'MEDIUMTEXT',
        'string' => 'VARCHAR',
        'text' => 'TEXT',
        'time' => 'TIME',
        'timestamp' => 'TIMESTAMP',
        'decimal' => 'DECIMAL',
        'double' => 'DOUBLE',
        'float' => 'FLOAT',
    ],

    /**
     * Table's relationship.
     *
     * @var array
     */
    'relationship' => [
        'one-to-one' => 'One To One',
        'one-to-many' => 'One To Many',
    ],

    /**
     * Crud files type.
     *
     * @var array
     */
    'crud' => [
        'migration', 'model', 'request', 'controller', 'view', 'route',
    ],

];
