<?php

namespace App\Traits;

use Ramsey\Uuid\Uuid;

trait HasUuid
{
    /**
     * Set the UUID for this model.
     *
     * @return $this
     */
    public function setUuid(): static
    {
        $this->uuid = Uuid::uuid4();
        return $this;
    }

    /**
     * Get the UUID for this model.
     *
     * @return string
     */
    public function getUuid(): string
    {
        return $this->uuid;
    }
}
