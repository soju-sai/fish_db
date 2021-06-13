<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Media;
use App\MediaType;
use App\MediaOrigin;
use App\MediaTypeOrigin;

class HandleMediaData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fishdb:handle-media';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Handle all the data related works of fish media';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handleMedia()
    {
        // execution timer
        $startTime = microtime(true);

        // for test:
        // $mediaOrigins = MediaOrigin::where('gid' , 313)->get();
        MediaOrigin::chunk(200, function ($mediaOrigins) {
            foreach ($mediaOrigins as $mediaOrigin) {
                $depth = $mediaOrigin->depth;
                if (isset($depth)) {
                    $depth = str_replace('m', '', $depth);
                    $depth = str_replace('M', '', $depth);
                    $depth = str_replace('n', '', $depth);
                    $depth = str_replace('公分', '', $depth);
                    $depth = str_replace('~', '-', $depth);
                    $depth_array = explode('-', $depth);
                    $top_depth = $depth_array[0];
                    $bottom_depth = $depth_array[1] ?? NULL;

                    // incorrect data-content gid 9673, 9674
                    $incorrect_depth_gid = [9673, 9674];
                    if (in_array(($mediaOrigin->gid), $incorrect_depth_gid )) {
                        $top_depth = NULL;
                        $bottom_depth = NULL;
                    }
                } else {
                    $top_depth = NULL;
                    $bottom_depth = NULL;
                }

                $top_depth = ($top_depth == '') ? NULL : $top_depth;
                $bottom_depth = ($bottom_depth == '') ? NULL : $bottom_depth;

                $media = Media::create([
                    'id' => $mediaOrigin->gid,
                    'filename' => $mediaOrigin->filename,
                    'fish_species_id' => $mediaOrigin->id,
                    'media_type' => $mediaOrigin->mediatype,
                    'is_publish' => $mediaOrigin->is_publish,
                    'author' => $mediaOrigin->author,
                    'author_e' => $mediaOrigin->author_e,
                    'data_update_date' => $mediaOrigin->date,
                    'record_location' => $mediaOrigin->location,
                    'top_depth' => $top_depth,
                    'bottom_depth' => $bottom_depth,
                    'photo_condition' => $mediaOrigin->photo_condition,
                    'remark' => $mediaOrigin->remark,
                    'scientific_names' => $mediaOrigin->science,
                    'identifier' => $mediaOrigin->identifier,
                    'iden_date' => is_null($mediaOrigin->iden_date) ? NULL : date("Y-m-d", strtotime($mediaOrigin->iden_date))
                ]);
                $media->save();
            }
        });

        $endTime = microtime(true);
        $executionTime = ($endTime - $startTime);

        echo 'It takes ' . $executionTime . " seconds to execute the script\n";
        return 0;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handleMediaType()
    {
        // execution timer
        $startTime = microtime(true);

        MediaTypeOrigin::chunk(200, function ($mediaTypeOrigins) {
            foreach ($mediaTypeOrigins as $mediaTypeOrigin) {
                $type = $mediaTypeOrigin->type;
                $type_e = $mediaTypeOrigin->type_e;
                if ($mediaTypeOrigin->type_id == 4) {
                    $type = '精選圖';
                    $type_e = 'Featured photo';
                }

                $mediaType = MediaType::create([
                    'id' => $mediaTypeOrigin->type_id,
                    'type' => $type,
                    'type_e' => $type_e
                ]);
                $mediaType->save();
            }
        });

        $endTime = microtime(true);
        $executionTime = ($endTime - $startTime);

        echo 'It takes ' . $executionTime . " seconds to execute the script\n";
        return 0;
    }
}
