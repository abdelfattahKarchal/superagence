// assets/js/app.js
/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)

import Places from 'places.js';
import Map from './modules/map';
import 'slick-carousel'
import 'slick-carousel/slick/slick.css'
import 'slick-carousel/slick/slick-theme.css'

Map.init()

let inputAddress = document.querySelector('#property_address');

if (inputAddress !== null) {
    let place = Places({
        container: inputAddress
    })

    place.on('change', e => {
        document.querySelector('#property_city').value = e.suggestion.city
        document.querySelector('#property_postal_code').value = e.suggestion.postcode
        document.querySelector('#property_lat').value = e.suggestion.latlng.lat
        document.querySelector('#property_lng').value = e.suggestion.latlng.lng
    })
}

let searchAddress = document.querySelector('#search_address');

if (searchAddress !== null) {
    let place = Places({
        container: searchAddress
    })

    place.on('change', e => {
        document.querySelector('#lat').value = e.suggestion.latlng.lat
        document.querySelector('#lng').value = e.suggestion.latlng.lng
    })
}

let $ = require('jquery');
import '../styles/app.css';

require('select2');



$('select').select2({
    theme: "classic"
});

let $contactButton = $('#contactButton');
$contactButton.on('click', e => {
    e.preventDefault()
    $contactButton.slideUp();
    $('#contactForm').slideDown();
});

// Suppression des elements 

document.querySelectorAll('[data-delete]').forEach(a => {
    a.addEventListener('click', e => {
        e.preventDefault()
        //execution du lien
        fetch(a.getAttribute('href'), {
            method: 'DELETE',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Content-Type': 'application/json'
            },
            body : JSON.stringify({'_token': a.dataset.token})
        }).then(response => response.json())
            .then(data => {
                if (data.success) {
                    a.parentNode.parentNode.removeChild(a.parentNode)
                } else {
                    alert(data.error);
                }
            })
        .catch(e => alert(e))
    })
})


// gestion de slick carousel

$('[data-slider]').slick({
    dots: true,
    arrows: true
})
// Need jQuery? Install it with "yarn add jquery", then uncomment to import it.
// import $ from 'jquery';



//console.log('Hello Webpack Encore! Edit me in assets/js/app.js');