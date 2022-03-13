"use strict";

$("[data-checkboxes]").each(function () {
  var me = $(this),
    group = me.data('checkboxes'),
    role = me.data('checkbox-role');

  me.change(function () {
    var all = $('[data-checkboxes="' + group + '"]:not([data-checkbox-role="dad"])'),
      checked = $('[data-checkboxes="' + group + '"]:not([data-checkbox-role="dad"]):checked'),
      dad = $('[data-checkboxes="' + group + '"][data-checkbox-role="dad"]'),
      total = all.length,
      checked_length = checked.length;

    if (role == 'dad') {
      if (me.is(':checked')) {
        all.prop('checked', true);
      } else {
        all.prop('checked', false);
      }
    } else {
      if (checked_length >= total) {
        dad.prop('checked', true);
      } else {
        dad.prop('checked', false);
      }
    }
  });
});

$("#table-1").dataTable({
  "columnDefs": [{
    "sortable": false,
    "targets": [2, 3]
  }],
  "drawCallback": $(function () {
    $('[data-toggle="tooltip"]').tooltip()
  })
});

$("#barang-temuan").dataTable({
  "columnDefs": [{
    "sortable": false,
    "targets": [4, 5]
  }],
  "drawCallback": $(function () {
    $('[data-toggle="tooltip"]').tooltip()
  })
});

$("#barang-temuan-takmir").dataTable({
  "columnDefs": [{
    "sortable": false,
    "targets": [3, 4]
  }],
  "drawCallback": $(function () {
    $('[data-toggle="tooltip"]').tooltip()
  })
});

$("#table-2").dataTable({
  "columnDefs": [{
    "sortable": false,
    "targets": [0, 2, 3]
  }]
});
$("#table-manajemen-user").dataTable({
  "columnDefs": [{
    "sortable": false,
    "targets": [5]
  }]
});
$("#table-manajemen-jabatan").dataTable({
  "columnDefs": [{
    "sortable": false,
    "targets": [2]
  }]
});
$("#table-manajemen-kategori").dataTable({
  "columnDefs": [{
    "sortable": false,
    "targets": [2, 3]
  }]
});
$("#table-manajemen-kategori-masjid").dataTable({
  "columnDefs": [{
    "sortable": false,
    "targets": [2]
  }]
});
$("#table-manajemen-masjid").dataTable({
  "columnDefs": [{
    "sortable": false,
    "targets": [4, 5]
  }]
});
$("#table-riwayat-klaim").dataTable({
  "columnDefs": [{
    "sortable": false,
    "targets": [3, 4]
  }]
});
$("#table-manajemen-dataklaim").dataTable({
  "columnDefs": [{
    "sortable": false,
    "targets": [4]
  }]
});
$("#table-manajemen-supplier").dataTable({
  "columnDefs": [{
    "sortable": false,
    "targets": [3, 5, 6]
  }],
  "bFilter": false
});

$("#table-manajemen-barang").dataTable({
  "columnDefs": [{
    "sortable": false,
    "targets": [7]
  }],
  "bFilter": false
});