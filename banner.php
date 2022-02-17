<?php

require_once 'env.php';
spl_autoload_register();

$image_path = "https://infusemedia.com/wp-content/uploads/2021/09/2-column-thumbnail-image-700%D1%85305-1.png";

try {
    if (!empty(Request::server('HTTP_REFERER'))) {
        $database = new Database(DB_DRIVER, DB_HOST, DB_NAME, DB_USER, DB_PASSWORD);

        $visitor_repository = new VisitorRepository($database);

        $visitor = new Visitor($visitor_repository);
        $visitor->save();
    }

    ImageSender::run($image_path);
} catch (Exception $error) {
//    Place to logging exceptions.
}
