<?php

if (!function_exists('select_option_html')) {
    function select_option_html($category, $parent = 0, $seperator = ' ', $cid = null, $li = false, $others = false)
    {
        $html = '';
        if ($parent === null) {
            $current_lvl_keys = array_keys(array_column($category, 'parent'), $parent, true);
        } else {
            $current_lvl_keys = array_keys(array_column($category, 'parent'), $parent);
        }

        //dd($current_lvl_keys);
        if (!empty($current_lvl_keys)) {
            if ($li == true) {
                $html .= '<ul class="list-group">';
            }
            foreach ($current_lvl_keys as $key) {
                $is_selected = ($cid == $category[$key]['id']) ? 'selected="selected"' : '';
                if ($li == true) {
                    $editbtn = '<a type="button" href="' . route('common_term_edit', $category[$key]['id']) . '" class=" text-success">
                        <span class="icon-edit"></span>
                    </a>';
                    if ($category[$key]['id'] != 1 && $category[$key]['id'] != 2 && $category[$key]['id'] != 3) {
                        $delbtn = Form::open(['method' => 'delete', 'route' => ['common_term_destroy', $category[$key]['id'], 'class' => '']]);
                        $delbtn .= Form::button('<i class="icon-trash is-red text-danger"></i>', array('type' => 'submit', 'onclick' => 'return confirm(\'Are you sure?\')', 'class' => 'btn btn-sm border-0'));
                        $delbtn .= Form::close();

                        //$delbtn = '<a href="' . route('common_term_destroy', $category[$key]['id']) . '" class=" text-danger" onclick="return confirm(\'You are attempting to remove this category forever. Are you Sure?\')" title="Delete Now"><span class="icon-trash is-red"></span></a>';
                    } else {
                        $delbtn = '';
                    }

                    $html .= '<li class="p-0 border-0 border-bottom list-group-item align-items-center">';
                    $html .= $seperator;
                    $html .= '<span class="" title="Term ID">';
                    $html .= "(" . $category[$key]['id'] . ") ";
                    $html .= '</span>';
                    $html .= $category[$key]['name'];
                    $html .= '<div class="text-right d-inline-block float-end">';
                    $html .= '<span class="badge text-success fw-normal">';
                    $html .= $editbtn;
                    $html .= '</span>';
                    $html .= '<span class="badge text-danger fw-normal">';
                    $html .= $delbtn;
                    $html .= '</span>';
                    $html .= '</div>';
                    $html .= '</li>';

                    $html .= select_option_html($category, $category[$key]['id'], $seperator . '-- ', $cid, true);
                } else {
                    $html .= '<option ' . $is_selected . " value='" . $category[$key]['id'] . "'>" . $seperator . $category[$key]['name'] . '</option>';
                    $html .= select_option_html($category, $category[$key]['id'], $seperator . '-&nbsp;', $cid, false);
                }
            }
            if ($li == true) {
                $html .= '</ul>';
            }
        }

        return $html;
    }
}

if (!function_exists('category_h_checkbox_html')) {
    function category_h_checkbox_html($category, $parent, $seperator, $selected_category_ids)
    {
        $current_lvl_keys = array_keys(array_column($category, 'parent'), $parent);
        if (!empty($current_lvl_keys)) :
            ?>
            <ul style="list-style: none;">
                <?php foreach ($current_lvl_keys as $key) : ?>
                    <li style="display: inline-block;">
                        <?php //echo $category[$key]['id']; ?>
                        <div class="form-check">
                            <div class="form-group d-inline-flex me-2">
                                <input type="checkbox" id="routelist_index_Left" class="checkItem"
                                       name="categories[]" value="<?php echo $category[$key]['id']; ?>"
                                    <?php echo(in_array($category[$key]['id'], $selected_category_ids) ? ' checked="checked" ' : ''); ?>>

                                <label class="w-100" for="<?php echo $category[$key]['id']; ?>">
                                    <?php echo $category[$key]['name']; ?>
                                </label>
                            </div>
                            <?php echo category_h_checkbox_html($category, $category[$key]['id'], '  ', $selected_category_ids); ?>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php
        endif;
    }
}
?>
