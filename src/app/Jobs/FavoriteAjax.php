<?php

namespace App\Jobs;

use App\Models\Favorite;
use App\Libs\FavoriteParam;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class FavoriteAjax implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $jobParam;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(FavoriteParam $jobParam)
    {
        $this->jobParam = $jobParam;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $user_id = $this->jobParam->user_param;
        $shop_id = $this->jobParam->shop_param;

        if(Favorite::where('user_id',$user_id)->where('shop_id',$shop_id)->doesntExist()){
            Favorite::create([
                'user_id' => $user_id,
                'shop_id' => $shop_id
            ]);

            Log::info("登録");
        }else{
            Favorite::where('user_id', $user_id)->where('shop_id', $shop_id)->delete();
            Log::info("削除");
        }

        Log::info("完了");
    }
}