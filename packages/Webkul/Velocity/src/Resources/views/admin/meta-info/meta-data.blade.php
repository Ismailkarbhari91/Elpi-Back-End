@extends('admin::layouts.content')

@section('page_title')
   
    {{ __('Elpi Data') }}
@stop

@php
    $locale = core()->checkRequestedLocaleCodeInRequestedChannel();

    $channel = core()->getRequestedChannelCode();

    $channelLocales = core()->getAllLocalesByRequestedChannel()['locales'];

    $metaRoute = $metaData
        ? route('velocity.admin.store.meta-data', ['id' => $metaData->id])
        : route('velocity.admin.store.meta-data', ['id' => 'new']);
@endphp

@push('css')
    <style>
        @media only screen and (max-width: 680px){
            .content-container .content .page-header .page-title {
                float: left;
                width: 100%;
                margin-bottom: 12px;
            }

            .content-container .content .page-header .page-action button {
                position: absolute;
                right: 2px;
                top: 10px !important;
            }

            .content-container .content .page-header .control-group {
                margin-top:16px !important;
                width: 100% !important;
                margin-left: 0px !important;
            }
        }

        .img-thumbnail {
        padding: 0px !important;
        background-color: #fff;
        border: 1px solid #dee2e6;
        border-radius: 0.25rem;
        max-width: 200px !important;
        height: 200px !important;
}

img.img-fluid.img-thumbnail {
    height: 130px !important;
    width: 150px;
}

td.customer_name {
    width: 15% !important;
}

th.th_action {
    width: 7%;
}

.bg-danger {
    background-color: black !important;
}

select#locale {
    height: 30px !important;
    width: 100% !important;
}

select#locales {
    height: 30px !important;
    width: 100% !important;
}
    </style>
    <!-- -->
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/css/bootstrap.min.css' />
  <link rel='stylesheet'
    href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css' />
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.10.25/datatables.min.css" />
    <!--  -->
@endpush

