<?php

declare(strict_types=1);

namespace App\Traits\Model;

/**
 * Trait Persistable
 *
 * @package App\Traits\Model
 */
trait Persistable
{
    private int $id;

    /**
     * @return bool
     */
    public function isPresent(): bool
    {
        return $this->id > 0;
    }
}
