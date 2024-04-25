<?php

namespace App\Http\Traits;


trait GlobalTrait{

    protected $ButtonSet = '\App\Helpers\ButtonSet';
    protected $Query = '\App\Helpers\Query';
    protected $Datatable = '\App\Helpers\Datatable';

    public function Model($modelName){
        $modelPath = '\App\Models' . '\\' . $modelName;
        return $modelPath;
    }
}



?>
