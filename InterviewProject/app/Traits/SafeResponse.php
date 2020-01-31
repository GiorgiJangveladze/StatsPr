<?php

namespace App\Traits;

trait SafeResponse
{
    /**
     * Try Catch of CallBackFunction
     * @param $callbackFunction
     * @param $messages
     * @return array
     */
    private function safeResponse($callbackFunction, $messages)
    {
        try {
            call_user_func($callbackFunction);
            $safeResponse = [
                'success',
                $messages['success'] ?? "Everything is OK!"
            ];

        } catch (\Throwable $e) {
            //We can use for wraiting code in Error database or somewhere
            $safeResponse = [
                "error",
                $messages['error'] ?? "Something went's wrong"
            ];
        }
        return $safeResponse;
    }
}
