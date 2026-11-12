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

namespace amos\podcast\models;

use amos\podcast\events\PodcastWorkflowEvent;
use open20\amos\attachments\behaviors\FileBehavior;
use open20\amos\core\interfaces\CmsModelInterface;
use open20\amos\notificationmanager\behaviors\NotifyBehavior;
use open20\amos\seo\behaviors\SeoContentBehavior;
use open20\amos\seo\interfaces\SeoModelInterface;
use open20\amos\workflow\behaviors\WorkflowLogFunctionsBehavior;
use raoul2000\workflow\base\SimpleWorkflowBehavior;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "podcast".
 */
class Podcast extends \amos\podcast\models\base\Podcast implements SeoModelInterface
{
    // Workflow ID
    const PODCAST_WORKFLOW = 'PodcastWorkflow';
    // Workflow states IDS
    const PODCAST_WORKFLOW_STATUS_DRAFT = 'PodcastWorkflow/DRAFT';
    const PODCAST_WORKFLOW_STATUS_REQUESTPUBLICATION = 'PodcastWorkflow/REQUESTPUBLICATION';
    const PODCAST_WORKFLOW_STATUS_REJECTED = 'PodcastWorkflow/REJECTED';
    const PODCAST_WORKFLOW_STATUS_PUBLISHED = 'PodcastWorkflow/PUBLISHED';


    public function init()
    {
        if ($this->isNewRecord) {
            $this->status = $this->getWorkflowSource()->getWorkflow(self::PODCAST_WORKFLOW)->getInitialStatusId();
        }
        parent::init();
        $this->on('afterEnterStatus{' . self::PODCAST_WORKFLOW_STATUS_REQUESTPUBLICATION . '}', [new PodcastWorkflowEvent(), 'afterEnterStatus'], $this);
        $this->on('afterEnterStatus{' . self::PODCAST_WORKFLOW_STATUS_PUBLISHED . '}', [new PodcastWorkflowEvent(), 'afterEnterStatus'], $this);

    }

    public function representingColumn()
    {
        return [
//inserire il campo o i campi rappresentativi del modulo
        ];
    }

    public function attributeHints()
    {
        return [
        ];
    }


    /**
     * Returns the text hint for the specified attribute.
     * @param string $attribute the attribute name
     * @return string the attribute hint
     */
    public function getAttributeHint($attribute)
    {
        $hints = $this->attributeHints();
        return isset($hints[$attribute]) ? $hints[$attribute] : null;
    }

    public function rules()
    {
        return ArrayHelper::merge(parent::rules(), [
            ['mainImage', 'file']
        ]);
    }

    public function attributeLabels()
    {
        return
            ArrayHelper::merge(
                parent::attributeLabels(),
                [
                ]);
    }

    /**
     * @return array
     */
    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(),
            [
                'workflow' => [
                    'class' => SimpleWorkflowBehavior::className(),
                    'defaultWorkflowId' => self::PODCAST_WORKFLOW,
                    'propagateErrorsToModel' => true
                ],
                'fileBehavior' => [
                    'class' => FileBehavior::className()
                ],
                'WorkflowLogFunctionsBehavior' => [
                    'class' => WorkflowLogFunctionsBehavior::className(),
                ],
                'SeoContentBehavior' => [
                    'class' => SeoContentBehavior::className(),
                    'imageAttribute' => 'mainImage',
                    'defaultOgType' => 'article',
                    'schema' => 'NewsArticle',
                    'titleAttribute' => 'title',
                    'descriptionAttribute' => 'abstract'
                ]
            ]);
    }


    public function getEditFields()
    {
        $labels = $this->attributeLabels();

        return [
            [
                'slug' => 'title',
                'label' => $labels['title'],
                'type' => 'string'
            ],
            [
                'slug' => 'description',
                'label' => $labels['description'],
                'type' => 'text'
            ],
            [
                'slug' => 'image_description',
                'label' => $labels['image_description'],
                'type' => 'text'
            ],
            [
                'slug' => 'podcast_category_id',
                'label' => $labels['podcast_category_id'],
                'type' => 'integer'
            ],
        ];
    }


    /**
     * @return string marker path
     */
    public function getIconMarker()
    {
        return null; //TODO
    }

    /**
     * If events are more than one, set 'array' => true in the calendarView in the index.
     * @return array events
     */
    public function getEvents()
    {
        return NULL; //TODO
    }

    /**
     * @return url event (calendar of activities)
     */
    public function getUrlEvent()
    {
        return NULL; //TODO e.g. Yii::$app->urlManager->createUrl([]);
    }

    /**
     * @return color event
     */
    public function getColorEvent()
    {
        return NULL; //TODO
    }

    /**
     * @return title event
     */
    public function getTitleEvent()
    {
        return NULL; //TODO
    }

    /**
     * @return string
     */
    public function getTitle(){
        return $this->title;
    }
    /**
     * @return string
     */
    public function getDescription($truncate = false){
        return $this->description;
    }

    /**
     * @return array
     */
    public function getGridViewColumns(){
        return [
            'title'
        ];
    }

    /**
     * @inheritdoc
     */
    public function getSchema()
    {

    }

    /**
     * @param $id
     * @return \yii\db\ActiveQuery
     */
    public function getOtherEpisodes($id){
        return $this->getPodcastEpisodes()
            ->andWhere(['status' => PodcastEpisode::PODCASTEP_WORKFLOW_STATUS_PUBLISHED])
            ->andWhere(['!=','podcast_episode.id' , $id]);
    }


}
