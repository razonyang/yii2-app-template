<?php
namespace App\Gii\Generator\Module;

use yii\gii\generators\module\Generator as BaseGenerator;
use yii\gii\CodeFile;
use yii\helpers\Html;
use yii\helpers\StringHelper;
use Yii;

class Generator extends BaseGenerator
{
    public $templates = [
        'default' => '@resources/gii/generators/module/views'
    ];

    public function getControllerNamespace()
    {
        return substr($this->moduleClass, 0, strrpos($this->moduleClass, '\\')) . '\Controller';
    }

    public $formView = '@resources/gii/generators/module/views/form.php';

    public function formView()
    {
        return $this->formView;
    }

    public $viewPath;

    public function generate()
    {
        $files = [];
        $modulePath = $this->getModulePath();
        $files[] = new CodeFile(
            $modulePath . '/' . StringHelper::basename($this->moduleClass) . '.php',
            $this->render("module.php")
        );
        $files[] = new CodeFile(
            $modulePath . '/Controller/DefaultController.php',
            $this->render("controller.php")
        );
        $files[] = new CodeFile(
            Yii::getAlias($this->viewPath) . '/default/index.php',
            $this->render("view.php")
        );

        return $files;
    }

    public function rules()
    {
        return array_merge(parent::rules(), [
            [['viewPath'], 'required'],
        ]);
    }

    public function hints()
    {
        return [
            'moduleClass' => 'The module class, e.g., <code>App\Http\Module\Admin\Module</code>',
            'moduleID' => 'The module ID, e.g., <code>admin</code>',
            'viewPath' => 'The views path, e.g., <code>@resources/modules/admin/views</code>',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function successMessage()
    {
        if (Yii::$app->hasModule($this->moduleID)) {
            $link = Html::a('try it now', Yii::$app->getUrlManager()->createUrl($this->moduleID), ['target' => '_blank']);

            return "The module has been generated successfully. You may $link.";
        }

        $output = <<<EOD
<p>The module has been generated successfully.</p>
<p>To access the module, you need to add this to your application configuration:</p>
EOD;
        $code = <<<EOD
<?php
    ......
    'modules' => [
        '{$this->moduleID}' => [
            'class' => '{$this->moduleClass}',
            'viewPath' => '{$this->viewPath}',
        ],
    ],
    ......
EOD;

        return $output . '<pre>' . highlight_string($code, true) . '</pre>';
    }
}
