/* VARS ***********************************************************************/
let navToggle = document.getElementById('nav-toggle');
let navLinks = document.getElementsByClassName('nav-link');

/* ON LOAD... *****************************************************************/
window.onload = function(e){

	// Apply animations
    applyAnimations();

	// Home only
	if( document.body.classList.contains('page-home') ){
		// Animated blob effect on portrait
		animateBlob();
	}

	// Home, Portfolio & Archives
	if( document.body.classList.contains('page-home') || document.body.classList.contains('page-portfolio') || document.body.classList.contains('page-archive') ){
		// Add event listeners to video thumbnails
		controlVideoThumbnails();
	}

};

/* ON SCROLL... ***************************************************************/
window.onscroll = function(e){

    // Apply animations
    applyAnimations();

	// Add or remove the 'scrolled' class, based on scroll position
	if( window.scrollY > 50 ){
		document.body.classList.add('scrolled');
	} else {
		document.body.classList.remove('scrolled');
	}

};

/* ON RESIZE... ***************************************************************/
window.onresize = function(e){

	// Add/Remove mobile menu toggle, based on viewport width
	let vw = Math.max(document.documentElement.clientWidth || 0, window.innerWidth || 0);
	for(let navLink of navLinks){
		if(vw < 768){
			navLink.addEventListener('click', toggleNav);
		} else {
			document.body.classList.remove('menu-open');
			navLink.removeEventListener('click', toggleNav);
		}
	}
};

/* isScrolledIntoView *********************************************************
	Returns true if a given Element is anywhere inside the viewport 
	Based on https://stackoverflow.com/a/22480938/6853842 */

function isScrolledIntoView(el) {
	var rect = el.getBoundingClientRect();
    var elemTop = rect.top;
    var elemBottom = rect.bottom;
    var isVisible = elemTop < window.innerHeight && elemBottom >= 0;
    return isVisible;
}

/* applyAnimations ************************************************************
	Applies animation class to an Element */

function applyAnimations(){
	var animatedElements = document.getElementsByClassName('animated');
	for(const animatedElement of animatedElements){
		if(isScrolledIntoView(animatedElement)){
			var animation = animatedElement.getAttribute('data-animation');
            animatedElement.classList.add( animation );
		}	
	}
}

/* PORTFOLIO VIDEO THUMBNAILS *****************************************************
	Play Portfolio Items' video thumbnails on hover */

let videoPortfolioItems = document.querySelectorAll('.portfolio-item.has-video');
function controlVideoThumbnails () {
	for(let videoPortfolioItem of videoPortfolioItems){
		let video = videoPortfolioItem.querySelector('.thumbnail-video');
		videoPortfolioItem.addEventListener('mouseenter', function(){
			video.play();
		});
		videoPortfolioItem.addEventListener('mouseleave', function(){
			var playPromise = video.play();
			if (playPromise !== undefined) {
				playPromise.then(_ => {
				  video.pause();
				  video.currentTime = 0;
				})
				.catch(error => {
					console.error(error);
				});
			}
		});
	}
}

/* GLIGHTBOX ***********************************************************************
	https://biati-digital.github.io/glightbox/ */

/* Isolate to Single Portfolio Item Pages */
if( document.body.classList.contains('page-portfolio-item') ){
	const lightbox = GLightbox({
		openEffect: 'fade',
		closeEffect: 'fade',
		closeButton: true
	});
}
