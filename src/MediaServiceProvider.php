<?php

namespace OpenAdmin\Admin\Media;

use Illuminate\Support\ServiceProvider;

class MediaServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'open-admin-media');

        MediaManager::boot();
    }
}
