import L from 'leaflet';
import 'leaflet/dist/leaflet.css'

export default class Map {
    static init(){
        let map = document.querySelector('#map');
        if (map === null) {
            return
        }
        let icon = L.icon({
            iconUrl: '/images/marker-icon-2x.png',
        });
        let center = [map.dataset.lat, map.dataset.lng];
        map = L.map('map').setView(center, 13);
        let token = 'pk.eyJ1IjoiYWthcmNoYWwiLCJhIjoiY2t0bHd3dWczMGw5OTJvbWpwY3F5ZWt4ZyJ9.yhlYvAad5-dZxWZFDIrhdQ';
        L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}',{
            maxZoom: 20,
            minZoom: 12,
            id: 'mapbox/streets-v11',
            attribution : '© <a href="https://www.mapbox.com/about/maps/">Mapbox</a> © <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a> <strong><a href="https://www.mapbox.com/map-feedback/" target="_blank">Improve this map</a></strong>',
            accessToken: token
        }).addTo(map)
        L.marker(center, {icon: icon}).addTo(map)
    }
}