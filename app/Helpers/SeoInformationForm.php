<?php

namespace App\Helpers;

use http\Env\Request;
use App\Models\SeoInformation;

class SeoInformationForm
{

    public static function getForm($content_type, $options = array())
    {
        $default = [
            'content_id' => null,
            'content_type' => $content_type,
            'meta_zone' => null,
            'meta_title' => null,
            'meta_description' => null,
            'meta_keywords' => null,
            'canonical_tags' => null,
            'meta_author' => null,
            'save_btn' => true,
            'required' => true,
            'update_row_id_name' => 'id',
            'form' => true,
        ];

        $route_url = route('common_term_custom_field_seo_store');

        $new = (object) array_merge($default, $options);
        $updated_row_id = null;
        $updated_row_id_name = $new->update_row_id_name;
        $required = $new->required ? 'required' : null;

        if (!empty($new->meta_zone)) {
            $saveSeo = SeoInformation::where('content_id', $new->content_id)->where('content_type', $new->content_type)->where('meta_zone', $new->meta_zone)->first();
        } else {
            $saveSeo = SeoInformation::where('content_id', $new->content_id)->where('content_type', $new->content_type)->first();
        }


        if (!empty($saveSeo)) {
            $getSavedData = [
                'content_id' => $saveSeo->content_id ?? NULL,
                'content_type' => $saveSeo->content_type,
                'meta_zone' => $saveSeo->meta_zone,
                'meta_title' => $saveSeo->meta_title,
                'meta_description' => $saveSeo->meta_description,
                'meta_keywords' => $saveSeo->meta_keywords,
                'canonical_tags' => $saveSeo->canonical_tags,
                'meta_author' => $saveSeo->meta_author,
                'save_btn' => $new->save_btn,
                'required' => $new->required,
                'update_row_id_name' => $new->update_row_id_name,
                'form' => $new->form,
            ];
            $new = (object) $getSavedData;
            $route_url = route('common_term_custom_field_seo_update');
            $updated_row_id = $saveSeo->id;
        }
        ?>

        <?php
        if($new->form == true) : ?>
        <form action="<?php echo $route_url; ?>" method="post">
            <?php echo csrf_field(); ?>
        <?php endif ?>
            <?php if ($updated_row_id) : ?>
                <input type="hidden" value="<?php echo $updated_row_id; ?>"
                       name="<?php echo $updated_row_id_name; ?>"
                       class="form-control"/>
            <?php endif ?>
            <input type="hidden" value="<?php echo $new->content_id; ?>"
                   name="content_id"
                   class="form-control"/>
            <input type="hidden" value="<?php echo $new->content_type ?? 'Term'; ?>"
                   name="content_type"
                   class="form-control"/>

            <div class="form-group">
                <label for="meta_title" class="meta_title">Meta Title</label>
                <input type="text"
                       value="<?php echo isset($new) ? $new->meta_title : ''; ?>"
                       name="meta_title" class="form-control" <?php echo $required ?>/>
            </div>

            <div class="form-group">
                <label for="meta_description" class="meta_description">Meta Description</label>
                <textarea name="meta_description"
                          class="form-control"
                          <?php echo $required ?>><?php echo isset($new) ? $new->meta_description : ''; ?></textarea>
            </div>
            <div class="form-group">
                <label for="meta_keywords" class="meta_keywords">Meta Keywords</label>
                <textarea name="meta_keywords"
                          class="form-control"
                          <?php echo $required ?>><?php echo isset($new) ? $new->meta_keywords : ''; ?></textarea>
            </div>

            <div class="form-group">
                <label for="canonical_tags" class="canonical_tags">Canonical Tags</label>
                <input type="text"
                       value="<?php echo isset($new) ? $new->canonical_tags : ''; ?>"
                       name="canonical_tags" class="form-control"/>
            </div>
            <div class="form-group">
                <label for="meta_author" class="meta_author">Meta Author</label>
                <input type="text"
                       value="<?php echo isset($new) ? $new->meta_author : ''; ?>"
                       name="meta_author" class="form-control"/>
            </div>
            <div class="form-group">
                <label for="meta_zone" class="meta_zone">Meta Zone</label>
                <input type="text"
                       value="<?php echo isset($new) ? $new->meta_zone : request()->zone; ?>"
                       name="meta_zone" class="form-control" readonly/>
            </div>
            <?php if($new->save_btn) : ?>
            <div class="form-group">
                <label style="width: 20%;">&nbsp;</label>
                <div class="form-submit_btn">

                    <button type="submit" id="menu-generator-cat-submit"
                            class="btn blue">
                        Save Changes
                    </button>
                </div>
            </div>
            <?php endif;?>
        <?php if($new->form) : ?>
        </form>
        <?php endif;?>
        <?php
    }

}
