<nav class="navbar navbar-expand-lg navbar-filters mb-0 pb-0 pt-0">
      <!-- Brand and toggle get grouped for better mobile display -->
      <a class="nav-item d-none d-lg-block"><span class="la la-filter"></span></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#bp-filters-navbar" aria-controls="bp-filters-navbar" aria-expanded="false" aria-label="<?php echo e(trans('backpack::crud.toggle_filters')); ?>">
        <span class="la la-filter"></span> <?php echo e(trans('backpack::crud.filters')); ?>

      </button>

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bp-filters-navbar">
        <ul class="nav navbar-nav">
          <!-- THE ACTUAL FILTERS -->
    			<?php $__currentLoopData = $crud->filters(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $filter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    				<?php echo $__env->make($filter->getViewWithNamespace(), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          <li class="nav-item"><a href="#" id="remove_filters_button" class="nav-link <?php echo e(count(Request::input()) != 0 ? '' : 'invisible'); ?>"><i class="la la-eraser"></i> <?php echo e(trans('backpack::crud.remove_filters')); ?></a></li>
        </ul>
      </div><!-- /.navbar-collapse -->
  </nav>

<?php $__env->startPush('crud_list_scripts'); ?>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/URI.js/1.18.2/URI.min.js" type="text/javascript"></script>
    <script>
      function addOrUpdateUriParameter(uri, parameter, value) {
            var new_url = normalizeAmpersand(uri);

            new_url = URI(new_url).normalizeQuery();

            // this param is only needed in datatables persistent url redirector
            // not when applying filters so we remove it.
            if (new_url.hasQuery('persistent-table')) {
                new_url.removeQuery('persistent-table');
            }

            if (new_url.hasQuery(parameter)) {
              new_url.removeQuery(parameter);
            }

            if (value !== '' && value != null) {
              new_url = new_url.addQuery(parameter, value);
            }

            $('#remove_filters_button').removeClass('invisible');

        return new_url.toString();

      }

      function normalizeAmpersand(string) {
        return string.replace(/&amp;/g, "&").replace(/amp%3B/g, "");
      }

      // button to remove all filters
      jQuery(document).ready(function($) {
      	$("#remove_filters_button").click(function(e) {
      		e.preventDefault();

		    	// behaviour for ajax table
		    	var new_url = '<?php echo e(url($crud->route.'/search')); ?>';
		    	var ajax_table = $("#crudTable").DataTable();

  				// replace the datatables ajax url with new_url and reload it
  				ajax_table.ajax.url(new_url).load();

  				// clear all filters
  				$(".navbar-filters li[filter-name]").trigger('filter:clear');

          // remove filters from URL
          crud.updateUrl(new_url);
      	});

        // hide the Remove filters button when no filter is active
        $(".navbar-filters li[filter-name]").on('filter:clear', function() {
          var anyActiveFilters = false;
          $(".navbar-filters li[filter-name]").each(function () {
            if ($(this).hasClass('active')) {
              anyActiveFilters = true;
              // console.log('ACTIVE FILTER');
            }
          });

          if (anyActiveFilters == false) {
            $('#remove_filters_button').addClass('invisible');
          }
        });
      });
    </script>
<?php $__env->stopPush(); ?>
<?php /**PATH C:\Users\Atanas\Desktop\Project\MovieDatabase\vendor\backpack\crud\src\resources\views\crud/inc/filters_navbar.blade.php ENDPATH**/ ?>