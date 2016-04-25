<?php

class AbilitiesTableSeeder extends BaseSeeder
{
    /** @var string $strTable Table name for insert statements */
    protected $strTable = 'abilities';

    /** @var array $aFields List of DB field names in self::$strTable */
    protected $aFields = [
        'id',
        'name',
        'description',
    ];

    /** @var array $aData List of rows to insert */
    protected $aData = [
        [1, 'create-users', 'Create other Users.'],
        [2, 'edit-users', 'Edit other Users.'],
    ];
}
