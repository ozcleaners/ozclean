<?php

namespace App\Helpers;

use App\Models\AttributeValue;
use App\Models\BookingOrderItem;
use App\Models\Media;

class FieldGenerator
{

    public static function radio($option = [])
    {
        $marr = self::option_handler($option);
        $val = $marr['value'];
        $service_slug = $marr['data-class'];
        $label = $marr['label'];
        $name = $marr['name'];
        $dataPoint = $marr['data-point'] ?? null;
        $dataClass = $marr['data-class'] ?? null;
        $inputAddi = $marr['additional-input-data'] ?? null;
        $mkLabel = str_replace(array( '\'', '"',
            ',' , ';', '<', '>', '?', ' ' ), '', $marr['labelTitle']);
        $html = null;
        $html .= '<div class="form-group mb-lg-1 mb-4">';
        $html .= '<div class="label-title fw-600">';
        $html .= '<img src="'. $marr['labelIcon'] .'" style="width: 45px; margin-right: 5px;" />';
        $html .= $marr['labelTitle'];
        $html .='<span class=" ml-2 text-dark error_'.$mkLabel.' badge badge-pill badge-warning"></span>';
        $html .= '</div><div style="margin-left: 45px">';
        foreach ($marr['dataArr'] as $key => $v) {
            $firstGap = $key == 0 ? ' style="margin-left: 0px;" ' : null;
            $html .= '<div class="form-check ' . $marr['class'] . '" '.$firstGap.'>';
            $html .= '<label class="containerRadio form-check-label fw-400 mb-1"  for="' . $v->$label . '">';
            //$rate = self::rateGen($v->equation_type, $v->rate);
            $getDbSave = BookingOrderItem::where('general_info_id', $marr['general_info_id'])
                ->where('service_slug', $name)
                ->where('service_title', $v->$label)
                ->first();
            $service_amount = $getDbSave->service_amount ?? null;
            if ($getDbSave) {
                $selected = 'checked data-selected = "yes"';
            } else {
                $selected = $v->intial_selected == 'Yes' ? 'checked data-selected = "yes"' : null;
            }
            $dataImage = Media::fullSize($v->service_icon) ?? $marr['labelIcon'];
            $html .= '<input
                        id="' . $v->$label . '"
                        data-service_id="' . $v->service_id . '"
                        data-rate="' . $v->rate . '"
                        data-rate_equ_type_numeric="' . $v->equation_type . '"
                        data-rate_equ_type_slug="' . AttributeValue::getColumnById($v->equation_type)->slug . '"
                        class="form-check-input select-radio mr-1"
                        data-point="' . $dataPoint . '" data-class="' . $v->$label . '"  name="' . $name . '" ' . $inputAddi . '
                        data-title="' . $v->$label . '"
                        data-image="'.$dataImage.'"
                        min="0" max="0"
                        data-extra_default="0"
                        data-service-amount="' . $service_amount . '"
                        data-calculate_with= "' . $v->calculate_with . '"
                        data-label= "' . $marr['labelTitle'] . '"
                        data-base_price="' . $v->rate . '"
                        data-equation_type="' . $v->equationType->slug . '"
                        ' . $selected . '
                        type="radio"
                        data-section_for = "'.str_replace(' ', '_', $mkLabel).'"
                        value="1"
                        xvalue="' . $v->$val . '" />';
            //$html .= $v;
            if (isset($v->service_icon)) {
                $icon = '<img src="' . Media::fullSize($v->service_icon) . '" style="width: 45px; margin-right: 5px;" />';
            } else {
                $icon = '';
            }
            $html .= '<span class="checkmark"></span>';
            $html .= $icon;
            $html .= $v->$label;
            $html .= '</label>';
            $html .= '</div>';
        }
        $html .= '</div></div>';
        return $html;
    }


    public static function select($option = [])
    {
        $marr = self::option_handler($option);
        $val = $marr['value'];
        $label = $marr['label'];
        $name = $marr['name'];

        $html = null;
        $html = '<div class="form-group">';
        $html .= '<label for="' . $marr['labelTitle'] . '">';
        $html .= $marr['labelTitle'];
        $html .= '</label>';
        $html .= '<select id="' . $marr['labelTitle'] . '" class="form-control">';
        foreach ($marr['dataArr'] as $v) {
            //$html .= '<option>' . $v->$label . '</option>';
        }
        $html .= '</select>';
        $html .= '</div>';

        return $html;
    }

    public static function text($option = [])
    {

        $marr = self::option_handler($option);
        $val = $marr['value'];
        $label = $marr['label'];
        $name = $marr['name'];

        $html = null;
        $html = '<div class="form-group">';
        $html .= '<label for="' . $marr['labelTitle'] . '">';
        $html .= $marr['labelTitle'];
        $html .= '</label>';
        $html .= '<input type="text" class="form-control" id="' . $marr['labelTitle'] . '" aria-describedby="emailHelp" placeholder="Enter ' . $marr['labelTitle'] . '...">';
        $html .= '</div>';
        return $html;

    }

    public static function plus_minus($option = [])
    {
        $marr = self::option_handler($option);
        $val = $marr['value'];
        $label = $marr['label'];
        $name = $marr['name'];
        $dataPoint = $marr['data-point'] ?? null;
        $dataClass = $marr['data-class'] ?? null;
        $inputAddi = $marr['additional-input-data'] ?? null;
        $html = null;
        $html = '<div class="form-group">';
//        $html .= '<div class="label-title fw-600">';
//        $html .= $marr['labelSubTitle'] ?? NULL;
//        $html .= '</div>';

        $html .= '<div class="plus_minus_wrap d-flex align-items-center input-wrap">';
        if (isset($marr['imageOn'])) {
            $icon = '<span class="plus_minus_img_wrap" style="display: inline-table; margin-right: 20px;"><img src="' . Media::fullSize($marr['imageOn']) . '" style="width: 45px" /></span>';
        } else {
            $icon = '';
        }
        $html .= $icon;
        if (isset($marr["notes"])) {
            $html .= '<div>' . $marr["notes"] ?? NULL . '</div>';
        }

        $html .= '';
        $html .=  '<div class="number-input">
                    <div class="stepDown">
                        <button type="button" data-class="' . $dataClass . '"  class="minus"></button>
                    </div>
                    <div class="labelWithInput">
                        <input readonly class="quantity plus_minus_quantity"
                                    aria-label="' . $marr['labelTitle'] . '"
                                    data-point="' . $dataPoint . '"
                                    data-class="' . $dataClass . '"
                                    data-image="'. Media::fullSize($marr['imageOn']) .'"
                                    name="' . $name . '" ' . $inputAddi . '
                                    type="text">
                        <label for="' . $marr['labelTitle'] . '">' . $marr['labelTitle'] . '</label>
                    </div>
                    <div class="stepUp">
                        <button type="button" data-class="' . $dataClass . '" class="plus"></button>
                    </div>
                </div>';
        $html .= '</div></div>';
        return $html;

    }

    public static function option_handler($option = [])
    {
        $default = [
            'dataArr' => '',
            'imageOn' => false,
            'value' => '',
            'label' => '',
            'name' => '',
            'class' => null, // stack
            'labelTitle' => null,
        ];

        $marr = array_merge($default, $option);
        return $marr;
    }


    public static function rateGen($et, $rate)
    {
        $basePrice = 100;
        if ($et == 22) {
            $percentage = $rate / $basePrice; // 0.1
            $actualRate = $basePrice * $percentage; // 10
            $returnTotal = $actualRate + $basePrice;
        } else {
            $returnTotal = $basePrice + $rate;
        }

        return $returnTotal;
    }
}
