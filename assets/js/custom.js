
"use strict";

var table, table_all, table_mdl

// init base_url
function base_url() {
    var pathparts = location.pathname.split('/');
    if (location.host == 'localhost' || location.host == '127.0.0.1') {
        var url = location.origin + '/' + pathparts[1].trim('/') + '/';
    } else {
        var url = location.origin;
    }
    return url;
}

$(function () {

    if (!$().DataTable) {
        console.warn('Warning - datatables.min.js is not loaded.');
        return;
    }

    $.extend($.fn.dataTable.defaults, {
        autoWidth: false,
        // dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',
        language: {
            search: '<span>Pencarian:</span> _INPUT_',
            searchPlaceholder: 'Kata kunci...',
            lengthMenu: '<span>Tampil:</span> _MENU_',
            // paginate: {
            //     'first': 'Pertama',
            //     'last': 'Terakhir',
            //     'next': $('html').attr('dir') == 'rtl' ? '&larr;' : '&rarr;',
            //     'previous': $('html').attr('dir') == 'rtl' ? '&rarr;' : '&larr;'
            // }
        }
    })

    // $('.dataTables_length select').select2({
    //     minimumResultsForSearch: Infinity,
    //     dropdownAutoWidth: true,
    //     width: 'auto'
    // })

    table = $('#presensi-table').DataTable({
        processing: true,
        serverSide: true,
        deferRender: true,
        responsive: true,
        pageLength: 10,
        paging: true,
        searching: true,
        ordering: true,
        info: true,
        autoWidth: false,
        ajax: {
            url: base_url() + '/profile/dt_profile',
            type: 'POST',
            data: function (d) {
                // d.edit_priv = "<?= $privileges[1]; ?>";
                // d.delete_priv = "<?= $privileges[2]; ?>";
                // d.kode = $('#kode').val();
            }
        },
        columns: [{
            data: 'no',
            name: 'no',
            class: 'text-center'
        },
        {
            data: 'tanggal',
            name: 'tanggal'
        },
        {
            data: 'status',
            name: 'status',
        },
        {
            data: 'tipe',
            name: 'tipe',
        },
        {
            data: 'waktu_absen',
            name: 'waktu_absen'
        },
        {
            data: 'kondisi',
            name: 'kondisi',
            class: 'text-center',
            render: function (data, type, row) {
                var res
                if (data == "Tidak Sehat") {
                    res = '<a class="badge badge-warning btn-sakit" href="javascript:void(0)" data-id="' + row.id + '"><i class="fa fa-external-link-alt"></i> ' + data + '</a>'
                } else if (data == "Sehat") {
                    res = '<a class="badge badge-primary text-white">' + data + '</a>'
                } else {
                    res = "-"
                }
                return res
            }
        },
            {
                data: 'keterangan',
                name: 'keterangan',
                class: 'text-center',
				render: function (data, type, row) {
					var res
					if (data == "Diluar Zona") {
						res = '<span class="badge badge-danger">' + data + '</span>'
					} else if (data == "Didalam Zona") {
						res = '<span class="badge badge-success">' + data + '</span>'
					} else {
						res = data
					}
					return res
				}
            },
        ],
        columnDefs: [{
            // 'sortable': false,
            // 'searchable': false,
            // 'targets': [0, -1]
        }],
        order: [
            [1, 'desc']
        ]
    })

    table_all = $('#presensi-all-table').DataTable({
        processing: true,
        serverSide: true,
        deferRender: true,
        responsive: true,
        pageLength: 10,
        paging: true,
        searching: true,
        ordering: true,
        info: true,
        autoWidth: false,
        ajax: {
            url: base_url() + '/admin/dt_presensi_all',
            type: 'POST',
            data: function (d) {
                // d.edit_priv = "<?= $privileges[1]; ?>";
                // d.delete_priv = "<?= $privileges[2]; ?>";
                d.start = $('#mulai').val();
                d.end = $('#akhir').val();
            }
        },
        columns: [{
            data: 'no',
            name: 'no',
            class: 'text-center'
        },
        {
            data: 'tanggal',
            name: 'tanggal'
        },
        {
            data: 'name',
            name: 'name'
        },
        {
            data: 'status',
            name: 'status',
            // render: function (data, type, row) {
            //     return (row.status == 1)
            //         ? 'WFO'
            //         : 'WFH'
            // }
        },
        {
            data: 'tipe',
            name: 'tipe',
        },
        {
            data: 'waktu_absen',
            name: 'waktu_absen'
        },
        {
            data: 'kondisi',
            name: 'kondisi',
            class: 'text-center',
            render: function (data, type, row) {
                var res
                if (data == "Tidak Sehat") {
                    res = '<a class="badge badge-warning btn-sakit" href="javascript:void(0)" data-id="' + row.id + '">' + data + '</a>'
                } else if (data == "Sehat") {
                    res = '<a class="badge badge-primary text-white">' + data + '</a>'
                } else {
                    res = "-"
                }
                return res
            }
        },
            // {
            //     data: 'aksi',
            //     name: 'aksi',
            //     class: 'text-center'
            // },
        ],
        columnDefs: [{
            'sortable': false,
            'searchable': false,
            'targets': [0]
        }],
        order: [
            [1, 'desc']
        ]
    })

    table_all.on('draw.dt', function () {
        var info_all = table_all.page.info();
        table_all.column(0, {
            search: 'applied',
            order: 'applied',
            page: 'applied'
        }).nodes().each(function (cell, i) {
            cell.innerHTML = i + 1 + info_all.start;
        })
    })
    table.on('draw.dt', function () {
        var info_all = table.page.info();
        table.column(0, {
            search: 'applied',
            order: 'applied',
            page: 'applied'
        }).nodes().each(function (cell, i) {
            cell.innerHTML = i + 1 + info_all.start;
        })
    })


    table_mdl = $('#tbl-keluhan').DataTable({
        processing: true,
        serverSide: true,
        deferRender: true,
        responsive: true,
        pageLength: 10,
        paging: true,
        searching: true,
        ordering: true,
        info: true,
        autoWidth: false,
        ajax: {
            url: base_url() + '/profile/dt_keluhan',
            type: 'POST',
            data: function (d) {
                // d.edit_priv = "<?= $privileges[1]; ?>";
                // d.delete_priv = "<?= $privileges[2]; ?>";
                d.kode = $('#kode').val();
            }
        },
        columns: [
            {
                data: 'no',
                name: 'no',
                class: 'text-center'
            },
            {
                data: 'keluhan',
                name: 'keluhan',
            },
            // {
            //     data: 'aksi',
            //     name: 'aksi',
            //     class: 'text-center'
            // }
        ],
        columnDefs: [
            {
                'sortable': false,
                'searchable': false,
                'targets': [0, -1]
            }
        ],
        order: [
            [1, 'desc']
        ]
    })

    table_mdl.on('draw.dt', function () {
        var info = table_mdl.page.info();
        table_mdl.column(0, {
            search: 'applied',
            order: 'applied',
            page: 'applied'
        }).nodes().each(function (cell, i) {
            cell.innerHTML = i + 1 + info.start;
        })
    })

    $('.modal').on('hidden.bs.modal', function () {
        // $(this).find('form').trigger('reset');
        $('#kode').val('')
    })

    $('#presensi-all-table')
        .delegate('a.btn-sakit', 'click', function (e) {
            e.preventDefault()
            var that = $(this)
            $('#kode').val(that.data('id'))
            table_mdl.ajax.reload()
            $("#mdl-sakit").modal()
            $("#mdl-sakit .modal-title").html('Lihat Keluhan')
        })

    $('#presensi-table')
        .delegate('a.btn-sakit', 'click', function (e) {
            e.preventDefault()
            var that = $(this)
            $('#kode').val(that.data('id'))
            table_mdl.ajax.reload()
            $("#mdl-sakit").modal()
            $("#mdl-sakit .modal-title").html('Lihat Keluhan')
        })

    $('.datepicker').daterangepicker({
        locale: { format: 'YYYY-MM-DD' },
        singleDatePicker: true,
        // startDate: moment().startOf('hour'),
        endDate: moment(),
        showDropdowns: true,
    });

    // $("#btn-filter").click(function (e) {
    //     var start = $('#start-date').val();
    //     var end = $('#end-date').val();
    //     $('#mulai').val(start);
    //     $('#akhir').val(end);
    //     table_all.ajax.reload();
    // });

});