@section('content')
    <div class="content">
        <form
            method="POST"
            enctype="multipart/form-data"
            action="{{ $metaRoute }}"
            @submit.prevent="onSubmit"
            >
            @csrf

            <div class="page-header">
                <div class="page-title">
                    <h1>{{ __('velocity::app.admin.meta-data.title') }}</h1>
                </div>

                <input type="hidden" name="locale" value="{{ $locale }}" />

                <input type="hidden" name="channel" value="{{ $channel }}" />

                <div class="control-group">
                    <select class="control" id="channel-switcher" name="channel">
                        @foreach (core()->getAllChannels() as $channelModel)

                            <option
                                value="{{ $channelModel->code }}" {{ ($channelModel->code) == $channel ? 'selected' : '' }}>
                                {{ core()->getChannelName($channelModel) }}
                            </option>

                        @endforeach
                    </select>
                </div>

                <div class="control-group">
                    <select class="control" id="locale-switcher" name="locale">
                        @foreach ($channelLocales as $localeModel)

                            <option
                                value="{{ $localeModel->code }}" {{ ($localeModel->code) == $locale ? 'selected' : '' }}>
                                {{ $localeModel->name }}
                            </option>

                        @endforeach
                    </select>
                </div>

                <div class="page-action">
                    <button type="submit" class="btn btn-lg btn-primary">
                        {{ __('velocity::app.admin.meta-data.update-meta-data') }}
                    </button>
                </div>
            </div>

            <accordian :title="'{{ __('velocity::app.admin.meta-data.general') }}'" :active="true">
                <div slot="body">
                    <div class="control-group">
                        <label style="width:100%;">
                            {{ __('velocity::app.admin.meta-data.activate-slider') }}
                            <span class="locale">[{{ $channel }} - {{ $locale }}]</span>
                        </label>

                        <label class="switch">
                            <input
                                id="slides"
                                name="slides"
                                type="checkbox"
                                class="control"
                                data-vv-as="&quot;slides&quot;"
                                {{ $metaData && $metaData->slider ? 'checked' : ''}} />

                            <span class="slider round"></span>
                        </label>
                    </div>

                    <!-- slider position -->
                    <!-- <div class="control-group">
                        <label>{{ 'Slider Position' }}</label>  
                        <input
                                id="slider-position"
                                name="slider_position"
                                type="text"
                                class="control"
                                value="{{$metaData->slider_position}}">                      
                    </div> -->
                    <!-- end slider position -->
                    <div class="control-group">
                        <label style="width:100%;">
                            {{ __('velocity::app.admin.meta-data.sidebar-categories') }}
                            <span class="locale">[{{ $channel }} - {{ $locale }}]</span>
                        </label>

                        <input
                            type="number"
                            min="0"
                            class="control"
                            id="sidebar_category_count"
                            name="sidebar_category_count"
                            value="{{ $metaData ? $metaData->sidebar_category_count : '10' }}" />
                    </div>

                    <div class="control-group">
                        <label style="width:100%;">
                            {{ __('velocity::app.admin.meta-data.header_content_count') }}
                            <span class="locale">[{{ $channel }} - {{ $locale }}]</span>
                        </label>

                        <input
                            type="number"
                            min="0"
                            class="control"
                            id="header_content_count"
                            name="header_content_count"
                            value="{{ $metaData ? $metaData->header_content_count : '5' }}" />
                    </div>

                    <div class="control-group">
                        <label style="width:100%;">
                            {{ __('velocity::app.admin.meta-data.home-page-content') }}
                            <span class="locale">[{{ $channel }} - {{ $locale }}]</span>
                        </label>

                        <textarea
                            class="control"
                            id="home_page_content"
                            name="home_page_content">
                            {{ $metaData ? $metaData->home_page_content : '' }}
                        </textarea>
                    </div>

                    <div class="control-group">
                        <label style="width:100%;">
                            {{ __('velocity::app.admin.meta-data.product-policy') }}
                            <span class="locale">[{{ $channel }} - {{ $locale }}]</span>
                        </label>

                        <textarea
                            class="control"
                            id="product-policy"
                            name="product_policy">
                            {{ $metaData ? $metaData->product_policy : '' }}
                        </textarea>
                    </div>

                </div>
            </accordian>

            <!-- about-us en -->
            <accordian :title="'About-Us-en'" :active="false">
                <div slot="body">
                    <div class="control-group">
                        <label>{{ 'About-Us Heading' }}</label>  
                        <input
                                id="about-heading"
                                name="about_heading"
                                type="text"
                                class="control"
                                value="{{$metaData->about_heading}}">                      
                    </div>
                    <div class="control-group">
                        <label>{{ 'About-Us Sub-Heading' }}</label>  
                        <input
                                id="about-sub-heading"
                                name="about_sub_heading"
                                type="text"
                                class="control"
                                value="{{$metaData->about_sub_heading}}">                      
                    </div>
                    <div class="control-group">
                        <label>{{ 'About-Us Paragraph' }}</label>  
                        <textarea
                            class="control"
                            id="about-para"
                            name="about_para">
                            {{ $metaData ? $metaData->about_para : '' }}
                        </textarea>                     
                    </div>

                    <div class="control-group">
                        <label>{{ 'About-Us Button-Text' }}</label>  
                        <input
                                id="button_text"
                                name="button_text"
                                type="text"
                                class="control"
                                value="{{$metaData->button_text}}">                     
                    </div>
                 <!--  -->
                 <div class="control-group">
                        <label>{{ 'Map Image' }}</label>
                        <input type="file" name="map[]" class="form-control" multiple="multiple">

                        <div class="mt-2" id="avatar">
                        <img src="http://151.80.237.29/public/storage/public/images/{{ $metaData->image_url }}" width="100" class="img-fluid img-thumbnail">
                </div>

                </div>
                    <!-- <div class="control-group">
                        <label>{{ 'About-Us Postion' }}</label>  
                        <input
                                id="aboutus_position"
                                name="aboutus_position"
                                type="text"
                                class="control"
                                value="{{$metaData->aboutus_position}}">                     
                    </div> -->
                 <!--  -->
                </div>
            </accordian>
            <!-- end-about-us -->

            <!-- about-us fr -->
            <accordian :title="'About-Us fr'" :active="false">
                <div slot="body">
                    <div class="control-group">
                        <label>{{ 'About-Us Heading' }}</label>  
                        <input
                                id="about-heading-fr"
                                name="about_heading_fr"
                                type="text"
                                class="control"
                                value="{{$metaData->about_heading_fr}}">                      
                    </div>
                    <div class="control-group">
                        <label>{{ 'About-Us Sub-Heading' }}</label>  
                        <input
                                id="about-sub-heading-fr"
                                name="about_sub_heading_fr"
                                type="text"
                                class="control"
                                value="{{$metaData->about_sub_heading_fr}}">                      
                    </div>
                    <div class="control-group">
                        <label>{{ 'About-Us Paragraph' }}</label>  
                        <textarea
                            class="control"
                            id="about-para-fr"
                            name="about_para_fr">
                            {{ $metaData ? $metaData->about_para_fr : '' }}
                        </textarea>                     
                    </div>

                    <div class="control-group">
                        <label>{{ 'About-Us Button-Text' }}</label>  
                        <input
                                id="button_text-fr"
                                name="button_text_fr"
                                type="text"
                                class="control"
                                value="{{$metaData->button_text_fr}}">                     
                    </div>
                </div>
             
                </div>
            </accordian>
            <!-- end-about-us-fr -->



             <!--  -->
             <!-- <accordian :title="'Home Page Content Position'" :active="false">
                <div slot="body">
                    
                    @foreach ($datas as $d)
                    <div class="control-group">
                        <label style="width:100%;">
                            {{ $d }}
                        </label>

                        <select class="control" id="product_collection" name=" {{ $d }}">
                                    <option value="1" {{ $metaData->$d ? '' : 'selected' }}>
                                        {{ 'Yes' }}</option>
                                    <option value="0" {{ $metaData->$d ? '' : 'selected' }} >
                                        {{ 'No' }}</option>
                                </select>
                                </div>
                                <div class="control-group">
                        <label>{{ $d.' Position' }}</label>  
                        <input
                                id="{{ $d.'_position' }}"
                                name="{{ $d.'_position' }}"
                                type="text"
                                class="control"
                                value="{{$metaData[$d.'_position']}}">                      
                    </div>
                    @endforeach
        
                </div>
            </accordian> -->
            <!--  -->
            <!-- <accordian :title="'{{ __('velocity::app.admin.meta-data.images') }}'" :active="false">
                <div slot="body">
                    <div class="control-group">
                        <label>{{ __('velocity::app.admin.meta-data.advertisement-four') }}</label>

                        @php
                            $images = [
                                4 => [],
                                3 => [],
                                2 => [],
                            ];

                            $index = 0;

                            foreach ($metaData->get('locale')->all() as $key => $value) {
                                if ($value->locale == $locale) {
                                    $index = $key;
                                }
                            }

                            $advertisement = json_decode($metaData->get('advertisement')->all()[$index]->advertisement, true);
                        @endphp

                        @if(! isset($advertisement[4]) || ! count($advertisement[4]))
                            @php
                                $images[4][] = [
                                    'id' => 'image_1',
                                    'url' => asset('/themes/velocity/assets/images/big-sale-banner.webp'),
                                ];
                                $images[4][] = [
                                    'id' => 'image_2',
                                    'url' => asset('/themes/velocity/assets/images/seasons.webp'),
                                ];
                                $images[4][] = [
                                    'id' => 'image_3',
                                    'url' => asset('/themes/velocity/assets/images/deals.webp'),
                                ];
                                $images[4][] = [
                                    'id' => 'image_4',
                                    'url' => asset('/themes/velocity/assets/images/kids.webp'),
                                ];
                            @endphp

                            <image-wrapper
                                :multiple="true"
                                input-name="images[4]"
                                :images='@json($images[4])'
                                :button-label="'{{ __('velocity::app.admin.meta-data.add-image-btn-title') }}'">
                            </image-wrapper>
                        @else
                            @foreach ($advertisement[4] as $index => $image)
                                @php
                                    $images[4][] = [
                                        'id' => 'image_' . $index,
                                        'url' => Storage::url($image),
                                    ];
                                @endphp
                            @endforeach

                            <image-wrapper
                                :multiple="true"
                                input-name="images[4]"
                                :images='@json($images[4])'
                                :button-label="'{{ __('velocity::app.admin.meta-data.add-image-btn-title') }}'">
                            </image-wrapper>
                        @endif

                        <span class="control-info mt-10">{{ __('velocity::app.admin.meta-data.image-four-resolution') }}</span>
                    </div>

                    <div class="control-group">
                        <label>{{ __('velocity::app.admin.meta-data.advertisement-three') }}</label>
                        @if(! isset($advertisement[3]) || ! count($advertisement[3]))
                            @php
                                $images[3][] = [
                                    'id' => 'image_1',
                                    'url' => asset('/themes/velocity/assets/images/headphones.webp'),
                                ];
                                $images[3][] = [
                                    'id' => 'image_2',
                                    'url' => asset('/themes/velocity/assets/images/watch.webp'),
                                ];
                                $images[3][] = [
                                    'id' => 'image_3',
                                    'url' => asset('/themes/velocity/assets/images/kids-2.webp'),
                                ];
                            @endphp

                            <image-wrapper
                                input-name="images[3]"
                                :images='@json($images[3])'
                                :button-label="'{{ __('velocity::app.admin.meta-data.add-image-btn-title') }}'">
                            </image-wrapper>
                        @else
                            @foreach ($advertisement[3] as $index => $image)
                                @php
                                    $images[3][] = [
                                        'id' => 'image_' . $index,
                                        'url' => Storage::url($image),
                                    ];
                                @endphp
                            @endforeach

                            <image-wrapper
                                input-name="images[3]"
                                :images='@json($images[3])'
                                :button-label="'{{ __('velocity::app.admin.meta-data.add-image-btn-title') }}'">
                            </image-wrapper>
                        @endif
                        <span class="control-info mt-10">{{ __('velocity::app.admin.meta-data.image-three-resolution') }}</span>
                    </div>

                    <div class="control-group">
                        <label>{{ __('velocity::app.admin.meta-data.advertisement-two') }}</label>

                        @if(! isset($advertisement[2]) || ! count($advertisement[2]))
                            @php
                                $images[2][] = [
                                    'id' => 'image_1',
                                    'url' => asset('/themes/velocity/assets/images/toster.webp'),
                                ];
                                $images[2][] = [
                                    'id' => 'image_2',
                                    'url' => asset('/themes/velocity/assets/images/trimmer.webp'),
                                ];
                            @endphp

                            <image-wrapper
                                input-name="images[2]"
                                :images='@json($images[2])'
                                :button-label="'{{ __('velocity::app.admin.meta-data.add-image-btn-title') }}'">
                            </image-wrapper>
                        @else
                            @foreach ($advertisement[2] as $index => $image)
                                @php
                                    $images[2][] = [
                                        'id' => 'image_' . $index,
                                        'url' => Storage::url($image),
                                    ];
                                @endphp
                            @endforeach

                            <image-wrapper
                                input-name="images[2]"
                                :images='@json($images[2])'
                                :button-label="'{{ __('velocity::app.admin.meta-data.add-image-btn-title') }}'">
                            </image-wrapper>
                        @endif
                        <span class="control-info mt-10">{{ __('velocity::app.admin.meta-data.image-two-resolution') }}</span>
                    </div>
                </div>
            </accordian> -->

            <!-- <accordian :title="'{{ __('velocity::app.admin.meta-data.footer') }}'" :active="false">
                <div slot="body">
                </div>
            </accordian> -->
        </form>
        <!--  -->
