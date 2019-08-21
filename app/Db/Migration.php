<?php
namespace App\Db;

use yii\db\Migration as BaseMigration;
use yii\db\ColumnSchemaBuilder;
use App\Model\StatusInterface;

class Migration extends BaseMigration
{
    /**
     * Returns table options.
     *
     * @param string $comment table comment.
     *
     * @return string|null table options.
     */
    public function tableOptions($comment=''): ?string
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
            if ($comment) {
                $tableOptions .= ' COMMENT='.$comment;
            }
        }

        return $tableOptions;
    }

    public function status(): ColumnSchemaBuilder
    {
        return $this->tinyInteger()->notNull()->defaultValue(StatusInterface::STATUS_ACTIVE)->comment('Status: 0.Inactive 1.Active');
    }

    public function timestamp($comment = ''): ColumnSchemaBuilder
    {
        return $this->integer()->unsigned()->notNull()->defaultValue(0)->comment($comment);
    }

    public function createTimestamp(): ColumnSchemaBuilder
    {
        return $this->timestamp('Create Time');
    }

    public function updateTimestamp(): ColumnSchemaBuilder
    {
        return $this->timestamp('Update Time');
    }

    public function sorting(): ColumnSchemaBuilder
    {
        return $this->integer()->notNull()->defaultValue(100)->comment('Sorting');
    }

    public function language(): ColumnSchemaBuilder
    {
        return $this->string(5)->notNull()->comment('Language');
    }

    public function ipAddress(): ColumnSchemaBuilder
    {
        return $this->string(45)->notNull()->defaultValue('')->comment('IP Address');
    }

    public function softDelete(): ColumnSchemaBuilder
    {
        return $this->boolean()->notNull()->defaultValue(false)->comment('Is Deleted');
    }

    public function uuid(): ColumnSchemaBuilder
    {
        return $this->char(36)->notNull()->comment('UUID');
    }

    public function url($comment = 'URL', $length = null): ColumnSchemaBuilder
    {
        return $this->string($length)->notNull()->defaultValue('')->comment($comment);
    }

    public function optimisticLock(): ColumnSchemaBuilder
    {
        return $this->bigInteger()->notNull()->defaultValue(0)->comment('Optimistic Lock');
    }
}
