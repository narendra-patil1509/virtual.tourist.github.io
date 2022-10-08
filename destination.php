<?php
session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
    header("location:login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel</title>
    <style>
    body {
        margin: 0;
    }

    .sb-title {
        position: relative;
        top: -12px;
        font-family: Roboto, sans-serif;
        font-weight: 500;
    }

    .sb-title-icon {
        position: relative;
        top: -5px;
    }

    .card-container {
        display: flex;
        height: 500px;
        width: 600px;
    }

    .panel {
        background: white;
        width: 300px;
        padding: 20px;
        display: flex;
        flex-direction: column;
        justify-content: space-around;
    }

    .half-input-container {
        display: flex;
        justify-content: space-between;
    }

    .half-input {
        max-width: 120px;
    }

    .map {
        width: 300px;
    }

    h2 {
        margin: 0;
        font-family: Roboto, sans-serif;
    }

    input {
        height: 30px;
    }

    input {
        border: 0;
        border-bottom: 1px solid black;
        font-size: 14px;
        font-family: Roboto, sans-serif;
        font-style: normal;
        font-weight: normal;
    }

    input:focus::placeholder {
        color: white;
    }

    .button-cta {
        height: 40px;
        width: 40%;
        background: #3367d6;
        color: white;
        font-size: 15px;
        text-transform: uppercase;
        font-family: Roboto, sans-serif;
        border: 0;
        border-radius: 3px;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.48);
        cursor: pointer;
    }
    </style>
    <script>
    "use strict";

    function initMap() {
        const CONFIGURATION = {
            "ctaTitle": "Check",
            "mapOptions": {
                "center": {
                    "lat": 37.4221,
                    "lng": -122.0841
                },
                "fullscreenControl": true,
                "mapTypeControl": false,
                "streetViewControl": true,
                "zoom": 11,
                "zoomControl": true,
                "maxZoom": 22
            },
            "mapsApiKey": "AIzaSyC4u8enS-fYdjtuqvQiBjjmZmhg3CgWll4",
            "capabilities": {
                "addressAutocompleteControl": true,
                "mapDisplayControl": true,
                "ctaControl": true
            }
        };
        const componentForm = [
            'location',
            'locality',
            'administrative_area_level_1',
            'country',
            'postal_code',
        ];
        const map = new google.maps.Map(document.getElementById("map"), {
            zoom: CONFIGURATION.mapOptions.zoom,
            center: {
                lat: 37.4221,
                lng: -122.0841
            },
            mapTypeControl: false,
            fullscreenControl: CONFIGURATION.mapOptions.fullscreenControl,
            zoomControl: CONFIGURATION.mapOptions.zoomControl,
            streetViewControl: CONFIGURATION.mapOptions.streetViewControl
        });
        const marker = new google.maps.Marker({
            map: map,
            draggable: false
        });
        const autocompleteInput = document.getElementById('location');
        const autocomplete = new google.maps.places.Autocomplete(autocompleteInput, {
            fields: ["address_components", "geometry", "name"],
            types: ["address"],
        });
        autocomplete.addListener('place_changed', function() {
            marker.setVisible(false);
            const place = autocomplete.getPlace();
            if (!place.geometry) {
                // User entered the name of a Place that was not suggested and
                // pressed the Enter key, or the Place Details request failed.
                window.alert('No details available for input: \'' + place.name + '\'');
                return;
            }
            renderAddress(place);
            fillInAddress(place);
        });

        function fillInAddress(place) { // optional parameter
            const addressNameFormat = {
                'street_number': 'short_name',
                'route': 'long_name',
                'locality': 'long_name',
                'administrative_area_level_1': 'short_name',
                'country': 'long_name',
                'postal_code': 'short_name',
            };
            const getAddressComp = function(type) {
                for (const component of place.address_components) {
                    if (component.types[0] === type) {
                        return component[addressNameFormat[type]];
                    }
                }
                return '';
            };
            document.getElementById('location').value = getAddressComp('street_number') + ' ' +
                getAddressComp('route');
            for (const component of componentForm) {
                // Location field is handled separately above as it has different logic.
                if (component !== 'location') {
                    document.getElementById(component).value = getAddressComp(component);
                }
            }
        }

        function renderAddress(place) {
            map.setCenter(place.geometry.location);
            marker.setPosition(place.geometry.location);
            marker.setVisible(true);
        }
    }
    </script>
    <link
        href="https://maps.googleapis.com/maps/api/directions/json?origin=Disneyland&destination=Universal+Studios+Hollywood&key=YOUR_API_KEY">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
</head>

<body>
    <?php include 'partial/heading.php'; ?>
    <?php include 'partial/db_connect.php'; ?>
    <section class="p-3">
        <div class="container">
            <!-- <form>
                    <div class="mb-3">
                        <select class="form-select" aria-label="Default select example" style="width:50%;">
                            <option selected>From</option>
                            <option value="1">Jalgon</option>
                            <option value="2">Bus Stand</option>
                            <option value="3">Railway Station</option>
                        </select>

                    </div>

                    <div class="mb-3">To</div>
                    <div class="mb-3">
                        <select class="form-select" aria-label="Default select example" style="width:50%;">
                            <option selected>To</option>
                            <option value="1">Patnadevi</option>
                            <option value="2">Padmalay</option>
                            <option value="3">Sukheshwar</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form> -->
            <!--  -->
        </div>
    </section>

    <section class="p-3">
        <div class="container">
            <div class="card-container">
                <div class="panel">
                    <div>
                        <img class="sb-title-icon"
                            src="https://fonts.gstatic.com/s/i/googlematerialicons/location_pin/v5/24px.svg" alt="">
                        <span class="sb-title">Address Selection</span>
                    </div>
                    <input type="text" placeholder="Address" id="location" />
                    <input type="text" placeholder="Apt, Suite, etc (optional)" />
                    <input type="text" placeholder="City" id="locality" />
                    <div class="half-input-container">
                        <input type="text" class="half-input" placeholder="State/Province"
                            id="administrative_area_level_1" />
                        <input type="text" class="half-input" placeholder="Zip/Postal code" id="postal_code" />
                    </div>
                    <input type="text" placeholder="Country" id="country" />
                    <button class="button-cta">Check</button>
                </div>
                <div class="map" id="map"></div>
            </div>
            <script
                src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC4u8enS-fYdjtuqvQiBjjmZmhg3CgWll4&libraries=places&callback=initMap&solution_channel=GMP_QB_addressselection_v1_cABC"
                async defer></script>
        </div>
    </section>
    <?php include 'partial/footer.php';?>
</body>
</html>