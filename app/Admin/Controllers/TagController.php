<?php

namespace App\Admin\Controllers;

use App\Tag;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class TagController extends Controller
{
    use ModelForm;

    /**
     * Index interface.
     *
     * @return Content
     */
    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header('标签/Tags');
            $content->description('列表');

            $content->body($this->grid());
        });
    }

    /**
     * Edit interface.
     *
     * @param $id
     * @return Content
     */
    public function edit($id)
    {
        return Admin::content(function (Content $content) use ($id) {

            $content->header('标签');
            $content->description('编辑修改');

            $content->body($this->form()->edit($id));
        });
    }

    /**
     * Create interface.
     *
     * @return Content
     */
    public function create()
    {
        return Admin::content(function (Content $content) {

            $content->header('标签');
            $content->description('创建新标签');

            $content->body($this->form());
        });
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Admin::grid(Tag::class, function (Grid $grid) {

            $grid->id('ID')->sortable();
            $grid->tag('标签');
            $grid->column('title', '标签标题')->sortable();
            $grid->column('subtitle', '标签副标题');

            $grid->page_image('标签图片')->image();

            $grid->meta_description('标签SEO介绍');
            $grid->layout()->sortable();
            $grid->reverse_direction('按时间排列文章')->sortable()->display(function ($reverse_direction){
                if ($reverse_direction == 0) {
                    return "默认降序";
                }else if ($reverse_direction == 1) {
                    return "升序";
                }else{
                    return "<span style='color:red'>按时间排列顺序错误！请修改！</span>";
                }
            });

            //$grid->created_at('创建时间')->sortable();
            $grid->updated_at('更新时间')->sortable();

            // filter($callback)方法用来设置表格的简单搜索框
            $grid->filter(function ($filter) {

                $filter->disableIdFilter();

                // 设置created_at字段的范围查询
                //$filter->between('created_at', 'Created Time')->datetime();
                
                // sql: ... WHERE `tag` LIKE "%$input" OR `title` LIKE "%$input";
                $filter->where(function ($query) {
                    $query->where('tag', 'like', "%{$this->input}%")
                        ->orWhere('title', 'like', "%{$this->input}%");

                }, '按标签名查询');
            });

            $grid->actions(function ($actions) {
                if ($actions->getKey() == 1) {
                    $actions->disableDelete();
                }
            });

            $grid->disableBatchDeletion();

        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(Tag::class, function (Form $form) {

            $form->display('id', 'ID');
            $form->text('tag', '标签')->rules('required')->help('输入标签名称(｡・`ω´･)');
            $form->text('title', '标签标题')->rules('required')->help('输入标签用以显示在网站页面上的标题');
            $form->text('subtitle', '标签副标题');
            $form->image('page_image', '标签图片'); //should set a default pic route later
            $form->text('meta_description', '标签SEO介绍');
            $form->text('layout')->default('mainsite.layouts.index')->rules('required')->help('定义标签页面使用的布局');
            $form->radio('reverse_direction', '按时间排列文章')->values([0 => '按时间降序排列文章', 1 => '按时间升序排列文章'])->default(0);

            $form->display('created_at', '创建时间');
            $form->display('updated_at', '更新时间');

            $form->tools(function (Form\Tools $tools) {
                // 去掉返回按钮
                $tools->disableBackButton();
            });

        });
    }
}
