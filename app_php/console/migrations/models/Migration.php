<?php

namespace console\migrations\models;

/**
 * Class Migration
 *
 * @desciption https://stackoverflow.com/questions/4107915/postgresql-default-constraint-names/4108266#4108266
 */
class Migration extends \yii\db\Migration
{
    /**
     * @inheritdoc
     */
    public function createIndex($name, $table, $columns, $unique = false)
    {
        if (!$name) {
            $columns = is_array($columns) ? $columns : [$columns];

            $name = implode('_', [
                $table,
                implode('_', $columns),
                ($unique ? 'key' : 'idx')
            ]);
        }

        parent::createIndex($name, $table, $columns, $unique);
    }

    /**
     * @inheritdoc
     */
    public function addForeignKey($name, $table, $columns, $refTable, $refColumns, $delete = null, $update = null)
    {
        if (!$name) {
            $columns = is_array($columns) ? $columns : [$columns];
            $refColumns = is_array($refColumns) ? $refColumns : [$refColumns];

            $name = implode('_', [
                $table,
                implode('_', $columns),
                $refTable,
                implode('_', $refColumns),
                'fkey'
            ]);
        }

        parent::addForeignKey($name, $table, $columns, $refTable, $refColumns, $delete, $update);
    }
}