<?php

/**
 * Description of ImageSender
 *
 */
class ImageSender
{

    /**
     *
     * @param string $image_path
     * @return void
     * @throws LogicException
     */
    public static function run(string $image_path): void
    {
        try {
            header("Content-type: image/png");
            $image = imagecreatefrompng($image_path);
            imagepng($image);
        } catch (Exception $ex) {
            throw new LogicException ("Image {$image_path} can't be send");
        }
        
    }
}
