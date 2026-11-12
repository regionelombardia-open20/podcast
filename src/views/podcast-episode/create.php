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
 * @var yii\web\View $this
 * @var amos\podcast\models\PodcastEpisode $model
 */

$this->title = Yii::t('amoscore', 'Create episode for').' '.$podcast->title;
$this->params['breadcrumbs'][] = ['label' => '', 'url' => ['/podcast']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('amoscore', 'Podcast Episode'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
//----------------------
$this->params['forceBreadcrumbs'][] = [
    'label' => \amos\podcast\Module::t('amospodcast', "Podcast"),
    'url' => '/podcast/podcast/index',
    'route' => '/podcast/podcast/index',
];
$this->params['forceBreadcrumbs'][] = [
    'label' => \amos\podcast\Module::t('amospodcast', "Episodi podcast"),
    'url' => '/podcast/podcast/update?id='. $model->podcast,
    'route' => '/podcast/podcast/update?id='. $model->podcast,
];
$this->params['forceBreadcrumbs'][] = [
    'label' => $this->title,
];
?>
<div class="podcast-episode-create">
    <?= $this->render('_form', [
        'podcast' => $podcast,
        'model' => $model,
        'fid' => NULL,
        'dataField' => NULL,
        'dataEntity' => NULL,
    ]) ?>

</div>
