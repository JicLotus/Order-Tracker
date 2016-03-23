@extends("layouts.base")

@section("head")

  <script type="text/javascript">
    $(document).ready(function(){
      $(document).keypress(
          function(event){
            if (event.which == '13') {
              event.preventDefault();
            }
      });
    });
  </script>

@endsection

@section("content")
    <section id="search-section">

        <div id="search-section-footer">
            
        </div>
        
    </section>

@endsection

@section("footer")

  <script>
    // This example displays an address form, using the autocomplete feature
    // of the Google Places API to help users fill in the information.

    var placeSearch, autocomplete;
    var componentForm = {
      street_number: 'short_name',
      route: 'long_name',
      locality: 'long_name',
      administrative_area_level_1: 'short_name',
      administrative_area_level_2: 'short_name',
      administrative_area_level_3: 'short_name',
      sublocality_level_1: 'short_name',
      sublocality_level_2: 'short_name',
      sublocality_level_3: 'short_name',
      country: 'long_name',
      postal_code: 'short_name'
    };

    function initAutocomplete() {
      // Create the autocomplete object, restricting the search to geographical
      // location types.
      autocomplete = new google.maps.places.Autocomplete(
          /** @type {!HTMLInputElement} */(document.getElementById('autocomplete')),
          {types: ['geocode']});

      // When the user selects an address from the dropdown, populate the address
      // fields in the form.
      autocomplete.addListener('place_changed', fillInAddress);
    }

    // [START region_fillform]
    function fillInAddress() {
      // Get the place details from the autocomplete object.
      var place = autocomplete.getPlace();
      console.log(place);
      for (var component in componentForm) {
        $("input[name=" + component + "]").val("");
      }
      $("input[name=formatted_address]").val("");

      // Get each component of the address from the place details
      // and fill the corresponding field on the form.
      if(place.address_components) {
        for (var i = 0; i < place.address_components.length; i++) {
          var addressType = place.address_components[i].types[0];
          if (componentForm[addressType]) {
            var val = place.address_components[i][componentForm[addressType]];
            $("input[name=" + addressType + "]").val(val);
          }
        }
        $("input[name=formatted_address]").val(place.formatted_address);
        $("button#save").prop("disabled", false);
      }
      else {
        $("button#save").prop("disabled", true);
      }
    }
    // [END region_fillform]

    // [START region_geolocation]
    // Bias the autocomplete object to the user's geographical location,
    // as supplied by the browser's 'navigator.geolocation' object.
    function geolocate() {
        var inputAddress = $('#autocomplete').val();
    
        var geocoder = new google.maps.Geocoder();
        var address = inputAddress;

        geocoder.geocode( { 'address': address}, function(results, status) {

        if (status == google.maps.GeocoderStatus.OK) {
                
            var latitude = results[0].geometry.location.lat();
            var longitude = results[0].geometry.location.lng();
            $("input[name=latitude]").val(latitude);
            $("input[name=longitude]").val(longitude);
            } 
        }); 
    }

    </script>
    <script src="https://maps.googleapis.com/maps/api/js?signed_in=true&libraries=places&callback=initAutocomplete"
      async defer></script>
@endsection
