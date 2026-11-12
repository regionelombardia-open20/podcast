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
class m201012_150336_podcast_permissions extends AmosMigrationPermissions
{

    /**
    * @inheritdoc
    */
    protected function setRBACConfigurations()
    {
        $prefixStr = '';

        return [
            [
                'name' =>  'ADMINISTRATOR_PODCAST',
                'type' => Permission::TYPE_ROLE,
                'description' => 'Administrator podcast',
                'ruleName' => null,
                'parent' => ['ADMIN']
            ],

            [
                'name' =>  'PODCAST_READER',
                'type' => Permission::TYPE_ROLE,
                'description' => 'Reader podcast',
                'ruleName' => null,
                'parent' => ['BASIC_USER']
            ],
            [
                'name' =>  'PODCAST_VALIDATOR',
                'type' => Permission::TYPE_ROLE,
                'description' => 'Reader podcast',
                'ruleName' => null,
                'parent' => ['ADMINISTRATOR_PODCAST']
            ],

            //------------
                [
                    'name' =>  'PODCAST_CREATE',
                    'type' => Permission::TYPE_PERMISSION,
                    'description' => 'Permesso di CREATE sul model Podcast',
                    'ruleName' => null,
                    'parent' => ['ADMINISTRATOR_PODCAST']
                ],
                [
                    'name' =>  'PODCAST_READ',
                    'type' => Permission::TYPE_PERMISSION,
                    'description' => 'Permesso di READ sul model Podcast',
                    'ruleName' => null,
                    'parent' => ['ADMINISTRATOR_PODCAST']
                    ],
                [
                    'name' =>  'PODCAST_UPDATE',
                    'type' => Permission::TYPE_PERMISSION,
                    'description' => 'Permesso di UPDATE sul model Podcast',
                    'ruleName' => null,
                    'parent' => ['ADMINISTRATOR_PODCAST']
                ],
                [
                    'name' =>  'PODCAST_DELETE',
                    'type' => Permission::TYPE_PERMISSION,
                    'description' => 'Permesso di DELETE sul model Podcast',
                    'ruleName' => null,
                    'parent' => ['ADMINISTRATOR_PODCAST']
                ],
            //
            [
                'name' =>  'PODCASTCATEGORY_CREATE',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso di CREATE sul model PodcastCategory',
                'ruleName' => null,
                'parent' => ['ADMINISTRATOR_PODCAST']
            ],
            [
                'name' =>  'PODCASTCATEGORY_READ',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso di READ sul model PodcastCategory',
                'ruleName' => null,
                'parent' => ['ADMINISTRATOR_PODCAST']
            ],
            [
                'name' =>  'PODCASTCATEGORY_UPDATE',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso di UPDATE sul model PodcastCategory',
                'ruleName' => null,
                'parent' => ['ADMINISTRATOR_PODCAST']
            ],
            [
                'name' =>  'PODCASTCATEGORY_DELETE',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso di DELETE sul model PodcastCategory',
                'ruleName' => null,
                'parent' => ['ADMINISTRATOR_PODCAST']
            ],

            // ------------------------

            [
                'name' =>  'PODCASTEPISODE_CREATE',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso di CREATE sul model PodcastEpisode',
                'ruleName' => null,
                'parent' => ['ADMINISTRATOR_PODCAST']
            ],
            [
                'name' =>  'PODCASTEPISODE_READ',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso di READ sul model PodcastEpisode',
                'ruleName' => null,
                'parent' => ['ADMINISTRATOR_PODCAST']
            ],
            [
                'name' =>  'PODCASTEPISODE_UPDATE',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso di UPDATE sul model PodcastEpisode',
                'ruleName' => null,
                'parent' => ['ADMINISTRATOR_PODCAST']
            ],
            [
                'name' =>  'PODCASTEPISODE_DELETE',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso di DELETE sul model PodcastEpisode',
                'ruleName' => null,
                'parent' => ['ADMINISTRATOR_PODCAST']
            ],


        ];
    }
}
