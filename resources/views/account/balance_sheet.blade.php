@extends('layout.main') @section('content')

<section class="forms">
    <div class="container-fluid">
        <h3>{{trans('file.Balance Sheet')}}</h3>
    </div>
    <div class="table-responsive mb-4">
        <table id="account-table" class="table table-hover">
            <thead>
                <tr>
                    <th class="not-exported"></th>
                    <th>{{trans('file.name')}}</th>
                    <th>{{trans('file.Account No')}}</th>
                    <th>{{trans('file.Credit')}}</th>
                    <th>{{trans('file.Debit')}}</th>
                    <th>{{trans('file.Balance')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($lims_account_list as $key=>$account)
                <tr>
                    <td>{{$key}}</td>
                    <td>{{$account->name}}</td>
                    <td>{{$account->account_no}}</td>
                    <td>{{number_format((float)$credit[$key],0, ',' , '.')}}</td>
                    <td>{{number_format((float)($debit[$key] * -1),0, ',' , '.')}}</td>
                    <td>{{number_format((float)($credit[$key] - $debit[$key]),0, ',' , '.')}}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot class="tfoot active">
                <th></th>
                <th>{{trans('file.Total')}}</th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
            </tfoot>
        </table>
    </div>
</section>

<script type="text/javascript">
    $("ul#account").siblings('a').attr('aria-expanded','true');
    $("ul#account").addClass("show");
    $("ul#account #balance-sheet-menu").addClass("active");
    var table = $('#account-table').DataTable( {
        "order": [],
        'language': {
            'lengthMenu': '_MENU_ {{trans("file.records per page")}}',
             "info":      '<small>{{trans("file.Showing")}} _START_ - _END_ (_TOTAL_)</small>',
            "search":  '{{trans("file.Search")}}',
            'paginate': {
                    'previous': '<i class="dripicons-chevron-left"></i>',
                    'next': '<i class="dripicons-chevron-right"></i>'
            }
        },
        'columnDefs': [
            {
                "orderable": false,
                'targets': 0
            },
            {
                'render': function(data, type, row, meta){
                    if(type === 'display'){
                        data = '<div class="checkbox"><input type="checkbox" class="dt-checkboxes"><label></label></div>';
                    }

                   return data;
                },
                'checkboxes': {
                   'selectRow': true,
                   'selectAllRender': '<div class="checkbox"><input type="checkbox" class="dt-checkboxes"><label></label></div>'
                },
                'targets': [0]
            }
        ],
        'select': { style: 'multi',  selector: 'td:first-child'},
        'lengthMenu': [[10, 25, 50, -1], [10, 25, 50, "All"]],
        dom: '<"row"lfB>rtip',
        buttons: [
            {
                extend: 'pdf',
                text: '{{trans("file.PDF")}}',
                exportOptions: {
                    columns: ':visible:Not(.not-exported)',
                    rows: ':visible'
                },
                action: function(e, dt, button, config) {
                    datatable_sum(dt, true);
                    $.fn.dataTable.ext.buttons.pdfHtml5.action.call(this, e, dt, button, config);
                    datatable_sum(dt, false);
                },
                footer:true
            },
            {
                extend: 'csv',
                text: '{{trans("file.CSV")}}',
                exportOptions: {
                    columns: ':visible:Not(.not-exported)',
                    rows: ':visible'
                },
                action: function(e, dt, button, config) {
                    datatable_sum(dt, true);
                    $.fn.dataTable.ext.buttons.pdfHtml5.action.call(this, e, dt, button, config);
                    datatable_sum(dt, false);
                },
                footer:true
            },
            {
                extend: 'print',
                text: '{{trans("file.Print")}}',
                exportOptions: {
                    columns: ':visible:Not(.not-exported)',
                    rows: ':visible'
                },
                action: function(e, dt, button, config) {
                    datatable_sum(dt, true);
                    $.fn.dataTable.ext.buttons.print.action.call(this, e, dt, button, config);
                    datatable_sum(dt, false);
                },
                footer:true
            },
            {
                extend: 'colvis',
                text: '{{trans("file.Column visibility")}}',
                columns: ':gt(0)'
            },
        ],
        drawCallback: function () {
            var api = this.api();
            datatable_sum(api, false);
        }
    } );

    function datatable_sum(dt_selector, is_calling_first) {
        if (dt_selector.rows( '.selected' ).any() && is_calling_first) {
            var rows = dt_selector.rows( '.selected' ).indexes();

            const data = dt_selector.cells( rows, 3, { page: 'current' } ).data();
            var dataSum =0 ;
            for(var i=0; i < data.length; i++) {
                dataSum += Number(data[i].replaceAll('.', '') == '' ? 0 : data[i].replaceAll('.', ''));
            }

            const data2 = dt_selector.cells( rows, 4, { page: 'current' } ).data();
            var dataSum2 =0 ;
            for(var i=0; i < data2.length; i++) {
                dataSum2 += Number(data2[i].replaceAll('.', '') == '' ? 0 : data2[i].replaceAll('.', ''));
            }

            const data3 = dt_selector.cells( rows, 5, { page: 'current' } ).data();
            var dataSum3 =0 ;
            for(var i=0; i < data3.length; i++) {
                dataSum3 += Number(data3[i].replaceAll('.', '') == '' ? 0 : data3[i].replaceAll('.', ''));
            }

            $( dt_selector.column( 3 ).footer() ).html(formatRupiah(dataSum));
            $( dt_selector.column( 4 ).footer() ).html(formatRupiah(dataSum2));
            $( dt_selector.column( 5 ).footer() ).html(formatRupiah(dataSum3));

            // $( dt_selector.column( 3 ).footer() ).html(dt_selector.cells( rows, 3, { page: 'current' } ).data().sum().toFixed(2));
            // $( dt_selector.column( 4 ).footer() ).html(dt_selector.cells( rows, 4, { page: 'current' } ).data().sum().toFixed(2));
            // $( dt_selector.column( 5 ).footer() ).html(dt_selector.cells( rows, 5, { page: 'current' } ).data().sum().toFixed(2));
        }
        else {
            const data = dt_selector.cells( rows, 3, { page: 'current' } ).data();
            var dataSum =0 ;
            for(var i=0; i < data.length; i++) {
                dataSum += Number(data[i].replaceAll('.', '') == '' ? 0 : data[i].replaceAll('.', ''));
            }

            const data2 = dt_selector.cells( rows, 4, { page: 'current' } ).data();
            var dataSum2 =0 ;
            for(var i=0; i < data2.length; i++) {
                dataSum2 += Number(data2[i].replaceAll('.', '') == '' ? 0 : data2[i].replaceAll('.', ''));
            }

            const data3 = dt_selector.cells( rows, 5, { page: 'current' } ).data();
            var dataSum3 =0 ;
            for(var i=0; i < data3.length; i++) {
                dataSum3 += Number(data3[i].replaceAll('.', '') == '' ? 0 : data3[i].replaceAll('.', ''));
            }
            $( dt_selector.column( 3 ).footer() ).html(formatRupiah(dataSum));
            $( dt_selector.column( 4 ).footer() ).html(formatRupiah(dataSum2));
            $( dt_selector.column( 5 ).footer() ).html(formatRupiah(dataSum3));

            // $( dt_selector.column( 3 ).footer() ).html(dt_selector.cells( rows, 3, { page: 'current' } ).data().sum().toFixed(2));
            // $( dt_selector.column( 4 ).footer() ).html(dt_selector.cells( rows, 4, { page: 'current' } ).data().sum().toFixed(2));
            // $( dt_selector.column( 5 ).footer() ).html(dt_selector.cells( rows, 5, { page: 'current' } ).data().sum().toFixed(2));
        }
    }

    function formatRupiah(angka, type){
        var number_string= '';
        var split= '';
        var sisa= '';
        var rupiah= '';
        var ribuan= '';
        if(angka.toString().includes("-")){
            var reverse = angka.toString().split('').reverse().join(''),
            ribuan = reverse.match(/\d{1,3}/g);
            ribuan = ribuan.join('.').split('').reverse().join('');
            return "-"+ribuan;
        }
        if(type == 'input'){
            number_string = angka.replace(/[^,\d]/g, '').toString(),
			split   		= number_string.split(',');
			sisa     		= split[0].length % 3;
			rupiah     		= split[0].substr(0, sisa);
			ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);
        }else{
             number_string = angka.toString();
			split   		= number_string.split(',');
			sisa     		= split[0].length % 3;
			rupiah     		= split[0].substr(0, sisa);
			ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);
        }
		    
 
			// tambahkan titik jika yang di input sudah menjadi angka ribuan
			if(ribuan){
				separator = sisa ? '.' : '';
				rupiah += separator + ribuan.join('.');
			}
 
			rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
			// return prefix == undefined || ? rupiah : (rupiah ? '' + rupiah : '');
            return (rupiah);
	}

</script>
@endsection