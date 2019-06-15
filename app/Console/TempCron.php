<?php

namespace App\Console;

use App\Http\Models\Temp;
use Storage;

class TempCron
{
    /** 删除超过存在时间的数据
     * @param int $min
     * @return mixed
     */
    public function deleteTemp($min = 5)
    {
        $q = Temp::where('created_at', '<', now()->subMinutes($min));
        $paths = $q->select('path')->get();

        //删除文件
        foreach ($paths as $path) {
            if (!empty($path->path)) {
                Storage::deleteDirectory(pathinfo($path->path, PATHINFO_FILENAME));
                Storage::disk('public')->delete($path->path);
            }
        }
        return $q->delete();
    }
}