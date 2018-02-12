<!doctype html>
<html>
<head>
  <script src="../jquery/jquery.min.js"></script>

</style>
</head>
<body>
  <div class="mobile-nav">
     <div class="menu-btn" id="menu-btn">
	<div></div>
	<span></span>
	<span></span>
	<span></span>
     </div>

     <div class="responsive-menu">
        <ul>
           <li>1. Object</li>
           <li>2. Object</li>
        </ul>
     </div>
</div>
<script type="text/javascript">
jQuery(function($){
    $( '.menu-btn' ).click(function(){
      $('.responsive-menu').addClass('expand')
      $('.menu-btn').addClass('btn-none')
    })

     $( '.close-btn' ).click(function(){
      $('.responsive-menu').removeClass('expand')
      $('.menu-btn').removeClass('btn-none')
    })
  })
</script>
<script type="text/javascript">
	jQuery(function($){
    	     $( '.menu-btn' ).click(function(){
    	     $('.responsive-menu').toggleClass('expand')
    	     })
        })
</script>
</body>
</html>
