<?php

namespace App\Helpers;

use App\Models\Media;

class MediaManager
{
    private $buttonId;
    private $inputId;
    private $publicDir;
    private $scriptLoad;

    /**
     * @param $buttonId = Inser Media button ID
     * @param $inputId = pass input field id where put the selected media ID
     * @param array $options = pass array
     */
    public function __construct($buttonId, $inputId, $options = [])
    {
        $this->buttonId = $buttonId;
        $this->inputId = $inputId;
        $this->publicDir = asset('/public');

        $default = [
            'scriptLoad' => true,
        ];
        $arr = array_merge($default, $options);
        $this->scriptLoad = $arr['scriptLoad'];
        return $this->openModal();
//        dd($options);
    }

    /**
     * openModal() is Starting Point of This Class
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function openModal()
    {
        ob_start();
        ?>
        <!-- Modal -->
        <div class="modal fade" id="<?php echo $this->buttonId ?>MediaModal" data-bs-backdrop="static"
             data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog  modal-dialog-scrollable modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Media Manager</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <?php
                        echo view('components.dropzone')->with(['mediaArr' => [
                            "scriptLoad" => true,
                            'paginate' => false,
                            'unique_class' => $this->buttonId . 'dzone',
                        ]]);
                        //echo $this->showMedia();
                        ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="button" id="insertedToInput" data-input-id="<?php echo $this->inputId ?>"
                                class="btn btn-primary">
                            Insert
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <?php
        //Load DropJone JS & CSS
        echo $this->scripts();

        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }

    /**
     * @return  all Uploaded Media
     */

    public function showMedia()
    {
        ob_start();
        $medias = Media::with('user')->orderBy('id', 'DESC')->paginate('21');
        ?>
        <h6>
            <div class="title mt-2">
                <div class="d-inline-block float-end valign-text-bottom me-2">
                    <form method="GET" action="<?php echo url('admin/medias'); ?>" accept-charset="UTF-8" value="PATCH"
                          id="" autocomplete="off" enctype="multipart/form-data">
                        <div class="input-group input-group-sm media_manager_search" style="width: 150px;">
                            <input type="text" name="q" class="form-control pull-right mb-0"
                                   placeholder="Search" value="<?php echo request()->get('s'); ?>">
                            <button type="submit" class="btn btn-sm p-0 position-absolute end-0">
                                <span class="icon-search"></span>
                            </button>
                        </div>
                    </form>
                </div>
                Medias
            </div>
        </h6>
        <br>
        <div id="media_manager_reload_me">
            <div class="card">
                <div class="card-body" style="padding: 0.5rem 1rem;">
                    <div class="row">
                        <?php foreach ($medias as $media) : ?>
                            <div class="imgx" style="width: 120px;">
                                <a class="mediaManagerCheckedMedia" href=""
                                   data-link="<?php echo url($media->icon_size_directory); ?>"
                                   data-id="<?php echo $media->id; ?>">
                                    <img class="img-fluid"
                                         style="width: 120px; min-height: 120px; max-height: 120px; object-fit: contain;"
                                         src="<?php echo url($media->icon_size_directory); ?>"/>
                                </a>
                                <div class="desc p-0">
                                    <?php //echo $media->filename; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="row">
                        <?php //echo $medias->links('components.paginator', ['object' => $medias]);
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <?php
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }

    /**
     * @return Load Dropzone included All CSS and JS
     *
     *         <?php if ($this->scriptLoad == true) { ?>
     * <div class="djs">
     * <script src="<?php echo $this->publicDir; ?>/dropzone/dropzone-min.js"></script>
     * <script src="<?php echo $this->publicDir; ?>/dropzone/dropzone-config.js"></script>
     * <link rel="stylesheet" href="<?php echo $this->publicDir; ?>/dropzone/dropzone.css">
     * </div>
     * <?php } ?>
     *
     */
    public function scripts()
    {
        ob_start();
        ?>
        <script>
            jQuery(document).ready(function ($) {
                $.noConflict();
                let modalOpenButton = '#<?php echo $this->buttonId;?>';
                let modalId = $(modalOpenButton + 'MediaModal');
                //console.log(modalOpenButton)
                // Modal Open when Click on Insert Media Button click
                $(modalOpenButton).click(function (e) {
                    e.preventDefault();
                    // show Modal
                    $(modalId).modal('show');
                });

                let selectMedia = $('a.mediaManagerCheckedMedia');
                let inputId = '#<?php echo $this->inputId ?>';


                // Hide Modal and Image id insert image id on Input box When insert Image Click
                $(selectMedia).click(function (e) {
                    e.preventDefault();
                    let id = $(this).data('id');
                    let imgLink = $(this).data('link');
                    $(selectMedia).attr('style', 'border: 0px')
                    $('a.mediaManagerCheckedMedia[data-id="' + id + '"]').attr('style', 'border: 3px solid #0d6efd');
                    let buutonId = 'button#insertedToInput[data-input-id=<?php echo $this->inputId ?>]';

                    $(buutonId).on('click', function (e) {
                        e.preventDefault();
                        $(inputId).val(id);
                        //console.log(inputId)
                        $('img' + modalOpenButton).attr('src', imgLink);
                        $(modalId).modal('hide');
                    })


                })
            });
        </script>
        <?php
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }
}
