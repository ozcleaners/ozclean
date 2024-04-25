<?php
if (!function_exists('metas')) {
    function metas(array $new_options = [])
    {
        $options = [
            'title' => null,
            'description' => null,
            'keywords' => null,
            'url' => null,
            'img_url' => null
        ];
        $urls = array_merge($options, $new_options);
        $setting = App\Models\GlobalSetting::where('id', 1)->get()->first();

        $title = (!empty($urls['title']) ? $urls['title'] : $setting->meta_title);
        $description = (!empty($urls['description']) ? $urls['description'] : $setting->meta_description);
        $keywords = (!empty($urls['keywords']) ? $urls['keywords'] : $setting->meta_keywords);
        $url = (!empty($urls['url']) ? $urls['url'] : request()->url());
        $img_url = (!empty($urls['img_url']) ? $urls['img_url'] : $setting->logo);

        //dd($setting);
        $html = '<meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">';
        $html .= '<title>' . $title . '</title>';

        $html .= '<meta name="description" content="' . $description . '">';
        $html .= '<meta name="keywords" content="' . $keywords . '">';
        //$html .= '<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">';
        //$html .= '<meta name="viewport" content="width=device-width, initial-scale=1">';
        $html .= '<meta property="og:site_name" content="' . $title . '"/>';
        $html .= '<meta property="og:locale" content="au_AUS"/>';
        $html .= '<meta property="og:type" content="article"/>';
        $html .= '<meta property="og:title" content="' . $title . '"/>';
        $html .= '<meta property="og:description" content="' . $description . '"/>';
        $html .= '<meta property="og:url" content="' . $url . '" />';
        //$html .= '<meta property="og:image" content="' . $img_url . '"/>';
        $html .= '<meta property="fb:pages" content="' . $setting->facebook_page_id . '"/>';
        $html .= '<link rel="icons" href="' . $setting->favicon . '">';

        $html .= '<meta name="author" content="Oz Cleaners">';
        $html .= '<meta name="robots" content="index, follow" />';
        $html .= '<meta name="zone" content="Australia">';
      	$html .= '<link rel="canonical" href="'. (!empty($urls['url']) ? $urls['url'] : request()->url()) .'">';

        return $html;
    }
}


if (!function_exists('get_global_setting')) {
    function get_global_setting($column_name = false)
    {
        $setting = App\Models\GlobalSetting::where('id', 1)->get()->first();

        if (!empty($column_name)) {
            return $setting->$column_name;
        } else {
            return $setting->name;
        }
    }
}


if (!function_exists('get_frontend_setting')) {
    function get_frontend_setting($meta_key_name, $with_pipe = true)
    {
        $setting = App\Models\FrontendSettings::where('meta_name', $meta_key_name)->get()->first();

        if ($with_pipe = true) {
            // return array

            $data = array();

            $data['meta_title'] = $setting->meta_title;
            $data['meta_name'] = $setting->meta_name;
            $data['meta_value'] = explode('|', $setting->meta_value);
            $data['meta_type'] = $setting->meta_type;
            $data['meta_group'] = $setting->meta_group;
            $data['meta_order'] = $setting->meta_order;
            $data['meta_placeholder'] = $setting->meta_placeholder;
            $data['created_at'] = $setting->created_at;
            $data['updated_at'] = $setting->updated_at;


            return $data;
        } else {
            // return single value

            return $setting->meta_value;
        }
    }
}


