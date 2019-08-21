<?php
namespace App\Http\Filter;

use Yii;
use yii\di\Instance;
use yii\filters\ContentNegotiator as BaseContentNegotiator;
use yii\web\User;
use yii\web\Cookie;

class ContentNegotiator extends BaseContentNegotiator
{
    /**
     * A user component.
     *
     * @var string|User
     */
    public $user = 'user';

    /**
     * {@inheritdoc}
     */
    protected function negotiateLanguage($request)
    {
        if (empty($this->languageParam) || ($language = $request->get($this->languageParam)) === null) {
            $language = null;
            $this->user = Instance::ensure($this->user, User::class);
            if (!$this->user->getIsGuest() && ($identity = $this->user->getIdentity()) instanceof LanguagePickerInterface) {
                $language = $identity->getLanguage();
            
                $picked = $this->pick($language);
                if ($picked !== null) {
                    return $picked;
                }
            }
            
            $language = $request->getCookies()->getValue($this->languageParam, null);
            $picked = $this->pick($language);
            if ($picked !== null) {
                return $picked;
            }
        }

        return parent::negotiateLanguage($request);
    }

    /**
     * Pick language.
     *
     * @param string $language
     *
     * @return string|null returns a supportted language, returns null if not supported.
     */
    protected function pick($language)
    {
        if ($language === null) {
            return null;
        }

        if (isset($this->languages[$language])) {
            return $this->languages[$language];
        }
        foreach ($this->languages as $key => $supported) {
            if (is_int($key) && $this->isLanguageSupported($language, $supported)) {
                return $supported;
            }
        }

        return null;
    }

    /**
     * Store language to cookie.
     *
     * @param string $lang
     */
    public function storeLanguageToCookie($lang)
    {
        $cookie = new Cookie(['name' => $this->languageParam, 'value' => $lang]);
        Yii::$app->getResponse()->getCookies()->add($cookie);
    }
}
