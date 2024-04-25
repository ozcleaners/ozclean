<?php

namespace App\Helpers;

class BookingForm
{
    public static function attributes()
    {

        $attributes = [
            'eolc' => [
                'name' => 'End of lease cleaning',
                'elements' => [
                    'furnish_type' =>
                        [
                            'label' => 'Furnish Type',
                            'type' => 'radio',
                            'datas' => self::common('furnish_type')
                        ],
                    'property_type' =>
                        [
                            'label' => 'Property Type',
                            'type' => 'radio',
                            'datas' => self::common('property_type')
                        ],
                    'storey_type' =>
                        [
                            'label' => 'Storey Type',
                            'type' => 'radio',
                            'datas' => self::common('storey_type')
                        ],
                    'cleaning_details' => [
                        'label' => 'Cleaning Details',
                        'type' => 'text',
                        'datas' => self::uncommon('eolc_cd')
                    ],
                    'extra_services' => [
                        'label' => 'Extra Services',
                        'type' => 'checkbox',
                        'datas' => self::uncommon('eolc_extra_services')
                    ],
                ]
            ],
            'brc' => [
                'name' => 'Builders/Renovation Cleaning',
                'furnish_type' => self::common('furnish_type'),
                'property_type' => self::common('property_type'),
            ],
            'rc' => [
                'name' => 'Regular Cleaning',
                'furnish_type' => self::common('furnish_type'),
                'property_type' => self::common('property_type'),
            ],
        ];

        return $attributes;
    }

    public static function getAttributeDataByKey($key, $value = NULL)
    {
        if (!empty($value)) {
            $attributes = self::attributes();
            return $attributes[$key][$value];
        } else {
            $attributes = self::attributes();
            return $attributes[$key];
        }
    }

    public static function common($name)
    {
        $common = [
            'furnish_type' => ['Furnished', 'Unfurnished'],
            'property_type' => ['Residential Property', 'Commercial Property', 'New Construction'],
            'storey_type' => ['Single Story', 'Double Story', 'Multistorey'],
        ];
        return $common[$name];
    }

    public static function uncommon($name)
    {
        $uncommon = [
            'eolc_cd' => [
                'No of Bedroom',
                'No of Bathroom',
                'No of Study Room',
                'No of Living Room',
                'No of Separate Toilet',
                'No of Balcony'
            ],
            'eolc_extra_services' => [
                'Exterior Window Cleaning (Ground floor only)',
                'Blinds Cleaning',
                'Fridge Cleaning',
                'Microwave Cleaning',
                'AC Vent Cleaning',
                'Garage Cleaning',
                'Carpet Steam Cleaning' => [
                    'Bedroom',
                    'Living Room',
                    'Dining Area',
                    'Study Room',
                    'Stairs',
                    'Hallway'
                ],
                'Walls Spot Cleaning' => [
                    'Good Condition',
                    'Average Condition',
                    'Bad Condition'
                ],
            ],
        ];
        return $uncommon[$name];
    }
}
