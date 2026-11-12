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
class m201019_154013_add_podcast_community_id extends Migration
{


    /**
     * @inheritdoc
     */
    public function safeUp()
    {


        $this->addColumn('podcast', "community_id", $this->integer()->defaultValue(null)->comment('Community')->after('podcast_category_id'));
        $this->addForeignKey('fk_podcast_community_id1', 'podcast', "community_id", 'community', 'id');

    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->execute('SET FOREIGN_KEY_CHECKS = 0;');

        $this->dropForeignKey('fk_podcast_community_id1', 'podcast');
        $this->addColumn('podcast', "community_id", $this->integer()->defaultValue(null)->comment('Community')->after('podcast_category_id'));

        $this->execute('SET FOREIGN_KEY_CHECKS = 1;');

    }
}
