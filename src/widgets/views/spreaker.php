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
 * @var $episode_id
 * @var $enable_cover
 */

use yii\helpers\Html;

$this->registerJsFile('https://widget.spreaker.com/widgets.js', ['async' => true]);

$config =
[
    'class' => 'spreaker-player',
    'data-resource' => 'episode_id='.$episode_id,
    'data-width' =>  !empty($pluginOptions['data-width']) ? $pluginOptions['data-width'] : '500px',
    'data-height' => !empty($pluginOptions['data-height']) ? $pluginOptions['data-height'] : '250px',
    'data-theme' => 'dark',
    'data-playlist' => 'false',
    'data-playlist-continuous' => 'false',
    'data-autoplay' => 'false',
    'data-live-autoplay' => 'false',
//    'data-chapters-image' => $enable_cover,
    'data-episode-image-position' => 'right',
    'data-hide-logo' => 'false',
    'data-hide-likes' => 'true',
    'data-hide-comments' => 'true',
    'data-hide-sharing' => 'true',
    'data-hide-download' => 'true',
//    'data-cover' => $url,
];
//pr($url);
if(!empty($url)){
    $config['data-chapters-image'] = $enable_cover;
    $config['data-cover'] = $url;
}
else {
    $config['data-width'] = '100%';
    $config['data-height'] = '100%';
}

//pr($config);
if(!empty($show_id) && empty($episode_id)){
    $config['data-resource'] = 'show_id='.$show_id;
}
?>
<?php echo Html::a('Ascolta "Podcast test" su Spreaker.', $model->url_spreaker, $config ) ?>