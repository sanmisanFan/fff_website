<?php

namespace App\Admin\Extensions;

use Encore\Admin\Form\Field;

class WangEditor extends Field
{
    protected $view = 'admin.editor';

    protected static $css = [
        '/packages/wangEditor/dist/css/wangEditor.min.css',
    ];

    protected static $js = [
        '/packages/wangEditor/dist/js/wangEditor.min.js',
    ];

    public function render()
    {

        $this->script = <<<EOT

var editor = new wangEditor('{$this->id}');
editor.create();

EOT;
        return parent::render();

    }
}
