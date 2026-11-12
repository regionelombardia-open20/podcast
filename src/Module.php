<?php
/**
 * Aria S.p.A.
 * OPEN 2.0
 *
 * @package   open2\podcast
 * @author    Aria S.p.A. <protocollo@pec.ariaspa.it>
 * @license   GNU General Public License v3.0 <https://www.gnu.org/licenses/gpl-3.0.html>
 * @link      https://www.ariaspa.it/
 *
 * This file is part of OPEN 2.0.
 *
 * OPEN 2.0 is free software: you can redistribute it and/or modify it
 * under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * OPEN 2.0 is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with OPEN 2.0. If not, see <https://www.gnu.org/licenses/>.
 */

namespace amos\podcast;


use amos\podcast\models\Podcast;
use amos\podcast\models\search\PodcastSearch;
use open20\amos\admin\models\UserProfile;
use open20\amos\core\interfaces\CmsModuleInterface;
use open20\amos\core\interfaces\SearchModuleInterface;
use open20\amos\core\interfaces\BreadcrumbInterface;


class Module extends \open20\amos\core\module\AmosModule implements SearchModuleInterface, CmsModuleInterface, BreadcrumbInterface
{

    public $canCreateOnlyCommunityManager = false;
    public $basicUserCannotCreate = false;

    public $name = 'podcast';

    /**
     * @inheritdoc
     */
    public static function getModuleName()
    {
        return 'podcast';
    }

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        \Yii::setAlias('@amos/' . static::getModuleName() . '/controllers/', __DIR__ . '/controllers/');
        // custom initialization code goes here
        \Yii::configure($this, require(__DIR__ . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'config.php'));
    }

    /**
     * @inheritdoc
     */
    public function getWidgetIcons()
    {
        return [

        ];
    }

    /**
     * @inheritdoc
     */
    public function getWidgetGraphics()
    {
        return null;
    }

    /**
     * @inheritdoc
     */
    protected function getDefaultModels()
    {
        return [
            'PageContent' => __NAMESPACE__ . '\\' . 'models\PageContent',
        ];
    }

    /**
     * This method return the session key that must be used to add in session
     * the url from the user have started the content creation.
     * @return string
     */
    public static function beginCreateNewSessionKey()
    {
        return 'beginCreateNewUrl_' . self::getModuleName();
    }

    /**
     * This method return the session key that must be used to add in session
     * the url date and time creation from the user have started the content creation.
     * @return string
     */
    public static function beginCreateNewSessionKeyDateTime()
    {
        return 'beginCreateNewUrlDateTime_' . self::getModuleName();
    }


    /**
     * @inheritdoc
     */
    public static function getModelSearchClassName() {
        return PodcastSearch::className();
    }

    /**
     * @inheritdoc
     */
    public static function getModelClassName() {
        return Podcast::className();
    }

    /**
     * @inheritdoc
     */
    public static function getModuleIconName() {
        return 'feed';
    }


    /**
     * @return array
     */
    public function getIndexActions(){
        return [
            'podcast/index',
            'podcast/own',
            'podcast/admin',
            'podcast/to-validate',
            'podcast/to-validate-episodes',
            'podcast-episode/index',
            'podcast-category/index',
        ];
    }

    /**
     * @return array
     */
    public function getControllerNames(){
        $names =  [
            'podcast' => self::t('amospodcast', "Podcast"),
            'podcast-episode'  => self::t('amospodcast', "Episodi podcast"),
            'podcast-category'  => self::t('amospodcast', "Categorie podcast"),
        ];

        return $names;
    }

}