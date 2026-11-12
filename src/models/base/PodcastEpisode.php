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

use open20\amos\core\record\ContentModel;
use Yii;

/**
 * This is the base-model class for table "podcast_episode".
 *
 * @property integer $id
 * @property integer $podcast_id
 * @property string $title
 * @property string $image_description
 * @property string $abstract
 * @property string $duration
 * @property string $description
 * @property integer $main_player_id
 * @property string $url_spreaker
 * @property string $url_soundhound
 * @property string $url_apple_podcast
 * @property string $url_spotify
 * @property string $url_google_podcast
 * @property string $published_at
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 *
 * @property \amos\podcast\models\Podcast $podcast
 */
abstract class  PodcastEpisode extends ContentModel
{
    public $isSearch = false;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'podcast_episode';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title','abstract', 'main_player_id', 'url_spreaker', 'duration'], 'required'],
            [['url_spreaker'], 'url'],
            [['duration','podcast_id', 'main_player_id', 'created_by', 'updated_by', 'deleted_by'], 'integer'],
            [['image_description', 'abstract', 'description'], 'string'],
            [['status','published_at', 'created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['title', 'url_spreaker', 'url_soundhound', 'url_apple_podcast', 'url_spotify', 'url_google_podcast'], 'string', 'max' => 255],
            [['podcast_id'], 'exist', 'skipOnError' => true, 'targetClass' => Podcast::className(), 'targetAttribute' => ['podcast_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('amospodcast', 'ID'),
            'podcast_id' => Yii::t('amospodcast', 'Podcast'),
            'title' => Yii::t('amospodcast', 'Title'),
            'image_description' => Yii::t('amospodcast', 'Image description'),
            'abstract' => Yii::t('amospodcast', 'Abstract'),
            'description' => Yii::t('amospodcast', 'Description'),
            'main_player_id' => Yii::t('amospodcast', 'Main player'),
            'url_spreaker' => Yii::t('amospodcast', 'Url Spreaker'),
            'url_soundhound' => Yii::t('amospodcast', 'Url Soundhound'),
            'url_apple_podcast' => Yii::t('amospodcast', 'Url Apple Podcast'),
            'url_spotify' => Yii::t('amospodcast', 'Url Spotify'),
            'url_google_podcast' => Yii::t('amospodcast', 'Url Google Podcast'),
            'published_at' => Yii::t('amospodcast', 'Published at'),
            'duration' => Yii::t('amospodcast', 'Duration (min)'),
            'created_at' => Yii::t('amospodcast', 'Created at'),
            'updated_at' => Yii::t('amospodcast', 'Updated at'),
            'deleted_at' => Yii::t('amospodcast', 'Deleted at'),
            'created_by' => Yii::t('amospodcast', 'Created by'),
            'updated_by' => Yii::t('amospodcast', 'Updated at'),
            'deleted_by' => Yii::t('amospodcast', 'Deleted at'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPodcast()
    {
        return $this->hasOne(\amos\podcast\models\Podcast::className(), ['id' => 'podcast_id']);
    }
}
