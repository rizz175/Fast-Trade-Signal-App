<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait Transformer
{

    public static function transformCollection($collection)
    {
        $params = http_build_query(request()->except('page'));
        $next = $collection->nextPageUrl();
        $previous = $collection->previousPageUrl();
        if ($params) {
            if ($next) {
                $next .= "&{$params}";
            }
            if ($previous) {
                $previous .= "&{$params}";
            }
        }
        $meta = [
            "next" => (string)$next,
            "previous" => (string)$previous,
            "per_page" => (integer)$collection->perPage(),
            "total" => (integer)$collection->total()
        ];
        return $meta;
    }

    // auth user login response body
    public static function transformUser($user, $token = '', $is_auth = false)
    {
        // $avatar = getAvatar($user);
        
        $transformed_user = [
            'id' => (int)$user->id,
            'name' => (string)$user->name,
            'email' => (string)$user->email,
        ];

        if ($token) {
            $transformed_user['token'] = (string)$token;
        }
        
        return $transformed_user;
    }

    public static function transformTranslations($translations)
    {
        return $translations->map(function ($translation) {
            return array(
                $translation->key => array(
                    'eng' => $translation->eng,
                    'arb' => $translation->arb,
                ),
            );
        });
    }

    public static function images($images)
    {
        $data = [];
        foreach ($images as $image) {
            $link = Storage::exists($image->link) ? Storage::url($image->link) : url('/img/no_image.png');
            if ($image->related_id) {
                $data[$image->related_id]['thumbnail'] = $link;
            } else {
                $data[$image->id]['image'] = $link;
            }
        }
        return array_values($data);
    }

}
