<!--wordpress files-->
<?php wp_footer() ?>
<!-- /wordpress files-->
<script src="<?php echo get_template_directory_uri() ?>/client/dist/vendor.js"></script>

<!--async load app-->
<script type="text/javascript">
function appendScript(src) {
  var element = document.createElement("script");
  element.src = src;
  document.body.appendChild(element);
}

function downloadJS (){
  [
    "<?php echo get_template_directory_uri() ?>/client/dist/client.js?v=<?php echo filemtime(get_template_directory() . '/client/dist/client.js') ?>"
  ]
  .forEach(function(src) {
    appendScript(src);
  });
}

if (window.addEventListener) {
  window.addEventListener("load", downloadJS, false);
} else if (window.attachEvent) {
  window.attachEvent("onload", downloadJS);
} else {
  window.onload = downloadJS;
}
</script>
<!--/async load app-->


<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.lazy/1.7.9/jquery.lazy.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.lazy/1.7.9/jquery.lazy.plugins.min.js"></script>
<script>
  var $ = jQuery;
  $(document).ready(function(){
    $('.project-item').lazy({
        // your configuration goes here
        scrollDirection: 'vertical',
        effect: 'fadeIn',
        visibleOnly: true,
        onError: function(element) {
            console.log('error loading ' + element.data('src'));
        }
    });
  })
</script>

</body>
</html>
