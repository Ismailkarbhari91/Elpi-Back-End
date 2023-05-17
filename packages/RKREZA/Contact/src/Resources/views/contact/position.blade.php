@extends('admin::layouts.master')

@section('page_title')
    Contact Us Data
@stop

@section('content-wrapper')
    <div class="content full-page dashboard">
        @foreach($data as $item)
        <form method="POST" enctype="multipart/form-data" action="{{ route('admin.contact.positiondata', ['id' => $item->id]) }}" @submit.prevent="onSubmit">
            @csrf
            <div class="page-header">
                <div class="page-title">
                    <h1>Contact Us Data</h1>
                </div>
                <div class="page-action">
                    <button type="submit" class="btn btn-lg btn-primary">Update Data</button>
                </div>
            </div>
            <accordian :title="'{{ 'Contact Us Data English' }}'" :active="true">
                <div slot="body">
                    <div class="page-content">
                        <div class="control-group">
                            <label>{{ 'Contact Us Heading' }}</label>
                            <input id="contact_us_heading" name="contact_us_heading" type="text" class="control" value="{{ $item->contact_us_heading }}">
                        </div>
                        <div class="control-group">
                            <label>{{ 'Company Name' }}</label>
                            <input id="company_name" name="company_name" type="text" class="control" value="{{ $item->company_name }}">
                        </div>
                        <div class="control-group">
                            <label>{{ 'Company Address' }}</label>
                            <input id="address" name="address" type="text" class="control" value="{{ $item->address }}">
                        </div>
                        <div class="control-group">
                            <label>{{ 'Fax Number' }}</label>
                            <input id="mobile_number" name="mobile_number" type="text" class="control" value="{{ $item->mobile_number }}">
                        </div>
                        <div class="control-group">
                            <label>{{ 'Phone Number' }}</label>
                            <input id="phone_number" name="phone_number" type="text" class="control" value="{{ $item->phone_number }}">
                        </div>
                        <div class="control-group">
                            <label>{{ 'Email' }}</label>
                            <input id="email" name="email" type="text" class="control" value="{{ $item->email }}">
                        </div>
                        <div class="control-group">
                            <label>{{ 'Whatsapp Number' }}</label>
                            <input id="whatsapp_number" name="whatsapp_number" type="text" class="control" value="{{ $item->whatsapp_number }}">
                        </div>
                        <div class="control-group">
                            <label style="width:100%;">Google Map Visibility</label>
                            <select class="control" id="map_visibility" name="map_visibility">
                                <option value="1" {{ $item->map_visibility ? '' : 'selected' }}>
                                    {{ 'Yes' }}
                                </option>
                                <option value="0" {{ $item->map_visibility ? '' : 'selected' }}>
                                    {{ 'No' }}
                                </option>
                            </select>
                        </div>
                    </div>
                </div>
            </accordian>
        <!-- </form> -->
        @endforeach
        <!--  -->
        @foreach($datas as $item)
  <accordian :title="'{{ 'Contact Us Data Frech' }}'" :active="false">
    <div slot="body">
      <div class="page-content">
      <!-- <form method="POST" enctype="multipart/form-data" action="{{ route('admin.contact.positiondata', ['id' => $item->id]) }}" @submit.prevent="onSubmit"> -->
          @csrf

          <div class="control-group">
            <label>{{ 'Contact Us Heading' }}</label>  
            <input
              id="contact_us_heading_fr"
              name="contact_us_heading_fr"
              type="text"
              class="control"
              value="{{ $item->contact_us_heading_fr }}">                      
          </div>
          <div class="control-group">
            <label>{{ 'Company Name' }}</label>  
            <input
              id="company_name_fr"
              name="company_name_fr"
              type="text"
              class="control"
              value="{{ $item->company_name_fr }}">                      
          </div>
          <div class="control-group">
            <label>{{ 'Company Address' }}</label>  
            <input
              id="address_fr"
              name="address_fr"
              type="text"
              class="control"
              value="{{ $item->address_fr }}">                      
          </div>

          <div class="control-group">
            <label>{{ 'Fax Number' }}</label>  
            <input
              id="mobile_number_fr"
              name="mobile_number_fr"
              type="text"
              class="control"
              value="{{ $item->mobile_number_fr }}">                      
          </div>

          <div class="control-group">
            <label>{{ 'Phone Number' }}</label>  
            <input
              id="phone_number_fr"
              name="phone_number_fr"
              type="text"
              class="control"
              value="{{ $item->phone_number_fr }}">                      
          </div>

          <div class="control-group">
            <label>{{ 'Email' }}</label>  
            <input
              id="email_fr"
              name="email_fr"
              type="text"
              class="control"
              value="{{ $item->email_fr }}">                      
          </div>

          <div class="control-group">
            <label>{{ 'Whatsapp Number' }}</label>  
            <input
              id="whatsapp_number_fr"
              name="whatsapp_number_fr"
              type="text"
              class="control"
              value="{{ $item->whatsapp_number_fr }}">                      
          </div>
          <div class="control-group">
            <label style="width:100%;">
              Google Map Visibility
            </label>

            <select class="control" id="map_visibility_fr" name="map_visibility_fr">
              <option value="1" {{ $item->map_visibility_fr ? '' : 'selected' }}>
                {{ 'Yes' }}</option>
              <option value="0" {{ $item->map_visibility_fr ? '' : 'selected' }} >
                {{ 'No' }}</option>
            </select>
          </div>
        <!-- </form> -->
      </div>
    </div>
  </accordian>
@endforeach
</form>
        <!--  -->
    </div>
@stop