<accordian :title="'Testimonial'" :active="false">
   <div slot="body">
   <!-- testimonial position -->
   <!-- <div class="control-group">
      <label>{{ 'Testimonial Position' }}</label>  
      <input
         id="testimonial_position"
         name="testimonial_position"
         type="text"
         class="control"
         value="{{$metaData->testimonial_position}}">                      
   </div>
    -->
   <!-- end testimonial position -->
   <!--  -->
   <div class="modal fade" id="addEmployeeModals" tabindex="-1" aria-labelledby="exampleModalLabel"
      data-bs-backdrop="static" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">Add Testimonial </h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('store') }}" method="POST" id="add_employee_forms" enctype="multipart/form-data">
               @csrf
               <div class="modal-body p-4 bg-light">
                  <div class="row">
                     <div class="col-lg">
                        <label for="section">Customer Name</label>
                        <input type="text" name="customer_name" class="form-control" placeholder="Customer Name" required>
                     </div>
                  </div>
                  <div class="my-2">
                     <label for="content">Description</label>
                     <textarea id="content" name="description" rows="4" cols="50" class="form-control"></textarea>
                  </div>
                  <div class="my-2">
                     <label for="content">Arabic Description</label>
                     <textarea id="content" name="arabic_description" rows="4" cols="50" class="form-control"></textarea>
                  </div>
                  <!--  -->

                  <div class="col-lg">
                    <label for="locale">Choose a locale:</label>
                    <select name="locale" id="locale">
                        <option value="en">en</option>
                        <option value="fr">fr</option>
                    </select>
                  </div>

                  <!--  -->
                  <div class="my-2 upload-img">
                     <label for="avatar">Upload Images</label>
                     <input type="file" name="avatar[]" class="form-control" multiple="multiple" required>
                  </div>
                  
               </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="submit" id="add_employee_btn" class="btn btn-primary">Add</button>
               </div>
            </form>
         </div>
      </div>
   </div>
   <!--  -->
   <!--  -->
   <div class="modal fade" id="editEmployeeModal" tabindex="-1" aria-labelledby="exampleModalLabel"
      data-bs-backdrop="static" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">Edit Testimonial</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('update') }}" method="POST" id="edit_employee_form" enctype="multipart/form-data">
               @csrf
               <input type="hidden" name="emp_id" id="emp_id">
               <input type="hidden" name="emp_avatar" id="emp_avatar">
               <div class="modal-body p-4 bg-light">
                  <div class="row">
                     <div class="col-lg">
                        <label for="section">Customer Name</label>
                        <input type="text" name="customer_name" class="form-control" placeholder="Customer Name" id="customer_name" required>
                     </div>
                  </div>
                  <div class="my-2">
                     <label for="content">Description</label>
                     <textarea  name="description" id="descriptions" rows="4" cols="50" class="form-control"></textarea>
                  </div>
                  <div class="my-2">
                     <label for="content">Arabic Description</label>
                     <textarea  name="arabic_description" id="arabic_descriptions" rows="4" cols="50" class="form-control"></textarea>
                  </div>
                  <!--  -->
                  <div class="col-lg">
                    <label for="locale">Choose a locale:</label>
                    <select name="locales" id="locales">
                        <option value="en">en</option>
                        <option value="fr">fr</option>
                    </select>
                  </div>
                  <!--  -->
                  <div class="my-2">
                     <label for="avatar">Select Avatar</label>
                     <input type="file" name="avatar" class="form-control">
                  </div>
                  <div class="mt-2" id="avatars">
                  </div>
               </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="submit" id="edit_employee_btn" class="btn btn-success">Update Employee</button>
               </div>
            </form>
         </div>
      </div>
   </div>
   <!--  -->
   <!-- -->
   <div class="container">
      <div class="row my-5">
         <div class="col-lg-12">
            <div class="card shadow">
               <div class="card-header bg-danger d-flex justify-content-between align-items-center">
                  <h3 class="text-light">Add Testimonial</h3>
                  <button types="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#addEmployeeModals"><i
                     class="bi-plus-circle me-2"></i>Add Testimonial</button>
               </div>
               <div class="card-body" id="show_all_employees">
                  <h1 class="text-center text-secondary my-5">Loading...</h1>
               </div>
            </div>
         </div>
         </div>
        </div>
         <!--  -->
    </div>
