<?php

declare(strict_types=1);

namespace Terminal42\InsertTagsBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class Terminal42InsertTagsBundle extends Bundle
{
    public function getPath(): string
    {
        return \dirname(__DIR__);
    }
}
