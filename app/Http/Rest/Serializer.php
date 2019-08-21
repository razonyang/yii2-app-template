<?php
namespace App\Http\Rest;

use RazonYang\Yii2\JSend\Serializer as BaseSerializer;
use Yii;
use yii\web\Link;

class Serializer extends BaseSerializer
{
    public $collectionEnvelope = 'items';

    public $linksEnvelope = 'links';

    public $metaEnvelope = 'meta';

    protected function serializePagination($pagination)
    {
        return [
            $this->linksEnvelope => Link::serialize($pagination->getLinks(true)),
            $this->metaEnvelope => [
                'page' => $pagination->getPage() + 1,
                'page_count' => $pagination->getPageCount(),
                'page_size' => $pagination->getPageSize(),
                'total_count' => $pagination->totalCount,
            ],
        ];
    }
}
