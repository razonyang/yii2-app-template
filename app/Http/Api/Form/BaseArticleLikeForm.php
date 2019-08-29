<?php
namespace App\Http\Api\Form;

use App\Form\Form;
use App\Model\ArticleLike;

abstract class BaseArticleLikeForm extends Form
{
    use UserTrait;

    /**
     * @property int $article_id
     */
    public $id;

    public function rules()
    {
        return [
            [['id', 'user'], 'required'],
        ];
    }

    private $like;

    public function getLike(): ?ArticleLike
    {
        if ($this->like === null) {
            $this->like = ArticleLike::findByArticleIdAndUserId($this->id, $this->getUser()->getId());
        }

        return $this->like;
    }
}