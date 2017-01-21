<?php

namespace App\Admin\Extensions;

use Encore\Admin\Form\Field;

class CKEditor extends Field
{
    protected $view = 'admin.editor';

    protected static $js = [
        '/assets/vendor/ckeditor/ckeditor.js',
    ];

    public function render()
    {

        $this->script = <<<EOT

CKEDITOR.replace( '{$this->id}' );

EOT;
        return parent::render();

    }
}
