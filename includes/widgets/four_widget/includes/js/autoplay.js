jQuery(document).ready(function ($) {
  var x = $("audio#myAudio");
  if (x.length) {
    // window.scrollTo(0, 0);
    // disableScroll();
  }
  $("a#myAudioClick").click(function (e) {
    // e.preventDefault();

    var c = $(this).attr("hasclick");
    if (c === "0") {
      c = "1";
      // enableScroll();
      x.trigger("play");
    } else if (c === "1") {
      c = "0";

      x.trigger("pause");
    }

    $(this).attr("hasclick", c);
  });



});

function scrollmusic() {
  window.onscroll = function () {

  };
}

function disableScroll() {
  // Get the current page scroll position
  // scrollTop = window.pageYOffset || document.documentElement.scrollTop;
  // scrollLeft = window.pageXOffset || document.documentElement.scrollLeft,

  // if any scroll is attempted, set this to the previous value
  // window.onscroll = function () {
  // window.scrollTo(scrollLeft, scrollTop + 50);


  // };
  document.body.classList.add("stop-scrolling");
}

function enableScroll() {
  // window.onscroll = function () { };
  document.body.classList.remove("stop-scrolling");
}
