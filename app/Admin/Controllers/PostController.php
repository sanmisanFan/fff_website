<?php

namespace App\Admin\Controllers;

use App\Post;
use App\Tag;
use App\Category;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Carbon\Carbon;

class PostController extends Controller
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

            $content->header('文章');
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

            $content->header('文章');
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

            $content->header('文章');
            $content->description('创建');

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
        return Admin::grid(Post::class, function (Grid $grid) {

            $grid->id('ID')->sortable();
            $grid->column('title', '标题')->sortable();
            $grid->column('subtitle', '副标题')->limit(30);
            $grid->page_thumbnail('文章图片')->image();

            $grid->categories('分类')->pluck('title')->label('info')->sortable();

            $grid->tags('标签')->pluck('tag')->label();

            /*
            $grid->tags('标签')->value(function ($tags) {
                $tags = array_map(function ($tag) {
                    return "<span class='label label-success'>{$tag['tag']}</span>";
                }, $tags);

                return implode('&nbsp;', $tags);
            })->sortable();
            */

            $states = [
                'on' => ['value' => 1, 'text' => 'YES'],
                'off' => ['value' => 0, 'text' => 'NO'],
            ];

            $grid->is_draft('是否为草稿')->switch($states)->sortable();

            $grid->slug('预览')->value(function ($slug) {
                return "<a target='_blank' href='/article/$slug'><i class='fa fa-eye'></i></a>";
            });


            $grid->updated_at('修改时间')->sortable();
            $grid->published_at('发布时间')->sortable();

            //按照文章名字或者Tag名模糊查询指定文章
            $grid->filter(function ($filter) {

                $filter->disableIdFilter();

                // 设置created_at字段的范围查询
                //$filter->between('created_at', 'Created Time')->datetime();
                
                // sql: ... WHERE `tag` LIKE "%$input" OR `title` LIKE "%$input";
                $filter->where(function ($query) {
                    $input = $this->input;
                    $query->whereHas('tags', function ($query) use ($input) {
                        $query->where('tag', 'like', $input);
                    })->orWhere('title', 'like', "%{$this->input}%");

                }, '文章或标签名查询');
            });

            //文章预览图标
            $grid->actions(function ($actions) {

                if ($actions->getKey() > 0) {
                    $actions->disableDelete();
                    //$actions->append('<a href=""><i class="fa fa-eye"></i></a>');
                }
            });

        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(Post::class, function (Form $form) {

            $published_at = Carbon::now();

            $form->display('id', 'ID');
            $form->text('title', '标题')->rules('required')->help('输入标签用以显示在网站页面上的标题');
            $form->text('subtitle', '副标题');
            $form->image('page_image', '文章图片'); //should set a default pic route later
            $form->image('page_thumbnail', '缩略图')->resize(null, 360, function ($constraint) {
                                                                            $constraint->aspectRatio();
                                                                        });


            
            $form->switch('is_draft', '是否为草稿'); 

            $form->multipleSelect('categories', '分类')->options(Category::all()->pluck('title', 'id'));

            $form->multipleSelect('tags', '标签')->options(Tag::all()->pluck('tag', 'id'));
            $form->text('layout')->default('mainsite.layouts.post')->rules('required')->help('定义文章页面使用的布局');
            $form->datetime('published_at', '选择发布时间')->default($published_at)->rules('required')->help('文章发布时间，请注意选择关闭草稿模式！');
            
            $form->text('meta_description', '文章SEO介绍');

            $form->editor('content', '正文内容');

            $form->tools(function (Form\Tools $tools) {
                // 去掉返回按钮
                $tools->disableBackButton();
            });

            //$form->setWidth(8);

        });
    }
}
