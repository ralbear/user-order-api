<?php

namespace App\Facades;

use App\Http\Resources\v4l\ErrorsResource;

class ReturnErrorFacade
{
    public function validationError($exception)
    {
        $errorBodyCollection = collect([]);

        foreach($exception->validator->errors()->messages() as $errorKey => $errorValue) {
            $errorBody = new \stdClass();
            $errorBody->error = 'invalidRequest';
            $errorBody->message = $errorValue[0];
            $errorBody->hint = "Check the $errorKey parameter";
            $errorBodyCollection->push(collect($errorBody));
        }

        return response()
                ->json([
                    'errors' => $errorBodyCollection
                ],422);
    }
}