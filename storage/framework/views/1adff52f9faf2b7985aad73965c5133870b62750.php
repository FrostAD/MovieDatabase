  <!-- DATA TABLES SCRIPT -->
  <script type="text/javascript" src="<?php echo e(asset('packages/datatables.net/js/jquery.dataTables.min.js')); ?>"></script>
  <script type="text/javascript" src="<?php echo e(asset('packages/datatables.net-bs4/js/dataTables.bootstrap4.min.js')); ?>"></script>
  <script type="text/javascript" src="<?php echo e(asset('packages/datatables.net-responsive/js/dataTables.responsive.min.js')); ?>"></script>
  <script type="text/javascript" src="<?php echo e(asset('packages/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')); ?>"></script>
  <script type="text/javascript" src="<?php echo e(asset('packages/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js')); ?>"></script>
  <script type="text/javascript" src="<?php echo e(asset('packages/datatables.net-fixedheader-bs4/js/fixedHeader.bootstrap4.min.js')); ?>"></script>

  <script>
    <?php if($crud->getPersistentTable()): ?>

        var saved_list_url = localStorage.getItem('<?php echo e(Str::slug($crud->getRoute())); ?>_list_url');

        //check if saved url has any parameter or is empty after clearing filters.

        if (saved_list_url && saved_list_url.indexOf('?') < 1) {
            var saved_list_url = false;
        }else{
            var persistentUrl = saved_list_url+'&persistent-table=true';
        }

    var arr =  window.location.href.split('?');
        //check if url has parameters.
        if (arr.length > 1 && arr[1] !== '') {
                // IT HAS! Check if it is our own persistence redirect.
                if (window.location.search.indexOf('persistent-table=true') < 1) {
                    // IF NOT: we don't want to redirect the user.
                    saved_list_url = false;
                }
        }

    <?php if($crud->getPersistentTableDuration()): ?>
        var saved_list_url_time = localStorage.getItem('<?php echo e(Str::slug($crud->getRoute())); ?>_list_url_time');

        if (saved_list_url_time) {
            var $current_date = new Date();
            var $saved_time = new Date(parseInt(saved_list_url_time));
            $saved_time.setMinutes($saved_time.getMinutes() + <?php echo e($crud->getPersistentTableDuration()); ?>);

            //if the save time is not expired we force the filter redirection.
            if($saved_time > $current_date) {
                if (saved_list_url && persistentUrl!=window.location.href) {
                    window.location.href = persistentUrl;
                }
            } else {
            //persistent table expired, let's not redirect the user
                saved_list_url = false;
            }
        }

    <?php endif; ?>
        if (saved_list_url && persistentUrl!=window.location.href) {
            window.location.href = persistentUrl;
        }
    <?php endif; ?>

    var crud = {
      exportButtons: JSON.parse('<?php echo json_encode($crud->get('list.export_buttons')); ?>'),
      functionsToRunOnDataTablesDrawEvent: [],
      addFunctionToDataTablesDrawEventQueue: function (functionName) {
          if (this.functionsToRunOnDataTablesDrawEvent.indexOf(functionName) == -1) {
          this.functionsToRunOnDataTablesDrawEvent.push(functionName);
        }
      },
      responsiveToggle: function(dt) {
          $(dt.table().header()).find('th').toggleClass('all');
          dt.responsive.rebuild();
          dt.responsive.recalc();
      },
      executeFunctionByName: function(str, args) {
        var arr = str.split('.');
        var fn = window[ arr[0] ];

        for (var i = 1; i < arr.length; i++)
        { fn = fn[ arr[i] ]; }
        fn.apply(window, args);
      },
      updateUrl : function (new_url) {
        url_start = "<?php echo e(url($crud->route)); ?>";
        url_end = new_url.replace(url_start, '');
        url_end = url_end.replace('/search', '');
        new_url = url_start + url_end;

        window.history.pushState({}, '', new_url);
        localStorage.setItem('<?php echo e(Str::slug($crud->getRoute())); ?>_list_url', new_url);
      },
      dataTableConfiguration: {

        <?php if($crud->getResponsiveTable()): ?>
        responsive: {
            details: {
                display: $.fn.dataTable.Responsive.display.modal( {
                    header: function ( row ) {
                        // show the content of the first column
                        // as the modal header
                        // var data = row.data();
                        // return data[0];
                        return '';
                    }
                } ),
                renderer: function ( api, rowIdx, columns ) {

                  var data = $.map( columns, function ( col, i ) {
                      var columnHeading = crud.table.columns().header()[col.columnIndex];

                      // hide columns that have VisibleInModal false
                      if ($(columnHeading).attr('data-visible-in-modal') == 'false') {
                        return '';
                      }

                      return '<tr data-dt-row="'+col.rowIndex+'" data-dt-column="'+col.columnIndex+'">'+
                                '<td style="vertical-align:top; border:none;"><strong>'+col.title.trim()+':'+'<strong></td> '+
                                '<td style="padding-left:10px;padding-bottom:10px; border:none;">'+col.data+'</td>'+
                              '</tr>';
                  } ).join('');

                  return data ?
                      $('<table class="table table-striped mb-0">').append( '<tbody>' + data + '</tbody>' ) :
                      false;
                },
            }
        },
        fixedHeader: true,
        <?php else: ?>
        responsive: false,
        scrollX: true,
        <?php endif; ?>

        <?php if($crud->getPersistentTable()): ?>
        stateSave: true,
        /*
            if developer forced field into table 'visibleInTable => true' we make sure when saving datatables state
            that it reflects the developer decision.
        */

        stateSaveParams: function(settings, data) {

            localStorage.setItem('<?php echo e(Str::slug($crud->getRoute())); ?>_list_url_time', data.time);

            data.columns.forEach(function(item, index) {
                var columnHeading = crud.table.columns().header()[index];
                if ($(columnHeading).attr('data-visible-in-table') == 'true') {
                    return item.visible = true;
                }
            });
        },
        <?php if($crud->getPersistentTableDuration()): ?>
        stateLoadParams: function(settings, data) {
            var $saved_time = new Date(data.time);
            var $current_date = new Date();

            $saved_time.setMinutes($saved_time.getMinutes() + <?php echo e($crud->getPersistentTableDuration()); ?>);

            //if the save time as expired we force datatabled to clear localStorage
            if($saved_time < $current_date) {
                if (localStorage.getItem('<?php echo e(Str::slug($crud->getRoute())); ?>_list_url')) {
                    localStorage.removeItem('<?php echo e(Str::slug($crud->getRoute())); ?>_list_url');
                }
                if (localStorage.getItem('<?php echo e(Str::slug($crud->getRoute())); ?>_list_url_time')) {
                    localStorage.removeItem('<?php echo e(Str::slug($crud->getRoute())); ?>_list_url_time');
                }
               return false;
            }
        },
        <?php endif; ?>
        <?php endif; ?>
        autoWidth: false,
        pageLength: <?php echo e($crud->getDefaultPageLength()); ?>,
        lengthMenu: <?php echo json_encode($crud->getPageLengthMenu(), 15, 512) ?>,
        /* Disable initial sort */
        aaSorting: [],
        language: {
              "emptyTable":     "<?php echo e(trans('backpack::crud.emptyTable')); ?>",
              "info":           "<?php echo e(trans('backpack::crud.info')); ?>",
              "infoEmpty":      "<?php echo e(trans('backpack::crud.infoEmpty')); ?>",
              "infoFiltered":   "<?php echo e(trans('backpack::crud.infoFiltered')); ?>",
              "infoPostFix":    "<?php echo e(trans('backpack::crud.infoPostFix')); ?>",
              "thousands":      "<?php echo e(trans('backpack::crud.thousands')); ?>",
              "lengthMenu":     "<?php echo e(trans('backpack::crud.lengthMenu')); ?>",
              "loadingRecords": "<?php echo e(trans('backpack::crud.loadingRecords')); ?>",
              "processing":     "<img src='<?php echo e(asset('packages/backpack/crud/img/ajax-loader.gif')); ?>' alt='<?php echo e(trans('backpack::crud.processing')); ?>'>",
              "search": "_INPUT_",
              "searchPlaceholder": "<?php echo e(trans('backpack::crud.search')); ?>...",
              "zeroRecords":    "<?php echo e(trans('backpack::crud.zeroRecords')); ?>",
              "paginate": {
                  "first":      "<?php echo e(trans('backpack::crud.paginate.first')); ?>",
                  "last":       "<?php echo e(trans('backpack::crud.paginate.last')); ?>",
                  "next":       ">",
                  "previous":   "<"
              },
              "aria": {
                  "sortAscending":  "<?php echo e(trans('backpack::crud.aria.sortAscending')); ?>",
                  "sortDescending": "<?php echo e(trans('backpack::crud.aria.sortDescending')); ?>"
              },
              "buttons": {
                  "copy":   "<?php echo e(trans('backpack::crud.export.copy')); ?>",
                  "excel":  "<?php echo e(trans('backpack::crud.export.excel')); ?>",
                  "csv":    "<?php echo e(trans('backpack::crud.export.csv')); ?>",
                  "pdf":    "<?php echo e(trans('backpack::crud.export.pdf')); ?>",
                  "print":  "<?php echo e(trans('backpack::crud.export.print')); ?>",
                  "colvis": "<?php echo e(trans('backpack::crud.export.column_visibility')); ?>"
              },
          },
          processing: true,
          serverSide: true,
          searching: <?php echo json_encode($crud->getOperationSetting('searchableTable') ?? true, 15, 512) ?>,
          ajax: {
              "url": "<?php echo url($crud->route.'/search').'?'.Request::getQueryString(); ?>",
              "type": "POST"
          },
          dom:
            "<'row hidden'<'col-sm-6'i><'col-sm-6 d-print-none'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row mt-2 d-print-none '<'col-sm-12 col-md-4'l><'col-sm-0 col-md-4 text-center'B><'col-sm-12 col-md-4 'p>>",
      }
  }
  </script>

  <?php echo $__env->make('crud::inc.export_buttons', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

  <script type="text/javascript">
    jQuery(document).ready(function($) {

      crud.table = $("#crudTable").DataTable(crud.dataTableConfiguration);

      // move search bar
      $("#crudTable_filter").appendTo($('#datatable_search_stack' ));
      $("#crudTable_filter input").removeClass('form-control-sm');

      // move "showing x out of y" info to header
      $("#datatable_info_stack").html($('#crudTable_info')).css('display','inline-flex').addClass('animated fadeIn');

      <?php if($crud->getOperationSetting('resetButton') ?? true): ?>
        // create the reset button
        var crudTableResetButton = '<a href="<?php echo e(url($crud->route)); ?>" class="ml-1" id="crudTable_reset_button"><?php echo e(trans('backpack::crud.reset')); ?></a>';

        $('#datatable_info_stack').append(crudTableResetButton);

          // when clicking in reset button we clear the localStorage for datatables.
        $('#crudTable_reset_button').on('click', function() {

          //clear the filters
          if (localStorage.getItem('<?php echo e(Str::slug($crud->getRoute())); ?>_list_url')) {
              localStorage.removeItem('<?php echo e(Str::slug($crud->getRoute())); ?>_list_url');
          }
          if (localStorage.getItem('<?php echo e(Str::slug($crud->getRoute())); ?>_list_url_time')) {
              localStorage.removeItem('<?php echo e(Str::slug($crud->getRoute())); ?>_list_url_time');
          }

          //clear the table sorting/ordering/visibility
          if(localStorage.getItem('DataTables_crudTable_/<?php echo e($crud->getRoute()); ?>')) {
              localStorage.removeItem('DataTables_crudTable_/<?php echo e($crud->getRoute()); ?>');
          }
        });
      <?php endif; ?>

      // move the bottom buttons before pagination
      $("#bottom_buttons").insertBefore($('#crudTable_wrapper .row:last-child' ));

      // override ajax error message
      $.fn.dataTable.ext.errMode = 'none';
      $('#crudTable').on('error.dt', function(e, settings, techNote, message) {
          new Noty({
              type: "error",
              text: "<strong><?php echo e(trans('backpack::crud.ajax_error_title')); ?></strong><br><?php echo e(trans('backpack::crud.ajax_error_text')); ?>"
          }).show();
      });

      // make sure AJAX requests include XSRF token
      $.ajaxPrefilter(function(options, originalOptions, xhr) {
          var token = $('meta[name="csrf_token"]').attr('content');

          if (token) {
                return xhr.setRequestHeader('X-XSRF-TOKEN', token);
          }
      });

      // on DataTable draw event run all functions in the queue
      // (eg. delete and details_row buttons add functions to this queue)
      $('#crudTable').on( 'draw.dt',   function () {
         crud.functionsToRunOnDataTablesDrawEvent.forEach(function(functionName) {
            crud.executeFunctionByName(functionName);
         });
      } ).dataTable();

      // when datatables-colvis (column visibility) is toggled
      // rebuild the datatable using the datatable-responsive plugin
      $('#crudTable').on( 'column-visibility.dt',   function (event) {
         crud.table.responsive.rebuild();
      } ).dataTable();

      <?php if($crud->getResponsiveTable()): ?>
        // when columns are hidden by reponsive plugin,
        // the table should have the has-hidden-columns class
        crud.table.on( 'responsive-resize', function ( e, datatable, columns ) {
            if (crud.table.responsive.hasHidden()) {
              $("#crudTable").removeClass('has-hidden-columns').addClass('has-hidden-columns');
             } else {
              $("#crudTable").removeClass('has-hidden-columns');
             }
        } );
      <?php else: ?>
        // make sure the column headings have the same width as the actual columns
        // after the user manually resizes the window
        var resizeTimer;
        function resizeCrudTableColumnWidths() {
          clearTimeout(resizeTimer);
          resizeTimer = setTimeout(function() {
            // Run code here, resizing has "stopped"
            crud.table.columns.adjust();
          }, 250);
        }
        $(window).on('resize', function(e) {
          resizeCrudTableColumnWidths();
        });
        $(document).on('expanded.pushMenu', function(e) {
          resizeCrudTableColumnWidths();
        });
        $(document).on('collapsed.pushMenu', function(e) {
          resizeCrudTableColumnWidths();
        });
      <?php endif; ?>

    });
  </script>

  <?php echo $__env->make('crud::inc.details_row_logic', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH C:\Users\Atanas\Desktop\Project\MovieDatabase\vendor\backpack\crud\src\resources\views\crud/inc/datatables_logic.blade.php ENDPATH**/ ?>