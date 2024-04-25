<?php

namespace App\Imports;

use App\Models\AttributeValue;
use App\Models\Postcode;
use App\Models\PostcodeRate;
use http\Env\Request;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PostCodeImport implements ToCollection, WithHeadingRow
{

    private $zone_id;
    private $service_id;

    public function __construct($request)
    {
        //dd($request->all());
        $this->zone_id = $request->zone_id;
        $this->service_id = $request->service_id;
    }

    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {

        foreach ($collection as $c) {
            //dump($c['postcode']);
            $equationType = AttributeValue::where('unique_name', 'Equation Type')->where('slug', $c['equation_type'])->first();
            $getEquType = $equationType->id ?? null;
            $postcodeToMatch = Postcode::where('postcode', $c['postcode'])->where('zone_id', $this->zone_id)->first();
            //dump($postcodeToMatch);

            if ($postcodeToMatch == null) {
                $insertPostCode = Postcode::create(['zone_id' => $this->zone_id, 'postcode' => $c['postcode']]);
                //dump($insertPostCode);
                $postcode_id = $insertPostCode->id;
                $postcode = $insertPostCode->postcode;
            } else {
                $postcode_id = $postcodeToMatch->id;
                $postcode = $c['postcode'];
            }
            //check postcode rate in postcode_rate table
            $checkPostCodeRate = PostcodeRate::where('zone_id', $this->zone_id)->where('service_id', $this->service_id)
                ->where('postcode_id', $postcode_id)->first();

            if ($checkPostCodeRate) {
                PostcodeRate::where('id', $checkPostCodeRate->id)->delete();
            }
            if ($getEquType) {
                $makeData = [
                    'zone_id' => $this->zone_id,
                    'service_id' => $this->service_id,
                    'postcode_id' => $postcode_id,
                    'postcode' => $postcode,
                    'rate' => $c['rate'],
                    'equation_type' => $getEquType,
                ];
                PostcodeRate::create($makeData);
            }
        }

        //die();
    }
}
