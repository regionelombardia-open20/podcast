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
* Class m201012_150336_podcast_permissions*/
class m201016_101536_podcast_workflow_permissions extends AmosMigrationPermissions
{

    /**
    * @inheritdoc
    */
    protected function setRBACConfigurations()
    {
        $prefixStr = '';

        return [

            [
                'name' => \amos\podcast\models\Podcast::PODCAST_WORKFLOW_STATUS_PUBLISHED,
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Workflow Permission',
                'parent' => ['ADMINISTRATOR_PODCAST', 'PODCAST_VALIDATOR']
            ],
            [
                'name' => \amos\podcast\models\Podcast::PODCAST_WORKFLOW_STATUS_REJECTED,
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Workflow Permission',
                'parent' =>  ['ADMINISTRATOR_PODCAST', 'PODCAST_VALIDATOR']
            ],
            [
                'name' =>\amos\podcast\models\Podcast::PODCAST_WORKFLOW_STATUS_REQUESTPUBLICATION,
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Workflow Permission',
                'parent' => ['PODCAST_VALIDATOR', 'ADMIN_TERRITORY', 'PODCAST_READER']
            ],

            // ---------------
            [
                'name' => \amos\podcast\models\PodcastEpisode::PODCASTEP_WORKFLOW_STATUS_PUBLISHED,
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Workflow Permission',
                'parent' => ['ADMINISTRATOR_PODCAST', 'PODCAST_VALIDATOR']
            ],
            [
                'name' => \amos\podcast\models\PodcastEpisode::PODCASTEP_WORKFLOW_STATUS_REJECTED,
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Workflow Permission',
                'parent' =>  ['ADMINISTRATOR_PODCAST', 'PODCAST_VALIDATOR']
            ],
            [
                'name' => \amos\podcast\models\PodcastEpisode::PODCASTEP_WORKFLOW_STATUS_REQUESTPUBLICATION,
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Workflow Permission',
                'parent' => ['PODCAST_VALIDATOR', 'ADMIN_TERRITORY', 'PODCAST_READER']
            ],


        ];
    }
}
