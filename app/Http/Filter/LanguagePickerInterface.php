<?php
namespace App\Http\Filter;

interface LanguagePickerInterface
{
    /**
     * @return null|string language.
     */
    public function getLanguage();
}
