<?php

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


function getAvatar($user)
{
    if (!empty($user->is_social_login)) {
        $avatar = $user->avatar;
    } else {
        $avatar = empty($user->avatar) ? '' : Storage::disk('local')->url($user->avatar);
    }
    return empty($avatar) ? config('app.url') . Storage::disk('local')->url('profile/no-image.png') : config('app.url') . ($avatar);
}


/**
 * @param $file
 * @param $directory
 * @param $width
 * @return string
 * save resize image in storage
 */
function saveResizeImage($file, $directory, $width)
{
    // dd(Storage::disk('public')->exists($directory));
    if (!Storage::disk('public')->exists($directory)) {
        Storage::disk('public')->makeDirectory("$directory");
    }
    $filename = Str::random() . time() . '.' . $file->getClientOriginalExtension();
    $path = "$directory/$filename";
    \Image::make($file)->resize($width, null, function ($constraint) {
        $constraint->aspectRatio();
        $constraint->upsize();
    })->save("storage/$path");
    return $path;
}

/**
 * @param $file
 * @param $directory
 * @param $width
 * @return string
 * save resize image in storage
 */
 
function saveCategoryIcon($file, $directory,$filename)
{
    // dd(Storage::disk('public')->exists($directory));
    if (!Storage::disk('public/assets/')->exists($directory)) {
        Storage::disk('public/assets/')->makeDirectory("$directory");
    }
    // $filename = Str::random() . time() . '.' . $file->getClientOriginalExtension();
    Storage::disk('public/assets/')->put($filename.'.'.$file->getClientOriginalExtension(),$file);
    // $path = "$directory/$filename";
    // \Image::make($file)->resize($width, null, function ($constraint) {
    //     $constraint->aspectRatio();
    //     $constraint->upsize();
    // })->save("storage/$path");
    return "$directory/$filename".'.'.$file->getClientOriginalExtension();
    
}


/**
 * @param $file
 * @param $directory
 * @param $width
 * @return string
 * save resize image in storage
 */
function saveFile($file, $directory,$filename)
{
    // dd(Storage::disk('public')->exists($directory));
    if (!Storage::disk('public')->exists($directory)) {
        Storage::disk('public')->makeDirectory("$directory");
    }
    Storage::disk('public')->put($filename.'.'.$file->getClientOriginalExtension(),$file);
    // $filename = Str::random() . time() . '.' . $file->getClientOriginalExtension();
    // $path = "$directory/$filename";
    return "$directory/$filename".'.'.$file->getClientOriginalExtension();
    
}

/**
 * @param $file
 * delete a file
 */
function deleteFile($file)
{
    if (!empty($file)) {
        $host = str_replace('www.', '', request()->getHttpHost());
        $scheme = request()->getScheme();
        $needles = [
            "{$scheme}://www.{$host}",
            "{$scheme}://{$host}"
        ];
        $file = str_replace($needles, '', $file);
        if ((file_exists(public_path($file)) || Storage::exists($file))) {
            file_exists(public_path($file)) ? unlink(public_path($file)) : Storage::delete($file);
        }
    }
}

