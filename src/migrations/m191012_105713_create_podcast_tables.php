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
class m191012_105713_create_podcast_tables extends Migration
{
    const TABLE_PODCAST = "podcast";
    const TABLE_PODCAST_EPISODE = "podcast_episode";
    const TABLE_PODCAST_CATEGORY = "podcast_category";

    /**
     * @inheritdoc
     */
    public function up()
    {
        if ($this->db->schema->getTableSchema(self::TABLE_PODCAST_CATEGORY, true) === null)
        {
            $this->createTable(self::TABLE_PODCAST_CATEGORY, [
                'id' => Schema::TYPE_PK,
                'name' => $this->string()->comment('name'),
                'description' => $this->text()->comment('Description'),
                'color' => $this->string()->comment('Color'),
                'created_at' => $this->dateTime()->comment('Created at'),
                'updated_at' =>  $this->dateTime()->comment('Updated at'),
                'deleted_at' => $this->dateTime()->comment('Deleted at'),
                'created_by' =>  $this->integer()->comment('Created by'),
                'updated_by' =>  $this->integer()->comment('Updated at'),
                'deleted_by' =>  $this->integer()->comment('Deleted at'),
            ], $this->db->driverName === 'mysql' ? 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB AUTO_INCREMENT=1' : null);

        }
        else
        {
            echo "Nessuna creazione eseguita in quanto la tabella esiste gia'";
        }


        if ($this->db->schema->getTableSchema(self::TABLE_PODCAST, true) === null)
        {
            $this->createTable(self::TABLE_PODCAST, [
                'id' => Schema::TYPE_PK,
                'title' => $this->string()->comment('Title'),
                'description' => $this->text()->comment('Description'),
                'status' => $this->string()->comment('Status'),
                'image_description' => $this->text()->comment('Image description'),
                'podcast_category_id' => $this->integer()->defaultValue(null)->comment('Category'),
                'created_at' => $this->dateTime()->comment('Created at'),
                'updated_at' =>  $this->dateTime()->comment('Updated at'),
                'deleted_at' => $this->dateTime()->comment('Deleted at'),
                'created_by' =>  $this->integer()->comment('Created by'),
                'updated_by' =>  $this->integer()->comment('Updated at'),
                'deleted_by' =>  $this->integer()->comment('Deleted at'),
            ], $this->db->driverName === 'mysql' ? 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB AUTO_INCREMENT=1' : null);
            $this->addForeignKey('fk_podcast_podcast_category_id1', self::TABLE_PODCAST, 'podcast_category_id', 'podcast_category', 'id');

        }
        else
        {
            echo "Nessuna creazione eseguita in quanto la tabella esiste gia'";
        }


          if ($this->db->schema->getTableSchema(self::TABLE_PODCAST_EPISODE, true) === null)
          {
              $this->createTable(self::TABLE_PODCAST_EPISODE, [
                  'id' => Schema::TYPE_PK,
                  'podcast_id' => $this->integer()->notNull()->comment('Podcast'),
                  'title' => $this->string()->comment('Title'),
                  'status' => $this->string()->comment('Status'),
                  'image_description' => $this->text()->comment('Image description'),
                  'abstract' => $this->text()->comment('Abstract'),
                  'description' => $this->text()->comment('Description'),
                  'main_player_id' =>  $this->integer()->comment('Main player'),
                  'url_spreaker' => $this->string()->comment('Url Spreaker'),
                  'url_soundhound' => $this->string()->comment('Url Soundhound'),
                  'url_apple_podcast' => $this->string()->comment('Url Apple Podcast'),
                  'url_spotify' => $this->string()->comment('Url Spotify'),
                  'url_google_podcast' => $this->string()->comment('Url Google Podcast'),
                  'published_at' => $this->dateTime()->comment('Published at'),
                  'created_at' => $this->dateTime()->comment('Created at'),
                  'updated_at' =>  $this->dateTime()->comment('Updated at'),
                  'deleted_at' => $this->dateTime()->comment('Deleted at'),
                  'created_by' =>  $this->integer()->comment('Created by'),
                  'updated_by' =>  $this->integer()->comment('Updated at'),
                  'deleted_by' =>  $this->integer()->comment('Deleted at'),
              ], $this->db->driverName === 'mysql' ? 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB AUTO_INCREMENT=1' : null);
              $this->addForeignKey('fk_podcast_podcast_id1', self::TABLE_PODCAST_EPISODE, 'podcast_id', 'podcast', 'id');

          }
          else
          {
              echo "Nessuna creazione eseguita in quanto la tabella esiste gia'";
          }


    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->execute('SET FOREIGN_KEY_CHECKS = 0;');
        $this->dropTable(self::TABLE_PODCAST);
        $this->dropTable(self::TABLE_PODCAST_EPISODE);
        $this->dropTable(self::TABLE_PODCAST_CATEGORY);
        $this->execute('SET FOREIGN_KEY_CHECKS = 1;');

    }
}
