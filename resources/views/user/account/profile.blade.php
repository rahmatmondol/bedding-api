<x-app-layout>
   <livewire:my-profile />
</x-app-layout>

<script>
   var map;
   var marker;
   var markerSearchByName;
   var initialCenter = {
       lat: 23.8103,
       lng: 90.4125
   };

   function initAutocomplete() {
       map = new google.maps.Map(document.getElementById('map'), {
           center: initialCenter,
           zoom: 13,
           mapTypeId: 'roadmap',
           clickableIcons: false
       });

       var input = document.getElementById('pac-input');
       var autocomplete = new google.maps.places.Autocomplete(input);
       autocomplete.bindTo('bounds', map);

       map.addListener('click', function(e) {
           setMarker(e.latLng);
           updateAddress(e.latLng);
       });

       autocomplete.addListener('place_changed', function() {
           var place = autocomplete.getPlace();
           if (!place.geometry) {
               alert("Autocomplete's place geometry is missing: " + place.name);
               return;
           }
           if (place.geometry.viewport) {
               map.fitBounds(place.geometry.viewport);
           } else {
               map.setCenter(place.geometry.location);
               map.setZoom(17);
           }
           setMarker(place.geometry.location);
           updateAddress(place.geometry.location);
       });
   }

   function setMarker(location) {
       if (marker) {
           marker.setPosition(location);
       } else {
           marker = new google.maps.Marker({
               position: location,
               map: map,
               draggable: true
           });
           marker.addListener('dragend', function(event) {
               updateAddress(event.latLng);
           });
       }
   }

   function updateAddress(latLng) {
       document.getElementById('latitude').value = latLng.lat();
       document.getElementById('longitude').value = latLng.lng();
       var geocoder = new google.maps.Geocoder();
       geocoder.geocode({
           'location': latLng
       }, function(results, status) {
           if (status === 'OK' && results[0]) {
               document.getElementById('location-name').value = results[0].formatted_address;
               document.getElementById('pac-input').value = results[0].formatted_address;
           }
       });
   }

   function resetMap() {
       map.setCenter(initialCenter);
       map.setZoom(13);
       document.getElementById('pac-input').value = '';
       document.getElementById('latitude').value = '';
       document.getElementById('longitude').value = '';
       document.getElementById('location-name').value = '';
       if (marker) {
           marker.setMap(null);
           marker = null;
       }
   }

   function previewUploadedImage(event) {
       const files = event.target.files;
       const imgElement = document.getElementById('uploadedImagePreview');
       const previewList = document.getElementById('uploadedImagePreviewList');
       previewList.innerHTML = '';
       for (let i = 0; i < files.length; i++) {
           const reader = new FileReader();
           reader.onload = function() {
               const img = document.createElement('img');
               img.src = reader.result;
               img.style.height = 'auto';
               previewList.appendChild(img);
           }
           reader.readAsDataURL(files[i]);
       }
   }

   var quill = new Quill('#editor', {
       theme: 'snow',
       modules: {
           toolbar: [
               [{
                   'header': [1, 2, false]
               }],
               ['bold', 'italic', 'underline'],
               [{
                   'list': 'ordered'
               }, {
                   'list': 'bullet'
               }],
               ['clean'] // Remove formatting button
           ]
       },
       placeholder: 'Type here...'
   });

   // Listen for text changes and save content to hidden input
   quill.on('text-change', function() {
       document.getElementById('messageContent').value = quill.root.innerHTML;
   });
</script>

<script
   src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCc9NIB-ScnkTvQZzrB53TfaCwo1XUegHM&libraries=places,geometry&callback=initAutocomplete"
   async defer></script>
