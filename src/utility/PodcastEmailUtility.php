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
 * Date: 27/10/2020
 * Time: 12:46
 */

namespace amos\podcast\utility;


use amos\podcast\models\Podcast;
use amos\podcast\models\PodcastEpisode;
use amos\podcast\Module;
use open20\amos\admin\models\UserProfile;
use open20\amos\community\models\CommunityUserMm;
use open20\amos\core\user\User;
use open20\amos\core\utilities\Email;
use yii\log\Logger;

class PodcastEmailUtility
{

    /**
     * @param $model Podcast
     */
    public static function sendEmailRequestPublication($model){
        $to = [];
        $userIdsValidators = \Yii::$app->authManager->getUserIdsByRole('PODCAST_VALIDATOR');
        $usersManger = User::find()
            ->innerJoin('community_user_mm', 'community_user_mm.user_id = user.id')
            ->andWhere(['community_user_mm.community_id' => $model->community_id])
            ->andWhere(['role' => CommunityUserMm::ROLE_COMMUNITY_MANAGER])->all();

        foreach ($userIdsValidators as $user_id){
            $user = User::findOne($user_id);
            if($user){
                $to []= $user->email;
            }
        }
        foreach ($usersManger as $user){
            if($user){
                $to []= $user->email;
            }
        }
        $to = array_unique($to);

        $creatorProfile = UserProfile::find()->andWhere(['user_id' => $model->created_by])->one();
        $link = \Yii::$app->params['platform']['backendUrl'].'/podcast/podcast/update?id='.$model->id;

        $subject = Module::t('amospodcast',"Richiesta validazione podcast");
        $message = Module::t('amospodcast',"Ciao, l'utente <strong>{nomeCognome}</strong> richiede la validazione del podcast <strong>{podcast}</strong>",[
            'nomeCognome' => $creatorProfile->nomeCognome,
            'podcast' => $model->title
        ]);
        $message .= "<br>".Module::t('amospodcast',"Clicca <a href='{link}'>qui</a> per validare il podcast.",['link' => $link]);
        self::sendEmailGeneral($to, $subject, $message);
    }
    /**
     * @param $to
     * @param $profile
     * @param $subject
     * @param $message
     * @param array $files
     * @return bool
     */
    public static function sendEmailGeneral($to, $subject, $message, $files = [])
    {
        try {
            $from = '';
            if (isset(\Yii::$app->params['email-assistenza'])) {
                //use default platform email assistance
                $from = \Yii::$app->params['email-assistenza'];
            }

            /** @var \open20\amos\core\utilities\Email $email */
            $email = new Email();
            $email->sendMail($from, $to, $subject, $message, $files);
        } catch (\Exception $ex) {
//            pr($ex->getMessage());
            \Yii::getLogger()->log($ex->getTraceAsString(), Logger::LEVEL_ERROR);
        }
        return true;
    }
}