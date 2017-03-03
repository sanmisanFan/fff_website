<?php

namespace App\Admin\Controllers;

use App\Category;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Row;
use Encore\Admin\Widgets\Box;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Encore\Admin\Tree;

class CategoryController extends Controller
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

            $content->header('分类');
            $content->description('列表');

            $content->row(function (Row $row) {
                $row->column(6, $this->treeView()->render());

                $row->column(6, function (Column $column) {
                    $form = new \Encore\Admin\Widgets\Form();
                    $form->action(admin_url('categories'));

                    $form->select('parent_id', '父级分类')->options(Category::selectOptions('name'));
                    $form->text('title', '分类名')->rules('required');
                    $form->text('subtitle', '分类副标题');
                    $form->image('page_image', '分类图片');

                    $form->text('meta_description', '分类SEO介绍');
                    $form->text('layout')->default('mainsite.layouts.index')->rules('required')->help('定义标签页面使用的布局');

                    $column->append((new Box('新增分类', $form))->style('success'));
                });
            });
        });
    }

    /**
     * Redirect to edit page.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function show($id)
    {
        return redirect()->action(
            '\App\Admin\Controllers\CategoryController@edit', ['id' => $id]
        );
    }

    /**
     * @return \Encore\Admin\Tree
     */
    protected function treeView()
    {
        return Category::tree(function (Tree $tree) {
            $tree->disableCreate();

            $tree->branch(function ($branch) {
                //$src = config('admin.upload.host') . '/' . $branch['logo'] ;

                //$logo = "<img src='$src' style='max-width:30px;max-height:30px' class='img'/>";

                return "{$branch['title']}";
            });
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

            $content->header('分类');
            $content->description('修改');

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

            $content->header('分类');
            $content->description('新增分类');

            $content->body($this->form());
        });
    }


    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(Category::class, function (Form $form) {

            $form->display('id', 'ID');

            $form->select('parent_id', '父级分类')->options(Category::selectOptions());
            $form->text('title', '分类名')->rules('required');
            $form->text('subtitle', '分类副标题');
            $form->image('page_image', '分类图片'); 
            $form->text('meta_description', '分类SEO介绍');
            $form->text('layout')->default('mainsite.layouts.index')->rules('required')->help('定义标签页面使用的布局');

            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');

            $form->tools(function (Form\Tools $tools) {
                // 去掉返回按钮
                $tools->disableBackButton();
            });

        });
    }
}
