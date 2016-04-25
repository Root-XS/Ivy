<?php

use Illuminate\Database\Seeder;

class BaseSeeder extends Seeder
{
    /** @var string $strConnection Connection name for insert statements */
    protected $strConnection;

    /** @var string $strTable Table name for insert statements */
    protected $strTable;

    /** @var array $aFields List of DB field names in self::$strTable */
    protected $aFields;

    /** @var array $aData List of rows to insert */
    protected $aData;

    /** @var bool $bHasTimestamps Does this table have timestamps? */
    protected $bHasTimestamps = true;

    /**
     * Run the database seeds.
     */
    public function run()
    {
        $strClass = get_class($this);
        // Make sure properties were defined correctly in the child class.
        if (!is_string($this->strTable))
            abort(500, 'No table name given in ' . $strClass);
        if (!is_array($this->aFields))
            abort(500, 'No field names given in ' . $strClass);
        if (!is_array($this->aData))
            abort(500, 'No data given in ' . $strClass);
        if (count($this->aFields) !== count($this->aData[0]))
            abort(500, 'Data does not match field names in ' . $strClass);

        // Execute
        foreach ($this->aData as $aData) {
            $aInsert = array_combine($this->aFields, $aData);
            if ($this->bHasTimestamps) {
                $aInsert['created_at'] =
                $aInsert['updated_at'] = date('Y-m-d H:i:s');
            }
            if ($this->strConnection)
                DB::connection($this->strConnection)->table($this->strTable)->insert($aInsert);
            else
                DB::table($this->strTable)->insert($aInsert);
        }
    }
}