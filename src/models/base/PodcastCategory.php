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

namespace amos\podcast\models\base;

use Yii;
use amos\podcast\Module;

/**
 * This is the base-model class for table "podcast_category".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 *
 * @property \amos\podcast\models\Podcast[] $podcasts
 */
class  PodcastCategory extends \open20\amos\core\record\Record
{
    public $isSearch = false;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'podcast_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['description'], 'string'],
            [['color', 'created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['created_by', 'updated_by', 'deleted_by'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Module::t('amospodcast', 'ID'),
            'name' => Module::t('amospodcast', 'Name'),
            'description' => Module::t('amospodcast', 'Description'),
            'created_at' => Module::t('amospodcast', 'Created at'),
            'updated_at' => Module::t('amospodcast', 'Updated at'),
            'deleted_at' => Module::t('amospodcast', 'Deleted at'),
            'created_by' => Module::t('amospodcast', 'Created by'),
            'updated_by' => Module::t('amospodcast', 'Updated at'),
            'deleted_by' => Module::t('amospodcast', 'Deleted at'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPodcasts()
    {
        return $this->hasMany(\amos\podcast\models\Podcast::className(), ['podcast_category_id' => 'id']);
    }
}
