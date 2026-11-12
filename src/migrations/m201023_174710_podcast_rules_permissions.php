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

use open20\amos\core\migration\AmosMigrationPermissions;
use yii\rbac\Permission;


/**
 * Class m200924_104110_li_modello_permissions*/
class m201023_174710_podcast_rules_permissions extends AmosMigrationPermissions
{

    /**
     * @inheritdoc
     */
    protected function setRBACConfigurations()
    {
        $prefixStr = '';

        return [
            [
                'name' => \amos\podcast\rules\workflow\PodcastEpisodeToValidateWorkflowRule::className(),
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Reader podcast',
                'ruleName' => \amos\podcast\rules\workflow\PodcastEpisodeToValidateWorkflowRule::className(),
                'parent' => [\amos\podcast\models\PodcastEpisode::PODCASTEP_WORKFLOW_STATUS_REQUESTPUBLICATION,]
            ],

            [
                'name' => 'PodcastEpisodeValidate',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Reader podcast',
                'ruleName' => \open20\amos\core\rules\ValidatorUpdateContentRule::className(),
                'parent' => ['PODCAST_READER', 'ADMINISTRATOR_PODCAST'],
                'children' => [
                    'PODCASTEPISODE_UPDATE',
                    \amos\podcast\models\PodcastEpisode::PODCASTEP_WORKFLOW_STATUS_PUBLISHED,
                    \amos\podcast\models\PodcastEpisode::PODCASTEP_WORKFLOW_STATUS_REJECTED,
                    \amos\podcast\rules\workflow\PodcastEpisodeToValidateWorkflowRule::className(),
                    \amos\podcast\widgets\icons\WidgetIconPodcastToValidate::className()
                ]
            ],
            [
                'name' => \amos\podcast\rules\ValidatorPodcastRule::className(),
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Reader podcast',
                'ruleName' => \amos\podcast\rules\ValidatorPodcastRule::className(),
                'parent' => ['PODCAST_READER', 'ADMINISTRATOR_PODCAST'],
                'children' => [
                    \amos\podcast\widgets\icons\WidgetIconPodcastToValidate::className()
                ]
            ],
            [
                'name' => \amos\podcast\rules\UpdateOwnPodcastRule::className(),
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Reader podcast',
                'ruleName' => \amos\podcast\rules\UpdateOwnPodcastRule::className(),
                'parent' => ['PODCAST_READER',],
                'children' => ['PODCAST_UPDATE', 'PODCAST_DELETE']
            ],

            [
                'name' => \amos\podcast\rules\UpdateOwnPodcastEpisodeRule::className(),
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Reader podcast',
                'ruleName' => \amos\podcast\rules\UpdateOwnPodcastEpisodeRule::className(),
                'parent' => ['PODCAST_READER'],
                'children' => ['PODCASTEPISODE_UPDATE', 'PODCASTEPISODE_DELETE']
            ],
            [
                'name' => 'PodcastEpisodeValidateOnDomain',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Reader podcast',
                'ruleName' => \open20\amos\core\rules\UserValidatorContentRule::className(),
                'parent' => ['PODCAST_READER', 'ADMINISTRATOR_PODCAST'],
                'children' => [\amos\podcast\widgets\icons\WidgetIconPodcastToValidate::className()]
            ],
            [
                'name' =>\amos\podcast\rules\CreatePodcastRule::className(),
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Reader podcast',
                'ruleName' => \amos\podcast\rules\CreatePodcastRule::className(),
                'parent' => ['PODCAST_READER', 'ADMINISTRATOR_PODCAST'],
                'children' => ['PODCAST_CREATE']
            ],
            [
                'name' =>\amos\podcast\rules\CreatePodcastEpisodeRule::className(),
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Reader podcast',
                'ruleName' => \amos\podcast\rules\CreatePodcastEpisodeRule::className(),
                'parent' => ['PODCAST_READER', 'ADMINISTRATOR_PODCAST'],
                'children' => ['PODCASTEPISODE_CREATE']
            ],

            //------------------------

             [
                'name' => 'PODCASTEPISODE_READ',
                'update' => true,
                'newValues' => [
                    'addParents' => [
                        'PODCAST_READER'
                    ]
                ]
            ],
            [
                'name' => 'PODCAST_READ',
                'update' => true,
                'newValues' => [
                    'addParents' => [
                        'PODCAST_READER'
                    ]
                ]
            ],
//------------ REMOVE
//            [
//                'name' => 'PODCASTEPISODE_CREATE',
//                'update' => true,
//                'newValues' => [
//                    'removeParents' => [
//                        'PODCAST_READER'
//                    ]
//                ]
//            ],
//            [
//                'name' => 'PODCAST_CREATE',
//                'update' => true,
//                'newValues' => [
//                    'removeParents' => [
//                        'PODCAST_READER'
//                    ]
//                ]
//            ],
//            [
//                'name' => 'PODCASTEPISODE_UPDATE',
//                'update' => true,
//                'newValues' => [
//                    'removeParents' => [
//                        'PODCAST_READER'
//                    ]
//                ]
//            ],
//            [
//                'name' => 'PODCASTEPISODE_DELETE',
//                'update' => true,
//                'newValues' => [
//                    'removeParents' => [
//                        'PODCAST_READER'
//                    ]
//                ]
//            ],
//
//            [
//                'name' => 'PODCAST_UPDATE',
//                'update' => true,
//                'newValues' => [
//                    'removeParents' => [
//                        'PODCAST_READER'
//                    ]
//                ]
//            ],
//            [
//                'name' => 'PODCAST_DELETE',
//                'update' => true,
//                'newValues' => [
//                    'removeParents' => [
//                        'PODCAST_READER'
//                    ]
//                ]
//            ],


        ];
    }
}
