// assets/js/app.js
/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
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
// Need jQuery? Install it with "yarn add jquery", then uncomment to import it.
// import $ from 'jquery';



//console.log('Hello Webpack Encore! Edit me in assets/js/app.js');