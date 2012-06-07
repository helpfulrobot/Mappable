
(function($) {
    $(document).ready(function() {
        
        var map = null;
        var marker = null;
        var geocoder = new google.maps.Geocoder();
        var elevator = new google.maps.ElevationService();

        var myOptions = {
            zoom: 16,
            disableDefaultUI: false,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            disableDoubleClickZoom:true,
            draggable:true,
            keyboardShortcuts:false,
            scrollwheel:true
        };
        
        function setMarker(location){
            if (marker != null) {
                marker.setPosition(location);
            } else {
                marker = new google.maps.Marker({
                  position: location,
                  title:"Position",
                  draggable:true
                });
                marker.setMap(map);
                google.maps.event.addListener(marker, 'dragend',setCoordByMarker);
            }
            map.setCenter(location) 
        }
        
        function setCoordByMarker(event) {
            $('input[name=Latitude]').val(event.latLng.lat());
            $('input[name=Longitude]').val(event.latLng.lng());
            map.setCenter(event.latLng);
        }
        
        function searchForAddress(address) {
            
            if (geocoder) {
                statusMessage("Searching for:"+address);
                geocoder.geocode( { 'address': address}, function(results, status) {
                    if (status == google.maps.GeocoderStatus.OK) {
                        var l = results.length;

                        if (l > 0) {
                            statusMessage("Places found");
                        } else if (l == 0) {
                            errorMessage("No places found");
                        }

                        var html = '<ul class="geocodedSearchResults">';
//mapSearchResults
                        $.each(results, function(index, value) {
                            var address = new Array();
                            $.each(value.address_components, function(i,v) {
                                address.push(v.long_name);
                            });

                           // alert(value.geometry);
                           // alert(value.geometry.location);

                          html = html +'<li lat="'+value.geometry.location.lat()+'" lon="'+value.geometry.location.lng()+'">'+address+"</li>"; 
                        });

                        html = html + "</ul>";

                        $('#mapSearchResults').html(html);

                      // $('input[name=Latitude]').val(results[0].geometry.location.lat());
                      //  $('input[name=Longitude]').val(results[0].geometry.location.lng());
                    //  setMarker(results[0].geometry.location.lat);
                    } else {
                        errorMessage("Unable to find any geocoded results");
                    }
                });
                
            }
        }
        
        //triggers
        $('input[name=action_GetCoords]').livequery('click',
                function(e) {
                    // get the data needed to ask coords
                    var location = $('#Form_EditForm_Location').val();
                    setCoordByAddress(location);
                    return false;
                 }
        );


        $('#searchLocationButton').livequery('click',
                function(e) {
                    // get the data needed to ask coords
                    var location = $('#location_search').val();
                    searchForAddress(location);
                    return false;
                 }
        );

        //geocodedSearchResults

        $('.geocodedSearchResults li').livequery('click',
                function(e) {
                    // get the data needed to ask coords
                    var t = $(this);
                    var lat = t.attr("lat");
                    var lon = t.attr("lon");
                    var address = t.html();
                    var latlng = new google.maps.LatLng(lat, lon);
                    statusMessage("Setting map to "+address);
                    $('.geocodedSearchResults').html('');
                    $('#Form_EditForm_Latitude').val(lat);
                    $('#Form_EditForm_Longitude').val(lon);

                    $('#Form_EditForm_Location').val(address);
                    setMarker(latlng);
                    return false;
                 }
        );

        
        function initMap () {
            myOptions.center = new google.maps.LatLng($('input[name=Latitude]').val(),$('input[name=Longitude]').val());
            map = new google.maps.Map(document.getElementById("GoogleMap"), myOptions);
            
            if ($('input[name=Latitude]').val() && $('input[name=Longitude]').val()) {
                marker = null;
                setMarker(myOptions.center);
            }            
        }       
        
        $('#GoogleMap').livequery(function () { initMap(); });
        
    });
})(jQuery);	
