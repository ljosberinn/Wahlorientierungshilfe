<?php

if ( isset( $_GET[ 'sourcecode' ] ) ) {
	highlight_file( 'footer.php' );
}

?>

<a href="https://www.facebook.com/wahlorientierungshilfe/" target="_blank" title="auf Facebook mit 'Gefällt mir' markieren">
	<!--- Quelle: https://de.facebookbrand.com/assets/daumen-hoch-symbol-->
	<img src="img/ThumbsUp Small.png" height="32px" alt="Auf Facebook mit 'Gefällt mir' markieren" />	
</a>

<a href="https://www.facebook.com/sharer/sharer.php?u=https://wahl2017.gerritalex.de/" target="_blank" title="auf Facebook teilen">
	<svg style="fill: #3B5998;" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="1.414">
		<path d="M15.117 0H.883C.395 0 0 .395 0 .883v14.234c0 .488.395.883.883.883h7.663V9.804H6.46V7.39h2.086V5.607c0-2.066 1.262-3.19 3.106-3.19.883 0 1.642.064 1.863.094v2.16h-1.28c-1 0-1.195.48-1.195 1.18v1.54h2.39l-.31 2.42h-2.08V16h4.077c.488 0 .883-.395.883-.883V.883C16 .395 15.605 0 15.117 0" fill-rule="nonzero"></path>
	</svg>
</a>

<a href="https://twitter.com/share?url=https://wahl2017.gerritalex.de" target="_blank" title="auf Twitter teilen">
	<svg style="fill: #1DA1F2;" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="1.414">
		<path d="M16 3.038c-.59.26-1.22.437-1.885.517.677-.407 1.198-1.05 1.443-1.816-.634.37-1.337.64-2.085.79-.598-.64-1.45-1.04-2.396-1.04-1.812 0-3.282 1.47-3.282 3.28 0 .26.03.51.085.75-2.728-.13-5.147-1.44-6.766-3.42C.83 2.58.67 3.14.67 3.75c0 1.14.58 2.143 1.46 2.732-.538-.017-1.045-.165-1.487-.41v.04c0 1.59 1.13 2.918 2.633 3.22-.276.074-.566.114-.865.114-.21 0-.41-.02-.61-.058.42 1.304 1.63 2.253 3.07 2.28-1.12.88-2.54 1.404-4.07 1.404-.26 0-.52-.015-.78-.045 1.46.93 3.18 1.474 5.04 1.474 6.04 0 9.34-5 9.34-9.33 0-.14 0-.28-.01-.42.64-.46 1.2-1.04 1.64-1.7z" fill-rule="nonzero"></path>
	</svg>
</a>

<a href="https://plus.google.com/share?url=https://wahl2017.gerritalex.de/" target="_blank" title="auf Google+ teilen">
	<svg style="fill: #DC4E41;" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="1.414">
		<path d="M5.09 7.273v1.745h2.89c-.116.75-.873 2.197-2.887 2.197-1.737 0-3.155-1.44-3.155-3.215S3.353 4.785 5.09 4.785c.99 0 1.652.422 2.03.786l1.382-1.33c-.887-.83-2.037-1.33-3.41-1.33C2.275 2.91 0 5.19 0 8s2.276 5.09 5.09 5.09c2.94 0 4.888-2.065 4.888-4.974 0-.334-.036-.59-.08-.843H5.09zm10.91 0h-1.455V5.818H13.09v1.455h-1.454v1.454h1.455v1.455h1.46V8.727H16"></path>
	</svg>
</a>

<?php

// Quelle: http://detectmobilebrowsers.com/ => PHP

$useragent = $_SERVER[ 'HTTP_USER_AGENT' ];

if ( preg_match( '/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i', $useragent ) || preg_match( '/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i', substr( $useragent, 0, 4 ) ) )

echo '
<a href="whatsapp://send?text=Hi,%20habe%20gerade%20den%20neutralen%20Wahlomaten%20auf%20https://wahl2017.gerritalex.de%20ausprobiert,%20vielleicht%20interessiert%20er%20dich%20auch" title="via WhatsApp versenden">
	<svg style="fill: #25D366;" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="1.414">
		<path d="M11.665 9.588c-.2-.1-1.177-.578-1.36-.644-.182-.067-.315-.1-.448.1-.132.197-.514.643-.63.775-.116.13-.232.14-.43.05-.2-.1-.842-.31-1.602-.99-.592-.53-.99-1.18-1.107-1.38-.116-.2-.013-.31.087-.41.09-.09.2-.23.3-.35.098-.12.13-.2.198-.33.066-.14.033-.25-.017-.35-.05-.1-.448-1.08-.614-1.47-.16-.39-.325-.34-.448-.34-.115-.01-.248-.01-.38-.01-.134 0-.35.05-.532.24-.182.2-.696.68-.696 1.65s.713 1.91.812 2.05c.1.13 1.404 2.13 3.4 2.99.476.2.846.32 1.136.42.476.15.91.13 1.253.08.383-.06 1.178-.48 1.344-.95.17-.47.17-.86.12-.95-.05-.09-.18-.14-.38-.23M8.04 14.5h-.01c-1.18 0-2.35-.32-3.37-.92l-.24-.143-2.5.65.67-2.43-.16-.25c-.66-1.05-1.01-2.26-1.01-3.506 0-3.63 2.97-6.59 6.628-6.59 1.77 0 3.43.69 4.68 1.94 1.25 1.24 1.94 2.9 1.94 4.66-.003 3.63-2.973 6.59-6.623 6.59M13.68 2.3C12.16.83 10.16 0 8.03 0 3.642 0 .07 3.556.067 7.928c0 1.397.366 2.76 1.063 3.964L0 16l4.223-1.102c1.164.63 2.474.964 3.807.965h.004c4.39 0 7.964-3.557 7.966-7.93 0-2.117-.827-4.11-2.33-5.608"></path>
	</svg>
</a>

<a href="fb-messenger://share?link=https://wahl2017.gerritalex.de/" title="via Messenger teilen">
	<svg style="fill: #0084FF;" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="1.414">
		<path d="M8 0C3.582 0 0 3.316 0 7.407c0 2.332 1.163 4.41 2.98 5.77V16l2.725-1.495c.727.2 1.497.31 2.295.31 4.418 0 8-3.317 8-7.408C16 3.317 12.418 0 8 0zm.795 9.975L6.758 7.802 2.783 9.975l4.372-4.642 2.087 2.173 3.926-2.173-4.373 4.642z" fill-rule="nonzero"></path>
	</svg>
</a>
';

?>

<a href="mailto:?subject=Neutraler Wahlomat - wahl2017.gerritalex.de&body=Neutraler Wahlomat auf https://wahl2017.gerritalex.de/" target="_blank" title="via Mail empfehlen">
	<svg fill="#000000" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
		<path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/>
		<path d="M0 0h24v24H0z" fill="none"/>
	</svg>
</a>

<a href="mailto:wahl-feedback@gerritalex.de?subject=Feedback zum Wahlomaten&body=Hallo, ich hätte folgende Anregungen zum Wahlomaten:" title="Feedback" style="margin-right: 15px;">
	<svg fill="#000000" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
		<path d="M0 0h24v24H0z" fill="none"/>
		<path d="M20 2H4c-1.1 0-1.99.9-1.99 2L2 22l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm-7 12h-2v-2h2v2zm0-4h-2V6h2v4z"/>
	</svg>
</a>

<br />

<a style="margin-right: 15px;" class="font-white" onclick="imprint();">Impressum & Datenschutzerklärung</a>