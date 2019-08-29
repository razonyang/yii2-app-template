<?php
namespace App\Http\Api\Form;

class ArticleDislikeForm extends BaseArticleLikeForm
{
    use UserTrait;
    
    protected function handleInternal()
    {
        $like = $this->getLike();
        if (!$like) {
            return;
        }

        // deletes record.
        $like->delete();
    }
}
