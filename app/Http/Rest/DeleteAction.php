<?php
namespace App\Http\Rest;

use App\Model\SoftDeleteInterface;
use Yii;
use yii\db\ActiveRecord;
use yii\rest\DeleteAction as Action;

class DeleteAction extends Action
{
    use SafeActionTrait {
        run as safeRun;
    }

    public function run($id)
    {
        return $this->safeRun($id, [$this, 'delete']);
    }

    public function delete($id)
    {
        $model = $this->findModel($id);

        if ($this->checkAccess) {
            call_user_func($this->checkAccess, $this->id, $model);
        }

        if ($this->deleteModel($model) === false) {
            throw new ServerErrorHttpException('Failed to delete the object for unknown reason.');
        }

        Yii::$app->getResponse()->setStatusCode(204);
    }
    
    /**
     * @param ActiveRecord $model
     * @return int|false
     */
    private function deleteModel($model)
    {
        if ($model instanceof SoftDeleteInterface) {
            return $model->softDelete();
        }

        return $model->delete();
    }
}
