<?php if(backpack_auth()->check()): ?>
    <!-- Left side column. contains the sidebar -->
    <div class="<?php echo e(config('backpack.base.sidebar_class')); ?>">
      <!-- sidebar: style can be found in sidebar.less -->
      <nav class="sidebar-nav overflow-hidden">
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="nav">
          <!-- <li class="nav-title"><?php echo e(trans('backpack::base.administration')); ?></li> -->
          <!-- ================================================ -->
          <!-- ==== Recommended place for admin menu items ==== -->
          <!-- ================================================ -->

          <?php echo $__env->make(backpack_view('inc.sidebar_content'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

          <!-- ======================================= -->
          <!-- <li class="divider"></li> -->
          <!-- <li class="nav-title">Entries</li> -->
        </ul>
      </nav>
      <!-- /.sidebar -->
    </div>
<?php endif; ?>

<?php $__env->startPush('before_scripts'); ?>
  <script type="text/javascript">
    /* Recover sidebar state */
    if (Boolean(sessionStorage.getItem('sidebar-collapsed'))) {
      var body = document.getElementsByTagName('body')[0];
      body.className = body.className.replace('sidebar-lg-show', '');
    }

    /* Store sidebar state */
    var navbarToggler = document.getElementsByClassName("navbar-toggler");
    for (var i = 0; i < navbarToggler.length; i++) {
      navbarToggler[i].addEventListener('click', function(event) {
        event.preventDefault();
        if (Boolean(sessionStorage.getItem('sidebar-collapsed'))) {
          sessionStorage.setItem('sidebar-collapsed', '');
        } else {
          sessionStorage.setItem('sidebar-collapsed', '1');
        }
      });
    }
  </script>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('after_scripts'); ?>
  <script>
      // Set active state on menu element
      var full_url = "<?php echo e(Request::fullUrl()); ?>";
      var $navLinks = $(".sidebar-nav li a, .app-header li a");

      // First look for an exact match including the search string
      var $curentPageLink = $navLinks.filter(
          function() { return $(this).attr('href') === full_url; }
      );

      // If not found, look for the link that starts with the url
      if(!$curentPageLink.length > 0){
          $curentPageLink = $navLinks.filter( function() {
            if ($(this).attr('href').startsWith(full_url)) {
              return true;
            }

            if (full_url.startsWith($(this).attr('href'))) {
              return true;
            }

            return false;
          });
      }

      // for the found links that can be considered current, make sure 
      // - the parent item is open
      $curentPageLink.parents('li').addClass('open');
      // - the actual element is active
      $curentPageLink.each(function() {
        $(this).addClass('active');
      });
  </script>
<?php $__env->stopPush(); ?>
<?php /**PATH C:\Users\Atanas\Desktop\Project\MovieDatabase\vendor\backpack\crud\src\resources\views\base/inc/sidebar.blade.php ENDPATH**/ ?>