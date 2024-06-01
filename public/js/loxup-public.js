// Define the map variable globally
var map;

// Define a global variable to store the info windows
var infoWindows = [];

// Function to create and open an info window for a marker
function openInfoWindow(marker, partner) {
  // Close any previously opened info windows
  closeAllInfoWindows();

  // Create the content for the info window
  var content =
    "<div class='gm-style-iw-d' style='overflow: scroll; max-height: 714px;'><div><div class='maps-info'>" +
    '<h1><a href="' +
    partner.link +
    '">' +
    '<font style="vertical-align: inherit;">' +
    partner.title +
    "</font>" +
    "</a></h1>" +
    '<div class="maps-info-content">' +
    '<div class="maps-info-content-phone"><a href="tel:' +
    partner.phone +
    '" tabindex="0"><i class="fa-solid fa-phone icons8-phone pink--text"></i></a></div>' +
    '<div class="maps-info-content-city"><font style="vertical-align: inherit;">' +
    partner.city +
    "</font></div>" +
    '<div class="maps-info-content-service"><font style="vertical-align: inherit;">' +
    partner.tags +
    "</font></div>" +
    "</div>" +
    "</div></div></div></div>";
  // Create a new info window
  var infoWindow = new google.maps.InfoWindow({
    content: content,
  });

  // Open the info window for the marker
  infoWindow.open(map, marker);

  // Add the info window to the global array
  infoWindows.push(infoWindow);
}

// Function to close all info windows
function closeAllInfoWindows() {
  infoWindows.forEach(function (infoWindow) {
    infoWindow.close();
  });
}
// Function to initialize the map without markers
function initMap() {
  // Initialize the map here without any markers
  console.log(loxup_google_maps_vars);
  map = new google.maps.Map(document.getElementById("google-map"), {
    center: {
      lat: parseInt(loxup_google_maps_vars.location.latitude),
      lng: parseInt(loxup_google_maps_vars.location.longitude),
    },
    zoom: 5,
  });
}

// Function to add markers for all partners
function showAllMarkers() {
  // AJAX call to fetch all partners
  jQuery.ajax({
    url: loxup_google_maps_vars.ajaxurl,
    type: "POST",
    data: {
      action: "get_partner_locations",
      security: loxup_google_maps_vars.nonce,
    },
    success: function (response) {
      var partners = response.data;
      addMarkers(partners);
    },
    error: function (xhr, status, error) {
      console.log(xhr.responseText); // Log any errors to the console
    },
  });
}

// Function to add markers for filtered partners
function filterByTaxonomy(selectedTerms) {
  // AJAX call to filter partners based on selected taxonomy term
  jQuery.ajax({
    url: loxup_google_maps_vars.ajaxurl,
    type: "POST",
    data: {
      action: "filter_partners_markers",
      terms: selectedTerms, // Array of selected terms
      security: loxup_google_maps_vars.nonce,
    },
    success: function (response) {
      var filteredPartners = response;
      addMarkers(filteredPartners);
    },
    error: function (xhr, status, error) {
      console.log(xhr.responseText); // Log any errors to the console
    },
  });
}

// Function to add markers to the map
function addMarkers(partners) {
  // Clear existing markers
  if (map && map.markers && map.markers.length > 0) {
    map.markers.forEach(function (marker) {
      marker.setMap(null);
    });
  }

  // Add markers to the map
  partners.forEach(function (partner) {
    var marker = new google.maps.Marker({
      position: {
        lat: parseFloat(partner.latitude),
        lng: parseFloat(partner.longitude),
      },
      map: map,
      title: partner.title,
    });
    // Add a mouseover event listener to the marker
    marker.addListener("mouseover", function () {
      openInfoWindow(marker, partner);
    });
    // Initialize map.markers as an array if it doesn't exist
    if (!map.markers) {
      map.markers = [];
    }
    // Add marker to the map markers array
    map.markers.push(marker);
  });
}

document.addEventListener("DOMContentLoaded", function () {
  var playButton = document.querySelector(".play-button");
  var grayOverlay = document.querySelector(".gray-layover");
  var iframe = document.querySelector(".youtube-video iframe");

  playButton.addEventListener("click", function () {
    grayOverlay.style.display = "flex";
    iframe.contentWindow.postMessage(
      '{"event":"command","func":"playVideo","args":""}',
      "*"
    );
  });

  window.addEventListener("click", function (event) {
    if (event.target == grayOverlay) {
      grayOverlay.style.display = "none";
      iframe.contentWindow.postMessage(
        '{"event":"command","func":"stopVideo","args":""}',
        "*"
      );
    }
  });
});

(function ($) {
  "use strict";

  $(".search_partner").on("click", function () {
    $(".dealers").toggle();
    $("#view_all_button").toggle();

    // Show all markers
    showAllMarkers();
  });

  $("#view_all_button").on("click", function () {
    $(".dealers").toggle();
    $("#view_all_button").toggle();
  });

  $(".taxonomy-term").on("change", function () {
    var selectedTerms = [];
    $(".taxonomy-term:checked").each(function () {
      selectedTerms.push($(this).attr("id"));
    });

    // Filter partners by taxonomy
    filterByTaxonomy(selectedTerms);

    $.ajax({
      url: loxup_google_maps_vars.ajaxurl,
      type: "post",
      data: {
        action: "filter_partners",
        terms: selectedTerms,
      },
      success: function (response) {
        $(".dealers").html(response);
      },
    });
  });
})(jQuery);
