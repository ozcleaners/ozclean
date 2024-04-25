<?php
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;

Route::get('sitemap', function(){
    // create new sitemap object
    $sitemap = App::make("sitemap");
    // add items to the sitemap (url, date, priority, freq)
    $sitemap->add(URL::to('/'), date('Y-m-d'), '1.0', 'daily');
    //$sitemap->add(URL::to('posts'), '2012-08-26T12:30:00+02:00', '0.9', 'monthly');

    // get all posts from db
    $services = \App\Models\Term::where('parent', 3)->get();
    $zoneServices = \App\Models\Term::serviceCat();
//    dd($categories);
    // add every post to the sitemap
    foreach ($zoneServices as $zone => $service)
    {

        foreach($service as $key => $parent){
            foreach ($parent['zone_wise_content_title'] as $index => $sub_services){
                $route = route('frontend_zone_wise_service_single', [$parent['zone_lowercase_name'], $parent['seo_url'], $sub_services['content_seo_url']]) ;
                $sitemap->add($route, date('Y-m-d'), '1.0', 'daily');
            }
        }

        //$sitemap->add(URL::to('service/'.$category->seo_url), $category->updated_at, '1.0', 'daily');
//        $subCats = \App\Models\Term::where('parent', $category->id)->get();
//        foreach ($subCats as $cats){
//            $sitemap->add(URL::to('service/'.$category->seo_url.'/'.$cats->seo_url), $cats->updated_at, '1.0', 'daily');
//        }
     }
    $sitemap->add(URL::to('blogs'), date('Y-m-d'), '1.0', 'daily');
    //Blog
    $blogs =  \App\Models\Post::where('is_active', 1)->whereRaw("FIND_IN_SET('66',categories)")->get();

    foreach ($blogs as $blog)
    {
        $sitemap->add(URL::to('blogs/'.$blog->seo_url), $blog->updated_at, '1.0', 'daily');
    }

    $sitemap->add(URL::to('booking_form'), date('Y-m-d'), '1.0', 'daily');
    $sitemap->add(URL::to('contact'), date('Y-m-d'), '1.0', 'daily');
    $sitemap->add(URL::to('photo-gallery'), date('Y-m-d'), '1.0', 'daily');

    // generate your sitemap (format, filename)
    //$sitemap->store('xml', 'sitemap');
    $sitemap->store('xml', '../sitemap');
    // this will generate file mysitemap.xml to your public folder
    //dd($sitemap);
//    return redirect(url('public/sitemap.xml'));
    return redirect(url('sitemap.xml'));
});
