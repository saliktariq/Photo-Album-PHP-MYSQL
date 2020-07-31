<?php

    $imagedata = fetchIDData($ID);
    $imageURL=  $imagedata[0]['imageurl'];
    $altText = $imagedata[0]['filename'];
    $width = $imagedata[0]['width'];
    $height = $imagedata[0]['height'];
    $imageID = $imagedata[0]['id'];
    $title = $imagedata[0]['title'];
    $description = $imagedata[0]['description'];

