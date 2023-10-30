<?php

/*
 * This file is part of the API Platform project.
 *
 * (c) Kévin Dunglas <dunglas@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace ApiPlatform\Tests\Fixtures\TestBundle\Entity\Issue5926;

class MediaContentItem implements ContentItemInterface
{
    public function __construct(
        private readonly Media $media,
    ) {
    }

    public function getMedia(): Media
    {
        return $this->media;
    }
}
