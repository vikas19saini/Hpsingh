<?php

namespace App\View\Helper;

use Cake\View\Helper;
use Thumber\Utility\ThumbCreator;

Class MediaHelper extends Helper {

    public $helpers = array('Html');

    /**
     * $size = thumbnail, for small size image | full, for full size image
     * $url = image url
     * only for images
     */
    public function get_the_image_url($size, $url) {
        $ext = explode('.', $url);
        if ($size == 'thumbnail') {
            if (in_array($ext[1], array('mp4', 'MP4'))) {
                if (file_exists(WWW_ROOT . str_replace('/', DS, $url))) {
                    return BASE . $url;
                } else {
                    return BASE . 'img/video.png';
                }
            } else {
                if (file_exists(WWW_ROOT . str_replace('/', DS . 'Th_', $url))) {
                    return BASE . str_replace('/', '/Th_', $url);
                } elseif(file_exists(WWW_ROOT . str_replace('/', DS, $url))) {
                    $this->resize($url);
                    return BASE . str_replace('/', '/Th_', $url);
                }else{
                    return BASE . 'img/image_placeholder.png';
                }
            }
        }
        if ($size == 'full') {
            if (in_array($ext[1], array('mp4', 'MP4'))) {
                if (file_exists(WWW_ROOT . str_replace('/', DS, $url))) {
                    return BASE . $url;
                } else {
                    return BASE . 'img/video.png';
                }
            } elseif(file_exists(WWW_ROOT . str_replace('/', DS, $url))) {
                return BASE . $url;
            }else {
                return BASE . 'img/image_placeholder.png';
            }
        }
    }
    public function get_the_image_url_shell($size, $url) {
        $ext = explode('.', $url);
        if ($size == 'thumbnail') {
            if (in_array($ext[1], array('mp4', 'MP4'))) {
                if (file_exists(WWW_ROOT . str_replace('/', DS, $url))) {
                    return \Cake\Core\Configure::read('Store.url') . '/' . $url;
                } else {
                    return \Cake\Core\Configure::read('Store.url') . '/' . 'img/video.png';
                }
            } else {
                if (file_exists(WWW_ROOT . str_replace('/', DS . 'Th_', $url))) {
                    return \Cake\Core\Configure::read('Store.url') . '/' . str_replace('/', '/Th_', $url);
                } else {
                    return \Cake\Core\Configure::read('Store.url') . '/' . 'img/image_placeholder.png';
                }
            }
        }
        if ($size == 'full') {
            if (in_array($ext[1], array('mp4', 'MP4'))) {
                if (file_exists(WWW_ROOT . str_replace('/', DS, $url))) {
                    return \Cake\Core\Configure::read('Store.url') . '/' . $url;
                } else {
                    return \Cake\Core\Configure::read('Store.url') . '/' . 'img/video.png';
                }
            } else {
                if (file_exists(WWW_ROOT . str_replace('/', DS, $url))) {
                    return \Cake\Core\Configure::read('Store.url') . '/' . $url;
                } else {
                    return \Cake\Core\Configure::read('Store.url') . '/' . 'img/image_placeholder.png';
                }
            }
        }
    }

    /**
     * $size = thumbnail, for small size image | full, for full size image
     * $attributes = image tag attributes like class, alt ec 
     * generate img tag with image path
     */
    public function the_image($size, $url, $attributes = array()) {
        $ext = explode('.', $url);
        
        $classForLargeImages = '';
        if (!in_array($ext[1], array('mp4', 'MP4'))){
            list($width, $height) = getimagesize(WWW_ROOT . str_replace('/', DS, $url));
            if($height > $width){
                $classForLargeImages = 'scarve-dupattas';
            }
        }
        
        if(array_key_exists('class', $attributes)){
            $attributes['class'] = $attributes['class'] . " $classForLargeImages";
        }else{
            $attributes['class'] = " $classForLargeImages";
        }
        
        $attributes = $attributes + ['data-sizes' => 'auto'];
        
        if ($size == 'thumbnail') {
            if (in_array($ext[1], array('mp4', 'MP4'))) {
                if (file_exists(WWW_ROOT . str_replace('/', DS, $url))) {
                    return $this->Html->media(BASE . $url, $attributes);
                } else {
                    return $this->Html->image(BASE . 'img/video.png', $attributes);
                }
            } elseif(in_array($ext[1], array('svg', 'SVG'))){
                if (file_exists(WWW_ROOT . str_replace('/', DS, $url))) {
                    return $this->Html->image(BASE . $url, $attributes);
                } else {
                    return $this->Html->image(BASE . 'img/image_placeholder.png', $attributes);
                }
            }else {
                if (file_exists(WWW_ROOT . str_replace('/', DS . 'Th_', $url))) {
                    return $this->Html->image(BASE . str_replace('/', '/Th_', $url), $attributes);
                }elseif(file_exists(WWW_ROOT . str_replace('/', DS, $url))){
                    $this->resize($url);
                    return BASE . str_replace('/', '/Th_', $url);
                } else {
                    return $this->Html->image(BASE . 'img/image_placeholder.png', $attributes);
                }
            }
        }
        if ($size == 'full') {
            if (in_array($ext[1], array('mp4', 'MP4'))) {
                if (file_exists(WWW_ROOT . str_replace('/', DS, $url))) {
                    return $this->Html->media(BASE . $url, $attributes);
                } else {
                    return $this->Html->image(BASE . 'img/video.png', $attributes);
                }
            } else {
                if (file_exists(WWW_ROOT . str_replace('/', DS, $url))) {
                    return $this->Html->image(BASE . $url, $attributes);
                } else {
                    return $this->Html->image(BASE . 'img/image_placeholder.png', $attributes);
                }
            }
        }
    }
    
    public function renderImage($url, $attributes = []){
        return $this->Html->image(BASE . $url, $attributes);
    }
    
    public function imagePlaceholder(){
        return '<i class="fa fa-picture-o" aria-hidden="true"></i>';
    }
    
    public function placeholderImage($type){
        
        if($type === 'url'){
            return BASE . 'img/image_placeholder.png';
        }
        
        return $this->Html->image(BASE . 'img/image_placeholder.png');
    }

    private function resize($url){
        $extArray = explode(".", $url);
        $ext = end($extArray);

        if(in_array(strtolower($ext), ['png', 'jpg', 'jpeg'])){
            $mediaName = str_replace("/", DS, $url);
            $targetNameArr = explode("/", $url);
            $targetName = end($targetNameArr);
            $thumb = new ThumbCreator(WWW_ROOT . $mediaName);
            $thumb->resize(350, 350, ['aspectRatio' => TRUE]);
            $thumb->save(['quality' => 100, 'target' => "Th_" . $targetName]);
        }

        return true;
    }
}
