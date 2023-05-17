@extends('admin::layouts.master') @section('page_title') Shipping Address
@stop @section('content-wrapper')

<div class="content full-page dashboard">
          <form
            method="POST"
            enctype="multipart/form-data"
            action="{{ route('admin.customer.shippinggedit') }}"
            @submit.prevent="onSubmit">
@csrf
  <div class="page-header">
    <div class="page-title">
    <h1>Shipping Address Data</h1>
    <i class="icon angle-left-icon back-link" onclick="history.length > 1 ? history.go(-1) : window.location = '{{ url('/admin/dashboard') }}';"></i>


    </div>

    <div class="page-action">
    <button type="submit" class="btn btn-lg btn-primary">
            Update Data
    </button>
    </div>
    </div>
  <div class="page-content">  
    <div class="control-group">
        <label>{{ 'First Name' }}</label>  
        <input
            id="first_name"
            name="first_name"
            type="text"
            class="control"
            value="{{ $user ? $user->first_name : '' }}">                      
</div>
    <div class="control-group">
        <label>{{ 'Last Name' }}</label>  
        <input
            id="last_name"
            name="last_name"
            type="text"
            class="control"
            value="{{ $user ? $user->last_name : '' }}">                      
    </div>
    <div class="control-group">
        <label>{{ 'Company Name' }}</label>  
        <input
            id="company_name"
            name="company_name"
            type="text"
            class="control"
            value="{{ $user ? $user->company_name : '' }}">                      
    </div>

    <!--  -->

    <!-- <div class="control-group">
    <label>Country</label>
    <select class="control" id="country" name="country">
        <option value="">Select Country</option>
        @foreach (core()->countries() as $country)
            <option value="{{ $country->name }}" {{ optional($user)->country == $country->name ? 'selected' : '' }}>
                {{ $country->name }}
            </option>
        @endforeach
    </select>                 
</div> -->


    <!--  -->

    <div class="control-group">
        <label>{{ 'Country' }}</label>  
        <input
            id="country"
            name="country"
            type="text"
            class="control"
            value="{{ $user ? $user->country : '' }}">                      
    </div>

    <div class="control-group">
        <label>{{ 'Address1' }}</label>  
        <input
            id="address1"
            name="address1"
            type="text"
            class="control"
            value="{{ $user ? $user->address1 : '' }}">                      
    </div>

    <div class="control-group">
        <label>{{ 'Address2' }}</label>  
        <input
            id="address2"
            name="address2"
            type="text"
            class="control"
            value="{{ $user ? $user->address2 : '' }}">                      
    </div>

    <div class="control-group">
        <label>{{ 'City' }}</label>  
        <input
            id="city"
            name="city"
            type="text"
            class="control"
            value="{{ $user ? $user->city : '' }}">                      
    </div>

    <div class="control-group">
        <label>{{ 'State' }}</label>  
        <input
            id="state"
            name="state"
            type="text"
            class="control"
            value="{{ $user ? $user->state : '' }}">                      
    </div>

    <div class="control-group">
        <label>{{ 'Zipcode' }}</label>  
        <input
            id="zipcode"
            name="zipcode"
            type="text"
            class="control"
            value="{{ $user ? $user->zipcode : '' }}">                      
    </div>

    
    <div class="control-group">
        <!-- <label>{{ 'Customer_id' }}</label>   -->
        <input
            id="customer_id"
            name="customer_id"
            type="hidden"
            class="control"
            value="{{ $customerId }}">                      
    </div>


  </div>
  <!--  -->
  </form>

</div>

@stop
