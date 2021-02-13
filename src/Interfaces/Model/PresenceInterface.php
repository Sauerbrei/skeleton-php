<?php
declare(strict_types=1);

namespace App\Interfaces\Model;

/**
 * Class PresenceInterface
 *
 * @package App\Interfaces\Model
 */
interface PresenceInterface
{
    /**
     * @return bool
     */
    public function isPresent(): bool;
}
