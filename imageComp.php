<?php

/*
Title: Project 2
Author: Vivian Tran
Student ID: 009199801
Date: 10/2/2018
*/

/*
 * Image class
*/
class Image
{
    public $fileName;
    public $image;

    /*
    * Constructor
    * Saves the variables and loads images from disk
    */
    public function __construct($fileName)
    {
        if ($fileName == null) {
            $fileName = 'default.jpg';
        } else {
            $this->fileName = $fileName;
            if (exif_imagetype($fileName) == IMAGETYPE_JPEG) {
                $this->image = imagecreatefromjpeg($fileName);
            } else {
                $this->image = imagecreatefrompng($fileName);
            }
        }
    }

    /*
     * Will return image within the class
    */
    public function getImage()
    {
        return $this->image;
    }

    /*
    * Takes image given and composes it over the current images
    * Will move the image foreground according to coordinates
    */
    public function comp($foreground, $offsetx, $offsety, $fileNameOut)
    {

      // Converts file to image and gets width/height
        $image = $foreground->getImage();
        $background = $this->image;
        $imagewidth = imagesx($image)-1;
        $imageheight = imagesy($image)-1;
        $rgba = imagecolorat($image, 0, 0);
        $alpha = ($rgba & 0x7F000000) >> 24;
        //Loop through each pixel and grayscale it
        for ($x = 0; $x <= $imagewidth; $x++) {
            for ($y = 0; $y <= $imageheight; $y++) {

              // Reference: http://php.net/manual/en/function.imagecolorat.php
                $rgba = imagecolorat($image, $x, $y);
                $r = ($rgba >> 16) & 0xFF;
                $g = ($rgba >> 8) & 0xFF;
                $b = $rgba & 0xFF;
                $alpha = ($rgba & 0x7F000000) >> 24;

                // Creates a color identifier
                $identifier = imagecolorallocatealpha($image, $r, $b, $g, $alpha);

                // Changes the pixel color
                imagesetpixel($background, $x+$offsetx, $y+$offsety, $identifier);
            }
        }

        // Save over background image
        imagepng($background, $fileNameOut);
    }
}
?>