</div>
   <!--  -->
</accordian>
        <!--  -->
</div>
@stop

@push('scripts')
    <script src="{{ asset('vendor/webkul/admin/assets/js/tinyMCE/tinymce.min.js') }}"></script>

    <!--  -->

    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/js/bootstrap.bundle.min.js'></script>
  <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.10.25/datatables.min.js"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!--  -->

    <script type="text/javascript">
        $(document).ready(function () {
            tinymce.init({
                height: 200,
                width: "100%",
                image_advtab: true,
                valid_elements : '*[*]',
                selector: 'textarea#home_page_content,textarea#footer_left_content,textarea#subscription_bar_content,textarea#footer_middle_content,textarea#product-policy',
                plugins: 'image imagetools media wordcount save fullscreen code',
                toolbar1: 'formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat | code',
            });

            $('#channel-switcher, #locale-switcher').on('change', function (e) {
                $('#channel-switcher').val()

                if (event.target.id == 'channel-switcher') {
                    let locale = "{{ $channelLocales->first()->code }}";

                    $('#locale-switcher').val(locale);
                }

                var query = '?channel=' + $('#channel-switcher').val() + '&locale=' + $('#locale-switcher').val();

                window.location.href = "{{ route('velocity.admin.meta-data')  }}" + query;
            })
        });
    </script>

    <!-- -->
    <script>
        $(function() {

     
      
//add

            $("#add_employee_forms").submit(function(e) {
            e.preventDefault();
            $(document).ajaxStart(function(){
            Swal.fire(
                'Added!',
                'Data Added Successfully!',
                'success'
              )
            location.reload();
           });
            const fd = new FormData(this);
            // $("#add_employee_btn").text('Adding...');
            $.ajax({
            url: '{{ route('store') }}',
            method: 'post',
            data: fd,
            cache: false,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function(response) {
            
            fetchAllEmployees();
            
            // $("#add_employee_btn").text('Add Employee');
            $("#add_employee_forms")[0].reset();
            $("#addEmployeeModals").modal('hide');
          }
        });
      });


// fecth all data
fetchAllEmployees();

function fetchAllEmployees() {
  $.ajax({
    url: '{{ route('fetchAll') }}',
    method: 'get',
    success: function(response) {
      $("#show_all_employees").html(response);
      
    }
  });
}


// delete employee ajax request
$(document).on('click', '.deleteIcon', function(e) {
        e.preventDefault();
        $(document).ajaxStart(function(){
            Swal.fire(
                  'Deleted!',
                  'Your file has been deleted.',
                  'success'
                )
            location.reload();
});
        let id = $(this).attr('id');
        // alert(id);
        let csrf = '{{ csrf_token() }}';
        Swal.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.isConfirmed) {
            $.ajax({
              url: '{{ route('delete') }}',
              method: 'delete',
              data: {
                id: id,
                _token: csrf
              },
              success: function(response) {
                console.log(response);
                fetchAllEmployees();
              }
            });
          }
        })
      });

      // edit employee ajax request
      $(document).on('click', '.editIcon', function(e) {
        e.preventDefault();
        let id = $(this).attr('id');
        $.ajax({
          url: '{{ route('edit') }}',
          method: 'get',
          data: {
            id: id,
            _token: '{{ csrf_token() }}'
          },
          success: function(response) {
            $("#customer_name").val(response.customer_name);
            $("#descriptions").val(response.description);
            $("#arabic_descriptions").val(response.description_arabic);
            $("#locales").val(response.locale);
            $("#avatars").html(
              `<img src="http://151.80.237.29/public/storage/public/images/${response.image_url}" width="100" class="img-fluid img-thumbnail">`);
            $("#emp_id").val(response.id);
            $("#emp_avatar").val(response.avatar);
          }
        });
      });


      // update employee ajax request
      $("#edit_employee_form").submit(function(e) {
        e.preventDefault();
        $(document).ajaxComplete(function(){
            Swal.fire(
                'Updated!',
                'Employee Updated Successfully!',
                'success'
              )
        location.reload();
      });
        const fd = new FormData(this);
        $("#edit_employee_btn").text('Updating...');
        $.ajax({
          url: '{{ route('update') }}',
          method: 'post',
          data: fd,
          cache: false,
          contentType: false,
          processData: false,
          dataType: 'json',
          success: function(response) {
            
              fetchAllEmployees();
            
            $("#edit_employee_btn").text('Update Employee');
            $("#edit_employee_form")[0].reset();
            $("#editEmployeeModal").modal('hide');
          }
        });
      });
});
</script>    
    <!--  -->
@endpush
