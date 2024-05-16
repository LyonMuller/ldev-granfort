// @koala-prepend "plugins/splide.js"
const splide = new Splide( '.splide-galeria', {
  pagination: false,
  arrows: false,
});

const thumbnails = document.getElementsByClassName( 'thumbnail' );
let current;

for ( let i = 0; i < thumbnails.length; i++ ) {
  initThumbnail( thumbnails[ i ], i );
}


function initThumbnail( thumbnail, index ) {
  thumbnail.addEventListener( 'click', function () {
    splide.go( index );
  });
}

splide.on( 'mounted move', function () {
  const thumbnail = thumbnails[ splide.index ];
  if (thumbnail) {
    if (current) {
      current.classList.remove( 'is-active' );
    }
    thumbnail.classList.add( 'is-active' );
    current = thumbnail;
  }
});

splide.mount();