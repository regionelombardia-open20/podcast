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
 * @var $model \amos\podcast\models\PodcastEpisode
 */

use yii\helpers\Html;
use amos\podcast\Module;
/* use amos\podcast\assets\ModulePodcastAsset;
ModulePodcastAsset::register($this); */

?>
<?php
$url = '/img/img_default.jpg';
if ($model->mainImage) {
    $url = $model->mainImage->getWebUrl();
}
?>

<div class="podcast-item-container my-3 row">
    <div class="col-sm-4 col-md-3 mb-3 mb-md-0 container-img">
        <a href="#" title="Vai alla puntata">
            <img class="img-responsive" alt="immagine podcast" src="<?= $url ?>" >
        </a>
    </div>
    <div class="col-sm-8 col-md-9 d-flex flex-column container-info"> 
        <a href="/podcast/podcast-episode/view?id=<?= $model->id?>" title="Vai alla puntata <?= $model->title?>" class="link-list-title mr-3 mb-0">
            <h4 class="h5 title-one-line"><?= $model->title?></h4>
        </a>
        <p class="h5 m-b-10">(<?= $model->duration?>’) - <?= \Yii::$app->formatter->asDate($model->published_at, 'long') ?></p>
        <p class="m-t-0 d-flex align-items-end podcast-description title-three-line"><?= $model->abstract ?></p>
    </div>
</div>