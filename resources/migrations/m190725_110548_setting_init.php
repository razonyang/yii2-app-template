<?php
use App\Db\Migration;
use function GuzzleHttp\json_encode;

/**
 * Class m190725_110548_setting_init
 */
class m190725_110548_setting_init extends Migration
{
    private $tableName = '{{%setting}}';
    
    public function safeUp()
    {
        $now = time();
        $columns = ['id', 'description', 'value', 'rules', 'create_time', 'update_time'];
        $items = [
            [
                'id' => 'upload.image.directory',
                'description' => 'Image Directory',
                'value' => 'images',
                'rules' => [
                    ['required'],
                ],
            ],
            [
                'id' => 'upload.image.maxSize',
                'description' => 'Image Maximum Size(bytes)',
                'value' => 1024 * 1024,
                'rules' => [
                    ['required'],
                    ['number'],
                ],
            ],
            [
                'id' => 'upload.image.extensions',
                'description' => 'Image Extensions',
                'value' => 'gif,jpeg,jpg,png',
                'rules' => [
                    ['required'],
                ],
            ],

            [
                'id' => 'upload.video.directory',
                'description' => 'Video Directory',
                'value' => 'videos',
                'rules' => [
                    ['required'],
                ],
            ],
            [
                'id' => 'upload.video.maxSize',
                'description' => 'Video Maximum Size(bytes)',
                'value' => 10 * 1024 * 1024,
                'rules' => [
                    ['required'],
                    ['number'],
                ],
            ],
            [
                'id' => 'upload.video.extensions',
                'description' => 'Video Extensions',
                'value' => 'mp4',
                'rules' => [
                    ['required'],
                ],
            ],
        ];

        $rows = [];
        foreach ($items as $item) {
            $rows[] = [
                $item['id'],
                $item['description'],
                $item['value'],
                json_encode($item['rules'] ?? []),
                $now,
                $now
            ];
        }
        $this->batchInsert($this->tableName, $columns, $rows);
    }

    public function safeDown()
    {
        $this->delete($this->tableName);

        return true;
    }
}
