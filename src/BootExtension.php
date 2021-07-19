<?php

namespace OpenAdmin\Admin\Media;

use OpenAdmin\Admin\Admin;

trait BootExtension
{
    /**
     * {@inheritdoc}
     */
    public static function boot()
    {
        static::registerRoutes();

        Admin::extend('media-manager', __CLASS__);
    }

    /**
     * Register routes for open-admin.
     *
     * @return void
     */
    protected static function registerRoutes()
    {
        parent::routes(function ($router) {
            /* @var \Illuminate\Routing\Router $router */
            $router->get('media', 'OpenAdmin\Admin\Media\MediaController@index')->name('media-index');
            $router->get('media/download', 'OpenAdmin\Admin\Media\MediaController@download')->name('media-download');
            $router->delete('media/delete', 'OpenAdmin\Admin\Media\MediaController@delete')->name('media-delete');
            $router->put('media/move', 'OpenAdmin\Admin\Media\MediaController@move')->name('media-move');
            $router->post('media/upload', 'OpenAdmin\Admin\Media\MediaController@upload')->name('media-upload');
            $router->post('media/folder', 'OpenAdmin\Admin\Media\MediaController@newFolder')->name('media-new-folder');
        });
    }

    /**
     * {@inheritdoc}
     */
    public static function import()
    {
        parent::createMenu('Media manager', 'media', 'icon-file');

        parent::createPermission('Media manager', 'ext.media-manager', 'media*');
    }
}
