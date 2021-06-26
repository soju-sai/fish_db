<?php

namespace App\Http\Controllers;

use App\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MediasController extends Controller
{
    public function exportCsv(Request $request)
    {
        // execution timer
        $startTime = microtime(true);

        $fileName = 'media.csv';

        // $mediasColumn = Media::select('id')->limit(20)->get();
        $mediasColumn = Media::select('id', 'filename', 'fish_species_id', 'is_publish', 'author', 'author_e', 'data_update_date', 'record_location', 'top_depth', 'bottom_depth', 'photo_condition', 'remark', 'scientific_names', 'identifier', 'iden_date')->get();

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename= $fileName"
        );

        $file = fopen('php://output', 'w');

        $csvColumns = array('gid', 'filename', 'id', 'mediatype_c', 'is_publish', 'author', 'author_e', 'date', 'location', 'depth', 'photo_condition', 'remark', 'science', 'identifier', 'iden_date');
        fputcsv($file, $csvColumns);

        try {
            $callback = function() use($mediasColumn, $file, $startTime) {
                foreach ($mediasColumn as $key => $value) {
                    $id = $value['id'];
                    $media_type = '';

                    $row = [];
                    $row[] = $id;
                    $row[] = $value['filename'];
                    $row[] = $value['fish_species_id'];

                    // ------- start mediatype_c -------
                    $media_type = '';
                    $mediaTypeModel = Media::find($id)->media_type;

                    if ($mediaTypeModel) {
                        $media_type = $mediaTypeModel->type;
                    }
                    $row[] = $media_type;
                    // ------- end -------

                    $is_publish = ($value['is_publish'] == '1' && !(strpos($value['author'], '©') !== false) ) ? '已公布' : '不公布';
                    $row[] = $is_publish;
                    $row[] = str_replace('©', '', $value['author']);
                    $row[] = str_replace('©', '', $value['author_e']);
                    $row[] = $value['data_update_date'];
                    $row[] = $value['record_location'];
                    $bottom_depth = is_null($value['bottom_depth']) ? '' : ' - ' . $value['bottom_depth'];
                    $row[] =  is_null($value['top_depth']) ? '' : $value['top_depth'] . $bottom_depth;
                    $row[] = $value['photo_condition'];
                    $row[] = $value['remark'];
                    $row[] = $value['scientific_names'];
                    $row[] = str_replace('&', '|', $value['identifier']);
                    $row[] = $value['iden_date'];

                    fputcsv($file, $row);
                }

                fclose($file);

                $endTime = microtime(true);
                $executionTime = ($endTime - $startTime);

                Log::Debug('It takes ' . $executionTime . " seconds to execute the script\n");
            };
        } catch (\Throwable $th) {
            Log::error($th);
            //throw $th;
        }

        return response()->streamDownload($callback, $fileName, $headers);
    }
}
