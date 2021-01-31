<?php

namespace Nbrabant\Offers\Api\Data;

interface BannerResourceInterface
{
    const TABLE_NAME = 'offer_banner';

    const BANNER_ID = 'banner_id';
    const LABEL = 'label';
    const IMAGE_SRC = 'image_src';
    const LINK = 'link';
    const CATEGORY_IDS = 'category_ids';
    const FROM_DATE = 'from_date';
    const TO_DATE = 'to_date';
}
