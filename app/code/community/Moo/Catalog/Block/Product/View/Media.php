<?php

/**
 * Moo Extension
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * @category   Moo
 * @package    Moo_Catalog
 * @author     Mohamed Alsharaf <mohamed.alsharaf@gmail.com>
 * @copyright  Copyright (c) 2010 Mohamed Alsharaf. (http://jamandcheese-on-phptoast.com)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class Moo_Catalog_Block_Product_View_Media extends Mage_Catalog_Block_Product_View_Media
{

    public function renderCloudOptions()
    {
        $output = "";
        $width = $this->getCloudConfig('zoomImage/zoomWidth');
        if (empty($width) || !is_numeric($width)) {
            $width = 'auto';
        }
        $height = $this->getCloudConfig('zoomImage/zoomHeight');
        if (empty($height) || !is_numeric($height)) {
            $height = 'auto';
        }

        $output .= "zoomWidth: '" . $width . "',";
        $output .= "zoomHeight: '" . $height . "',";
        $output .= "position: '" . $this->getCloudConfig('zoomImage/position') . "',";
        $output .= "smoothMove: " . (int) $this->getCloudConfig('zoomImage/smoothMove') . ",";
        $output .= "showTitle: " . ($this->getCloudConfig('zoomImage/showTitle') ? 'true' : 'false') . ",";
        $output .= "titleOpacity: " . (float) ($this->getCloudConfig('zoomImage/titleOpacity') / 100) . ",";

        $adjustX = (int) $this->getCloudConfig('zoomImage/adjustX');
        $adjustY = (int) $this->getCloudConfig('zoomImage/adjustY');
        if ($adjustX > 0) {
            $output .= "adjustX: " . $adjustX . ",";
        }
        if ($adjustY > 0) {
            $output .= "adjustY: " . $adjustY . ",";
        }

        $output .= "lensOpacity: " . (float) ($this->getCloudConfig('lens/lensOpacity') / 100) . ",";

        $tint = $this->getCloudConfig('originalImage/tint');
        if (!empty($tint)) {
            $output .= "tint: '" . $this->getCloudConfig('originalImage/tint') . "',";
        }
        $output .= "tintOpacity: " . (float) ($this->getCloudConfig('originalImage/tintOpacity') / 100) . ",";
        $output .= "softFocus: " . ($this->getCloudConfig('originalImage/softFocus') ? 'true' : 'false') . "";

        return $output;
    }

    public function renderLightboxOptions($options = 'lightbox')
    {
        $enableLightbox = (boolean) $this->getCloudConfig('zoomImage/enableLightbox');
        if ($enableLightbox) {
            return 'data-lightbox="' . $options . '"';
        }
        return '';
    }

    public function getCloudConfig($name)
    {
        return Mage::getStoreConfig('moo_cloudzoom/' . $name);
    }

    public function getCloudImage($product, $imageFile = null)
    {
        if ($imageFile !== null) {
            $imageFile = $imageFile->getFile();
        }
        $image = $this->helper('catalog/image')->init($product, 'image', $imageFile);
        $image_aspect_ratio = Mage::getStoreConfig('mygeneral/product_view/image_aspect_ratio');
                $width = 588;
                //$height = 650;
                if($image_aspect_ratio == '1'){ 
                    $height = 0;
                } else {
                    $height = 588;
                }
                
                
           
            
       // $width = $this->getCloudConfig('originalImage/imageWidth');
        //$height = $this->getCloudConfig('originalImage/imageHeight');
        if($image_aspect_ratio == '1'){
                
            if (!empty($width) && !empty($height)) {
                return $image->constrainOnly(true)->keepAspectRatio(true)->keepFrame(false)->resize($width, $height);
            } else if (!empty($width)) {
                return $image->constrainOnly(true)->keepAspectRatio(true)->keepFrame(false)->resize($width);
            } else if (!empty($height)) {
                return $image->constrainOnly(true)->keepAspectRatio(true)->keepFrame(false)->resize($height);
            }
        } else {
            if (!empty($width) && !empty($height)) {
                return $image->resize($width, $height);
            } else if (!empty($width)) {
                return $image->resize($width);
            } else if (!empty($height)) {
                return $image->resize($height);
            }
        }
        return $image;
    }

}
