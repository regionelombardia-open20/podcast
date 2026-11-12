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

use yii\db\Migration;
use yii\db\Schema;

/**
 * Handles the creation of table `een_partnership_proposal`.
 */
class m201014_165713_insert_models_classname extends Migration
{


    /**
     * @inheritdoc
     */
    public function safeUp()
    {


        $this->insert('models_classname', [
            'classname' => \amos\podcast\models\PodcastEpisode::className(),
            'module' => 'podcast',
            'label' => 'Podcast episode',
            'description' => 'Podcast episode',
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => '2020-10-14 17:02:00',
            'updated_at' => '2020-10-14 17:02:00',
        ]);
        $this->insert('models_classname', [
            'classname' => \amos\podcast\models\Podcast::className(),
            'module' => 'podcast',
            'label' => 'Podcast',
            'description' => 'Podcast',
            'created_by' =>1,
            'updated_by' =>1,
            'created_at' => '2020-10-14 17:02:00',
            'updated_at' => '2020-10-14 17:02:00',
        ]);

    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->execute('SET FOREIGN_KEY_CHECKS = 0;');
        $this->delete('models_classname', [
            'classname' => \amos\podcast\models\PodcastEpisode::className(),
            'module' => 'podcast',
            'label' => 'Podcast episode',
            'description' => 'Podcast episode',
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => '2020-10-14 17:02:00',
            'updated_at' => '2020-10-14 17:02:00',
        ]);
        $this->delete('models_classname', [
            'classname' => \amos\podcast\models\Podcast::className(),
            'module' => 'podcast',
            'label' => 'Podcast',
            'description' => 'Podcast',
            'created_by' =>1,
            'updated_by' =>1,
            'created_at' => '2020-10-14 17:02:00',
            'updated_at' => '2020-10-14 17:02:00',
        ]);
        $this->execute('SET FOREIGN_KEY_CHECKS = 1;');

    }
}
