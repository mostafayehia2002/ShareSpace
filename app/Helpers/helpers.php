<?php

if (!function_exists('isApiRequest')) {
    function isApiRequest($request):bool
    {
        if($request->is("api/*")){

            return true;
        }
        return  false;

    }
}

if (!function_exists('formatErrors')){
    
    function formatErrors(array $errors): array
    {
        $formattedErrors = [];
        foreach ($errors as $field => $messages) {
            $formattedErrors[] = [
                'field' => $field,
                'messages' => $messages,
            ];
        }
        return $formattedErrors;
    }
}
