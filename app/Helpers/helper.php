<?php

if (!function_exists('api_model_set_paginate')) {

    function api_model_set_paginate($model)
    {
        return [
            'total'         => $model->total(),
            'count'         => $model->count(),
            'perPage'       => $model->perPage(),
            'currentPage'   => $model->currentPage(),
            'lastPage'      => $model->lastPage(),
            'hasMorePages'  => $model->hasMorePages(),
        ];
    }
}
