<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\ContactMeRequest;
use Illuminate\Support\Facades\Mail;
use App\Category;
use App\Post;
use App\Tag;

class ContactController extends Controller
{
    /**
     * 显示表单
     *
     * @return View
     */
    public function showForm()
    {
        $categories = Category::Has('posts')->where('parent_id', 0)->get();
        //echo $categories;
        return view('mainsite.contact')->with('categories', $categories);
    }

    /**
     * Email the contact request
     *
     * @param ContactMeRequest $request
     * @return Redirect
     */
    public function sendContactInfo(ContactMeRequest $request)
    {
        $data = $request->only('name', 'email', 'phone');
        $data['messageLines'] = explode("\n", $request->get('message'));

        Mail::send('emails.contact', $data, function ($message) use ($data) {
            $message->subject('网站的联系邮件: '.$data['name'])
              ->to(config('website.contact_email'))
              ->replyTo($data['email']);
        });

        return back()
            ->withSuccess("非常感谢您的给我们的意见和留言～邮件已经成功发送给FoodForFun的小伙伴们啦！");
    }
}
