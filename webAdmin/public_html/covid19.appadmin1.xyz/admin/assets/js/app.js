$(function()
{
    var map = new google.maps.Map(document.getElementById("mapElement"), {
        center            : new google.maps.LatLng(51.509865,-.118092),
        zoom              : 12,
        streetViewControl : false,
        mapTypeControl    : false,
        fullscreenControl : false,
        styles            : [{
            featureType: "landscape",
            elementType: "geometry.fill",
            stylers: [{
                visibility: "on"
            }]
        }, {
            featureType: "poi.attraction",
            elementType: "labels",
            stylers: [{
                visibility: "off"
            }]
        }, {
            featureType: "poi.attraction",
            elementType: "labels.text",
            stylers: [{
                visibility: "off"
            }]
        }, {
            featureType: "poi.business",
            elementType: "labels",
            stylers: [{
                visibility: "off"
            }]
        }, {
            featureType: "poi.government",
            elementType: "labels",
            stylers: [{
                visibility: "off"
            }]
        }, {
            featureType: "poi.government",
            elementType: "labels.text",
            stylers: [{
                visibility: "off"
            }]
        }, {
            featureType: "poi.medical",
            elementType: "labels",
            stylers: [{
                visibility: "off"
            }]
        }, {
            featureType: "poi.park",
            elementType: "labels",
            stylers: [{
                visibility: "on"
            }]
        }, {
            featureType: "poi.place_of_worship",
            elementType: "labels",
            stylers: [{
                visibility: "off"
            }]
        }, {
            featureType: "poi.school",
            elementType: "labels",
            stylers: [{
                visibility: "off"
            }]
        }, {
            featureType: "poi.sports_complex",
            elementType: "labels",
            stylers: [{
                visibility: "off"
            }]
        }, {
            featureType: "road.arterial",
            stylers: [{
                visibility: "simplified"
            }]
        }, {
            featureType: "road.highway.controlled_access",
            stylers: [{
                visibility: "simplified"
            }]
        }, {
            featureType: "road.local",
            stylers: [{
                visibility: "simplified"
            }]
        }, {
            featureType: "road.local",
            elementType: "geometry.fill",
            stylers: [{
                visibility: "simplified"
            }]
        }, {
            featureType: "road.local",
            elementType: "geometry.stroke",
            stylers: [{
                visibility: "simplified"
            }]
        }, {
            featureType: "transit.line",
            stylers: [{
                visibility: "off"
            }]
        }]
    });

    // var t = {
    //     zoom: n._showNewDrawASearch ? f.DRAW_A_SEAECH_MAP_ZOOM_MIN : f.MAP_ZOOM_MIN,
    //     minZoom: n._showNewDrawASearch ? f.DRAW_A_SEAECH_MAP_ZOOM_MIN : f.MAP_ZOOM_MIN,
    //     maxZoom: f.MAP_ZOOM_MAX,
    //     streetViewControl: !1,
    //     mapTypeControl: !1,
    //     fullscreenControl: !1,
    //     center: n._showNewDrawASearch ? new e.maps.LatLng(54.509865,-5.118092) : new e.maps.LatLng(51.509865,-.118092),
    //     mapTypeId: e.maps.MapTypeId.ROADMAP,
    //     styles: f.MAP_STYLE
    // };

    // map = new google.maps.Map(document.getElementById('map'), {
    //     center: {lat: -34.397, lng: 150.644},
    //     zoom: 8
    //   });

});