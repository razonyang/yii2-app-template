<?php
namespace App\Tests\Unit\Factory;

use App\Factory\ArticleMetaFactory;
use App\Model\ArticleMeta;
use Codeception\Test\Unit;
use Yii;

class ArticleMetaFactoryTest extends Unit
{
    /**
     * @dataProvider dataCreate
     */
    public function testCreate(int $articleId, string $content): void
    {
        $model = ArticleMetaFactory::create($articleId, $content);
        $this->assertSame($articleId, $model->article_id);
        $this->assertSame($content, $model->content);
    }

    public function dataCreate(): array
    {
        return [
            [1, 'foo'],
            [2, 'bar'],
        ];
    }
}
