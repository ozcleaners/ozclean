<div id="service_content_breakdown">
    <div class="content_form">
        <?php
        if (isset($termcustomfield)) {
            $route_url = route('common_term_custom_field_seo_update');
        } else {
            $route_url = route('common_term_custom_field_seo_store');
        }

        $options = [
            'content_id' => isset($termcustomfield) ? $termcustomfield->id : request()->id,
            'content_type' => 'Term',
            'meta_zone' => request()->zone
        ];
        ?>
        {!! App\Helpers\SeoInformationForm::getForm('Term', $options) !!}

    </div>
</div>
