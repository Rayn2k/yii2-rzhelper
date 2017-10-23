<?php
/**
 * Adaption, which cut the prefix from categories, because the translation Scanner from lajax/translate cannot handle such prefixes. 
 * E.g. the webvimark module adds the 'modules/user-management/' prefix to each message category.
 * Only changes are the prefix cut for 'category' at the beginning of all 3 protected methods 
 */
namespace app\rzcomponents;
use yii\i18n\DbMessageSource;

class DbMessageSourceCutCategoryPrefix extends DbMessageSource
{

    public $cut_prefix = 'cut_prefix';

    /**
     * @Override
     */
    protected function loadMessages($category, $language)
    {
        // Adaption, which cut the categories for webvimark/user-management-module
        $category = UtilString::get_string_without_prefix($category, $this->cut_prefix);
        return parent::loadMessages($category, $language);
    }

    /**
     * @Override
     */
    protected function loadMessagesFromDb($category, $language)
    {
        // Adaption, which cut the categories for webvimark/user-management-module
        $category = UtilString::get_string_without_prefix($category, $this->cut_prefix);
        return parent::loadMessagesFromDb($category, $language);
    }

    /**
     * @Override
     */
    protected function createFallbackQuery($category, $language, $fallbackLanguage)
    {
        // Adaption, which cut the categories for webvimark/user-management-module
        $category = UtilString::get_string_without_prefix($category, $this->cut_prefix);
        return parent::createFallbackQuery($category, $language, $fallbackLanguage);
    }
}
