var button = $('#toggle'),
  close = $('#close'),
  menuPanel = $('.menuPanel'),
  startPoints = $('#start').attr('d'),
  middlePoints = $('#middle').attr('d'),
  endPoints = $('#end').attr('d'),
  menu = $('.menu')

var tlIn = gsap.timeline({ paused: true })
var tlOut = gsap.timeline({ paused: true })

tlIn
  .to(
    '.menuPanel',
    {
      x: 0,
      duration: 0.9,
      ease: Power3.easeInOut,
      onStart: function () {
        isAnimating = true
      },
    },
    0
  )
  .to(
    '#start',
    {
      attr: { d: middlePoints },
      duration: 0.2,
      ease: Elastic.easeInOut,
    },
    0
  )
  .addLabel('rectangleStart', '>')
  .to(
    '.menu li',
    {
      x: 0,
      opacity: 1,
      delay: 0.2,
      stagger: {
        each: 0.1,
      },
    },
    0
  )
  .to(
    '#start',
    {
      attr: { d: startPoints },
      duration: 0.7,
      ease: Elastic.easeInOut,
      onComplete: function () {
        isAnimating = false
        $('body, html').addClass('open')
      },
    },
    'rectangleStart'
  )

tlOut
  .to(
    '.menuPanel',
    {
      x: '100%',
      duration: 0.7,
      ease: Power3.easeInOut,
      onStart: function () {
        isAnimating = true
      },
    },
    0
  )
  .to(
    '#start',
    {
      attr: { d: endPoints },
      duration: 0.2,
      ease: Power3.easeIn,
    },
    0
  )
  .to(
    '#start',
    {
      attr: { d: startPoints },
      duration: 0.5,
      ease: Power3.easeInOut,
      onComplete: function () {
        isAnimating = false
        $('body, html').removeClass('open')
      },
    },
    '>'
  )

var isAnimating = false

button.on('click touchend', function () {
  if (isAnimating) {
    return
  }
  if (!$('body').hasClass('open')) {
    tlIn.restart()
  }
})

close.on('click touchend', function () {
  if ($('body').hasClass('open')) {
    $('body, html').removeClass('open')
    tlOut.restart()
  }
})

$('.play-btn').on('click touchend', function () {
  $('.video-popup').addClass('active-popup')
})

$('.close-popup').on('click touchend', function () {
  var yochiVid = $('.video-popup iframe').attr('src')
  $('.video-popup iframe').attr('src', yochiVid)
  $('.video-popup').removeClass('active-popup')
})

$('#menu-main-menu .menu-item-has-children > a').on('click touchend', function () {
	$('#menu-main-menu .menu-item-has-children a').removeClass('active')
	$(this).addClass('active')
})																				   
