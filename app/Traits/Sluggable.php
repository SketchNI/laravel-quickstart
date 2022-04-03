<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait Sluggable
{
    /**
     * Set the models name and update the slug.
     *
     * @param  string  $value
     * @return Sluggable
     */
    public function setName(string $value): static
    {
        $this->name = $value;
        $this->setSlug($value);

        return $this;
    }

    /**
     * Set the models title and update the slug.
     *
     * @param  string  $value
     * @return Sluggable
     */
    public function setTitle(string $value): static
    {
        $this->title = $value;
        $this->setSlug($value);

        return $this;
    }

    /**
     * Update the models slug.
     *
     * @param  string  $value
     * @return void
     */
    private function setSlug(string $value): void
    {
        $this->slug = Str::slug($value);
    }

    /**
     * Return the models slug.
     *
     * @return string
     */
    public function getSlug(): string
    {
        return $this->slug;
    }
}
