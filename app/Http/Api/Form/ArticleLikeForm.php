<?php
namespace App\Http\Api\Form;

use App\Factory\ArticleLikeFactory;

class ArticleLikeForm extends BaseArticleLikeForm
{
    use UserTrait;
    
    protected function handleInternal()
    {
        $like = $this->getLike();
        if ($like) {
            return;
        }

        // creates new like record
        $like = ArticleLikeFactory::create($this->id, $this->getUser()->getId());
        if (!$like->save()) {
            $this->addErrors($like->getErrors());
        }
    }
}
