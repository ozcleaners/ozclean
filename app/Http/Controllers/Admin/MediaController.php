<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Media;
use App\Http\Traits\ImageUpload;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class MediaController extends Controller
{
    use ImageUpload;

    //trait
    private $media;

    public function __construct(Media $media)
    {
        $this->media = $media;
    }

    public function index()
    {
        $media = $this->media::with('user')->orderBy('id', 'DESC')->paginate('44');

        return view('admin.common.media.medias')
            ->with('medias', $media);
    }

    public function detail($id)
    {
        $detail = Media::find($id);
        return view('admin.common.media.media_detail')->with('media', $detail);
    }

    public function store(Request $request)
    {
        $medias = $request->all();
        $response = $this->upload($medias); //Upload method define in ImageUpload Trait

        return $response;
    }

    public function edit($id)
    {

    }

    public function destroy($id)
    {
        $data = Media::find($id);
        $data->delete();
        return redirect()->route('common_media_index')->with(['status' => 0, 'message' => 'Successfully deleted']);
    }

    public function search($key)
    {
        $result = $this->media->orWhere('original_name', 'like', '%' . $key . '%')
            ->orWhere('filename', 'like', '%' . $key . '%')
            ->orWhere('full_size_directory', 'like', '%' . $key . '%')
            ->get();

        $html = NULL;
        if (count($result) > 0) {
            $html .= '<ul class="wp-like">';
            foreach ($result as $k => $v) {
                $html .= '<li class="attachment">';
                $isLandscape = $this->media->isLandsape($v->icon_size_directory);

                if ($isLandscape == true) {
                    $size = 'landscape';
                } else {
                    $size = 'portrait';
                }
                $html .= '<a href="' . route("common_media_detail", $v->id) . '" class="mediaManagerCheckedMedia" data-link="' . url(url($v->icon_size_directory)) . '" data-id="' . $v->id . '">';
                $html .= '<div class="attachment-preview ' . $size . '">';
                $html .= '<div class="thumbnail"><div class="centered">';
                $html .= '<img src="' . url($v->icon_size_directory) . '"/>';
                $html .= '</div></div></div>';
                $html .= '</a>';
                $html .= '</li>';
            }
            $html .= '</ul>';
        } else {
            $html .= 'No image found on the keyword: <strong>' . $key . '</strong>';
        }
        //dd($html);

        return response()->json(['html' => $html]);
    }

    public function fileManage(){
        return view ('admin.common.media.file');
    }

    public function fileStore(Request $request){

        $medias = $request->all();
        $validator = Validator::make($medias, [
            'file' => 'required|max:8192',
        ]);


        if ($validator->fails()) {

            return Response::json([
                'error' => true,
                'message' => $validator->messages()->first(),
                'code' => 400
            ], 400);

        } else {

            if ($file = $request->file('file')) {
                $name = str_replace(' ','-', $file->getClientOriginalName());
                $image = pathinfo($name, PATHINFO_FILENAME).'-'.time().'.'.$file->getClientOriginalExtension();

                $attr = [
                    'filename' => $image,
                    'original_name' => $image,
                    'file_type' => $file->getMimeType(),
                    'file_size' => $file->getSize(),
                    'file_extension' => $file->getClientOriginalExtension(),
                    'full_size_directory' => 'public/uploads/files/'.$image,
                    'icon_size_directory' => 'public/uploads/files/'.$image,
                    'status' => 1,
                    'user_id' => auth()->user()->id,
                ];

                Media::create($attr);
                $imagepath = $file->move('public/uploads/files', $image);
//                $filelocation = url('/public/uploads/file/').'/'.$image;
//                return array('ok', $filelocation);
                return redirect()->back()->with([
                    'status' => 1,
                    'message' => 'Media Uploaded Succeefully',
                ]);

            } else {
                return redirect()->back()->with([
                    'status' => 0,
                    'message' => 'Something error. Please try again',
                ]);
            }
        }
    }

    public function fileDestroy($id){
        $d = Media::find($id);
        unlink(public_path('/uploads/files/'.$d->filename));
        $d->delete();
        return redirect()->back()->with([
            'status' => 0,
            'message' => 'Media Deleted Succeefully',
        ]);
    }
}
