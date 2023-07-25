

document.addEventListener('DOMContentLoaded', (event) => {

    initMap();


    function initMap() {
        ymaps.ready(init);
        function init(){
            let Map = new ymaps.Map("map", {
                center: [55.752770, 37.628958],
                zoom: 13
            });


            $officeItems = document.querySelectorAll('.ymaps-component__item');

            $officeItems.forEach(item => {

                let coords = item.dataset.coords.split(",")

                Map.geoObjects.add(new ymaps.Placemark([Number(coords[1],10), Number(coords[0],10)], {
                    balloonContent: 'еуые'
                }, {
                    preset: 'islands#icon',
                    iconColor: '#d9d9d9'
                }));

                item.addEventListener('click', event => {

                    Map.setZoom(14);

                    Map.panTo([Number(coords[1]),Number(coords[0])], {
                        flying: true
                    })
                });
            });


        }
    }
})