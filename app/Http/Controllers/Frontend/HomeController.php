<?php

namespace App\Http\Controllers\Frontend;

use App\Helpers\MailHelper;
use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\SeoInformation;
use App\Models\Term;
use App\Models\Post;
use App\Models\TermCustomField;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function index()
    {
        return view('frontend.index');
    }

    public function page($slug)
    {
        $page = Page::where('seo_url', $slug)->first();
        if($page){
            return view('frontend.page')->with([
                'page' => $page,
            ]);
       }else {
            return redirect()->to('/');
        }
    }

    public function service($slug)
    {
        $term = Term::where('seo_url', $slug)->first();
        if($term){
        return view('frontend.service')->with([
            'term' => $term,
        ]);
        }else {
            return redirect()->to('/');
        }
    }

    public function blogs()
    {
        $subCats = Term::select('id')->where('parent', 66)->get();
        $sub_cats = [];
        foreach ($subCats as $val) {
            $sub_cats[] = $val->id;
        }
        $sC = implode(', ', $sub_cats);
        $pro_tips = Post::whereIn('categories', [66, $sC])->get();

        return view('frontend.templates.page.blogs')->with([
            'blogs' => $pro_tips
        ]);
    }

    public function blog($slug)
    {
        $page = Post::where('seo_url', $slug)->first();
//        dd($page);
        if($page) {
            $term = $page;
            $term_custom_field = TermCustomField::where('content_term_id', $page->id)
                ->where('content_type', 'Term Title')
                ->where('content_for', 'Post')
                ->first();
//        $term = Term::where('id', $term_custom_field->content_term_id ?? null)->first();
            $term = $page;
            $term_seo_information = SeoInformation::where('content_id', $page->id ?? NULL)->where('content_type', 'Post')->first();

            return view('frontend.single_blog')->with([
                'page' => $page,
                'term' => $term,
                'term_custom_field' => $term_custom_field,
                'seo_information' => $term_seo_information
            ]);
        }else {
            return redirect()->to('/');
        }
    }

    public function contact(Request $request)
    {
        if ($request->_token) {
            $details = [
                'fname' => $request->first_name,
                'lname' => $request->last_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'subject' => $request->subject,
                'message' => $request->message,
            ];
                //Mail::to(get_global_setting('email'))->send(new SendMail($details));
                $subject = $request->subject;
                $address = get_global_setting('email');
                $data = implode('<br>', $details);
                MailHelper::send($data, $subject, $address, $cc_emails = false);
//            return view('frontend.templates.page.contact')->with([
//                'status' => 1,
//                'message' => 'We appreciate you contacting us. We will get back in touch with you soon!'
//            ]);
            return redirect()->route('frontend_thank_you')->with(['hash_code' =>  $request->phone, 'message' => 'Thanks for contacting Oz Cleaners. Your queries have been submitted.
One of our friendly team members will get back to you soon.
']);
        } else {
            return view('frontend.templates.page.contact');
        }
    }

    public function editProfile(Request $request)
    {
        return view('frontend.user.edit_profile');
    }

    public function modifyProfile(Request $request)
    {
        //dd($request->all());

        $attributes = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'postcode' => $request->postcode
        ];

        try {
            $userupdate = $this->user::where('id', $request->id)->update($attributes);
            return redirect()->route('frontend_edit_profile', $request->id)->with(['status' => 1, 'message' => 'Successfully updated']);
        } catch (\Exception $e) {
            return redirect()->route('frontend_edit_profile', $request->id)->with(['status' => 0, 'message' => 'Error']);
        }
    }
}
