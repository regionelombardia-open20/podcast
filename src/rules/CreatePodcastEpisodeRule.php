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

/**
 * Created by PhpStorm.
 * User: michele.lafrancesca
 * Date: 23/10/2020
 * Time: 15:34
 */

namespace amos\podcast\rules;


use amos\podcast\utility\PodcastUtility;
use open20\amos\community\utilities\CommunityUtil;
use open20\amos\core\rules\DefaultOwnContentRule;

class CreatePodcastEpisodeRule extends DefaultOwnContentRule
{

    public $name = 'createPodcastEpisodeRule';


    /**
     * @inheritdoc
     */
    public function execute($user, $item, $params)
    {
        if (isset($params['model'])) {
            /** @var Record $model */
            $model = $params['model'];
            if (!$model->id) {
                $post = \Yii::$app->getRequest()->post();
                $get = \Yii::$app->getRequest()->get();
                if (isset($get['id'])) {
                    $model = $this->instanceModel($model, $get['id']);
                } elseif (isset($post['id'])) {
                    $model = $this->instanceModel($model, $post['id']);
                }
            }

            $module = \Yii::$app->getModule('podast');
            if($module && $module->canCreateCommunityManager){
                $moduleCwh = \Yii::$app->getModule('cwh');
                $community_id = null;
                isset($moduleCwh) ? $scope = $moduleCwh->getCwhScope() : null;
                if ($scope && $scope['community']) {
                    $community_id = $scope['community'];
                }
                if($community_id) {
                    return PodcastUtility::isManagerCommunity();
                }
                return true;
            }
            return true;
        } else {
            return false;
        }
    }
}