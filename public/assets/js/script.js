$(".sidebar-dropdown > a").click(function() {
  $(".sidebar-submenu").slideUp(200);
  if (
    $(this)
      .parent()
      .hasClass("active")
  ) {
    $(".sidebar-dropdown").removeClass("active");
    $(this)
      .parent()
      .removeClass("active");
  } else {
    $(".sidebar-dropdown").removeClass("active");
    $(this)
      .next(".sidebar-submenu")
      .slideDown(200);
    $(this)
      .parent()
      .addClass("active");
  }
});

$("#close-sidebar").click(function() {
    $(".page-wrapper").removeClass("toggled");
});
$("#show-sidebar").click(function() {
    $(".page-wrapper").addClass("toggled");
});


// Inventory JS


$('#latestsales').DataTable( {
    "paging":   false,
    "ordering": false,
    "info":     false,
    "searching": false
} );
$('#latestrequisition').DataTable( {
    "paging":   false,
    "ordering": false,
    "info":     false,
    "searching": false
} );
$('#latestpurchase').DataTable( {
    "paging":   false,
    "ordering": false,
    "info":     false,
    "searching": false
} );
$('#latesttransfers').DataTable( {
    "paging":   false,
    "ordering": false,
    "info":     false,
    "searching": false
} );
$('#latestcustomers').DataTable( {
    "paging":   false,
    "ordering": false,
    "info":     false,
    "searching": false
} );
$('#latestsuppliers').DataTable( {
    "paging":   false,
    "ordering": false,
    "info":     false,
    "searching": false
} );

// Setup - add a text input to each footer cell
$('#item-table thead tr#filterrow th').each( function () {
    var title = $('#item-table thead th').eq( $(this).index() ).text();
    $(this).html( '<input type="text" onclick="stopPropagation(event);" placeholder="Search '+title+'" />' );
} );
 
    // DataTable
var table = $('#item-table').DataTable( {
    orderCellsTop: true  
} );
     
// Apply the filter
$("#item-table thead input").on( 'keyup change', function () {
    table
        .column( $(this).parent().index()+':visible' )
        .search( this.value )
        .draw();
} );

function stopPropagation(evt) {
    if (evt.stopPropagation !== undefined) {
        evt.stopPropagation();
    } else {
        evt.cancelBubble = true;
    }
}
$('#adjustment-list').DataTable();
$('#stock-history').DataTable();
$('#dept-list').DataTable();
$('#unit-list').DataTable();
$('#store-list').DataTable();
$('#category-list').DataTable();
$('#subCat-list').DataTable();
$('#vendors-list').DataTable();
$('#users-list').DataTable();

// Setup - add a text input to each footer cell
$('#promotion-history thead tr#promotionfilterrow th').each( function () {
    var title = $('#promotion-history thead th').eq( $(this).index() ).text();
    $(this).html( '<input type="text" onclick="stopPropagation(event);" placeholder="Search '+title+'" />' );
} );
 
    // DataTable
var table = $('#promotion-history').DataTable( {
    orderCellsTop: true  
} );
     
// Apply the filter
$("#promotion-history thead input").on( 'keyup change', function () {
    table
        .column( $(this).parent().index()+':visible' )
        .search( this.value )
        .draw();
} );

function stopPropagation(evt) {
    if (evt.stopPropagation !== undefined) {
        evt.stopPropagation();
    } else {
        evt.cancelBubble = true;
    }
}

// Damage list table
$('#damage-list tfoot th').each( function () {
    var title = $(this).text();
    $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
} );

// DataTable
var table = $('#damage-list').DataTable();

// Apply the search
table.columns().every( function () {
    var that = this;

    $( 'input', this.footer() ).on( 'keyup change clear', function () {
        if ( that.search() !== this.value ) {
            that
                .search( this.value )
                .draw();
        }
    } );
} );

$('.supplier-select').select2();
$('.item-select').select2({
    placeholder: "Select an item"
});
$('.location-select').select2();
$('.store-select').select2({
    placeholder: "Select location"
});

$.datetimepicker.setLocale('en-USA');
$('#datetimepicker').datetimepicker();

$('input[name="promotion-range"]').daterangepicker();
$('input[name="anatomy-range"]').daterangepicker();

//Profile image
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#imagePreview').css('background-image', 'url('+e.target.result +')');
            $('#imagePreview').hide();
            $('#imagePreview').fadeIn(650);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
$("#imageUpload").change(function() {
    readURL(this);
});

// End of Inventory JS


// Vegetable requisition Setup - add a text input to each footer cell
$('#vegRequisition-table thead tr#vegRequisitionfilterrow th').each( function () {
    var title = $('#vegRequisition-table thead th').eq( $(this).index() ).text();
    $(this).html( '<input type="text" onclick="stopPropagation(event);" placeholder="Search '+title+'" />' );
} );
 
    // DataTable
var table = $('#vegRequisition-table').DataTable( {
    "orderCellsTop": true,
    "scrollX": true  
} );
     
// Apply the filter
$("#vegRequisition-table thead input").on( 'keyup change', function () {
    table
        .column( $(this).parent().index()+':visible' )
        .search( this.value )
        .draw();
} );

function stopPropagation(evt) {
    if (evt.stopPropagation !== undefined) {
        evt.stopPropagation();
    } else {
        evt.cancelBubble = true;
    }
}

// DC requisition Setup - add a text input to each footer cell
$('#dcrequisition-table thead tr#filterrow th').each( function () {
    var title = $('#dcrequisition-table thead th').eq( $(this).index() ).text();
    $(this).html( '<input type="text" onclick="stopPropagation(event);" placeholder="Search '+title+'" />' );
} );
 
    // DataTable
var table = $('#dcrequisition-table').DataTable( {
    "orderCellsTop": true  
} );
     
// Apply the filter
$("#dcrequisition-table thead input").on( 'keyup change', function () {
    table
        .column( $(this).parent().index()+':visible' )
        .search( this.value )
        .draw();
} );

function stopPropagation(evt) {
    if (evt.stopPropagation !== undefined) {
        evt.stopPropagation();
    } else {
        evt.cancelBubble = true;
    }
}

// DSD requisition Setup - add a text input to each footer cell
$('#dsdrequisition-table thead tr#filterrow th').each( function () {
    var title = $('#dsdrequisition-table thead th').eq( $(this).index() ).text();
    $(this).html( '<input type="text" onclick="stopPropagation(event);" placeholder="Search '+title+'" />' );
} );
 
    // DataTable
var table = $('#dsdrequisition-table').DataTable( {
    "orderCellsTop": true  
} );
     
// Apply the filter
$("#dsdrequisition-table thead input").on( 'keyup change', function () {
    table
        .column( $(this).parent().index()+':visible' )
        .search( this.value )
        .draw();
} );

function stopPropagation(evt) {
    if (evt.stopPropagation !== undefined) {
        evt.stopPropagation();
    } else {
        evt.cancelBubble = true;
    }
}

// Purchase table Setup - add a text input to each footer cell
$('#purchase-table thead tr#purchasefilterrow th').each( function () {
    var title = $('#purchase-table thead th').eq( $(this).index() ).text();
    $(this).html( '<input type="text" onclick="stopPropagation(event);" placeholder="Search" />' );
} );
 
    // DataTable
var table = $('#purchase-table').DataTable( {
    "orderCellsTop": true,
    "scrollX": true
} );
     
// Apply the filter
$("#purchase-table thead input").on( 'keyup change', function () {
    table
        .column( $(this).parent().index()+':visible' )
        .search( this.value )
        .draw();
} );

function stopPropagation(evt) {
    if (evt.stopPropagation !== undefined) {
        evt.stopPropagation();
    } else {
        evt.cancelBubble = true;
    }
}

// LPO list table Setup - add a text input to each footer cell
$('#lpoList-table thead tr#lpoListfilterrow th').each( function () {
    var title = $('#lpoList-table thead th').eq( $(this).index() ).text();
    $(this).html( '<input type="text" onclick="stopPropagation(event);" placeholder="Search '+title+'" />' );
} );
 
    // DataTable
var table = $('#lpoList-table').DataTable( {
    "orderCellsTop": true,
    "scrollX": true
} );
     
// Apply the filter
$("#lpoList-table thead input").on( 'keyup change', function () {
    table
        .column( $(this).parent().index()+':visible' )
        .search( this.value )
        .draw();
} );

function stopPropagation(evt) {
    if (evt.stopPropagation !== undefined) {
        evt.stopPropagation();
    } else {
        evt.cancelBubble = true;
    }
}

// TRN list table Setup - add a text input to each footer cell
$('#trnList-table thead tr#trnListfilterrow th').each( function () {
    var title = $('#trnList-table thead th').eq( $(this).index() ).text();
    $(this).html( '<input type="text" onclick="stopPropagation(event);" placeholder="Search '+title+'" />' );
} );
 
    // DataTable
var table = $('#trnList-table').DataTable( {
    "orderCellsTop": true,
    "scrollX": true
} );
     
// Apply the filter
$("#trnList-table thead input").on( 'keyup change', function () {
    table
        .column( $(this).parent().index()+':visible' )
        .search( this.value )
        .draw();
} );

function stopPropagation(evt) {
    if (evt.stopPropagation !== undefined) {
        evt.stopPropagation();
    } else {
        evt.cancelBubble = true;
    }
}

// Purchase return list table Setup - add a text input to each footer cell
$('#purchaseReturn-table thead tr#purchaseReturnfilterrow th').each( function () {
    var title = $('#purchaseReturn-table thead th').eq( $(this).index() ).text();
    $(this).html( '<input type="text" onclick="stopPropagation(event);" placeholder="Search '+title+'" />' );
} );
 
    // DataTable
var table = $('#purchaseReturn-table').DataTable( {
    "orderCellsTop": true,
    "scrollX": true
} );
     
// Apply the filter
$("#purchaseReturn-table thead input").on( 'keyup change', function () {
    table
        .column( $(this).parent().index()+':visible' )
        .search( this.value )
        .draw();
} );

function stopPropagation(evt) {
    if (evt.stopPropagation !== undefined) {
        evt.stopPropagation();
    } else {
        evt.cancelBubble = true;
    }
}

// Transfer return list table Setup - add a text input to each footer cell
$('#transferReturn-table thead tr#transferReturnfilterrow th').each( function () {
    var title = $('#transferReturn-table thead th').eq( $(this).index() ).text();
    $(this).html( '<input type="text" onclick="stopPropagation(event);" placeholder="Search '+title+'" />' );
} );
 
    // DataTable
var table = $('#transferReturn-table').DataTable( {
    "orderCellsTop": true,
    "scrollX": true
} );
     
// Apply the filter
$("#transferReturn-table thead input").on( 'keyup change', function () {
    table
        .column( $(this).parent().index()+':visible' )
        .search( this.value )
        .draw();
} );

function stopPropagation(evt) {
    if (evt.stopPropagation !== undefined) {
        evt.stopPropagation();
    } else {
        evt.cancelBubble = true;
    }
}

$('#requisitionSummary-table').DataTable({
    "scrollX": true
});

// Transfer list table Setup - add a text input to each footer cell
$('#transferList-table thead tr#transferListfilterrow th').each( function () {
    var title = $('#transferList-table thead th').eq( $(this).index() ).text();
    $(this).html( '<input type="text" onclick="stopPropagation(event);" placeholder="Search '+title+'" />' );
} );
 
    // DataTable
var table = $('#transferList-table').DataTable( {
    "orderCellsTop": true,
    "scrollX": true
} );
     
// Apply the filter
$("#transferList-table thead input").on( 'keyup change', function () {
    table
        .column( $(this).parent().index()+':visible' )
        .search( this.value )
        .draw();
} );

function stopPropagation(evt) {
    if (evt.stopPropagation !== undefined) {
        evt.stopPropagation();
    } else {
        evt.cancelBubble = true;
    }
}


// Unpaid GRN table Setup - add a text input to each footer cell
$('#unpaidGRN-table thead tr#unpaidgrnfilterrow th').each( function () {
    var title = $('#unpaidGRN-table thead th').eq( $(this).index() ).text();
    $(this).html( '<input type="text" onclick="stopPropagation(event);" placeholder="Search '+title+'" />' );
} );
 
    // DataTable
var table = $('#unpaidGRN-table').DataTable( {
    "orderCellsTop": true,
    "scrollX": true
} );
     
// Apply the filter
$("#unpaidGRN-table thead input").on( 'keyup change', function () {
    table
        .column( $(this).parent().index()+':visible' )
        .search( this.value )
        .draw();
} );

function stopPropagation(evt) {
    if (evt.stopPropagation !== undefined) {
        evt.stopPropagation();
    } else {
        evt.cancelBubble = true;
    }
}

// Paid GRN table Setup - add a text input to each footer cell
$('#paidGRN-table thead tr#paidgrnfilterrow th').each( function () {
    var title = $('#paidGRN-table thead th').eq( $(this).index() ).text();
    $(this).html( '<input type="text" onclick="stopPropagation(event);" placeholder="Search '+title+'" />' );
} );
 
    // DataTable
var table = $('#paidGRN-table').DataTable( {
    "orderCellsTop": true,
    "scrollX": true
} );
     
// Apply the filter
$("#paidGRN-table thead input").on( 'keyup change', function () {
    table
        .column( $(this).parent().index()+':visible' )
        .search( this.value )
        .draw();
} );

function stopPropagation(evt) {
    if (evt.stopPropagation !== undefined) {
        evt.stopPropagation();
    } else {
        evt.cancelBubble = true;
    }
}

// Vendor Transaction table Setup - add a text input to each footer cell
$('#vtransaction-table thead tr#vtransactionfilterrow th').each( function () {
    var title = $('#vtransaction-table thead th').eq( $(this).index() ).text();
    $(this).html( '<input type="text" onclick="stopPropagation(event);" placeholder="Search '+title+'" />' );
} );
 
    // DataTable
var table = $('#vtransaction-table').DataTable( {
    "orderCellsTop": true,
    "scrollX": true
} );
     
// Apply the filter
$("#vtransaction-table thead input").on( 'keyup change', function () {
    table
        .column( $(this).parent().index()+':visible' )
        .search( this.value )
        .draw();
} );

function stopPropagation(evt) {
    if (evt.stopPropagation !== undefined) {
        evt.stopPropagation();
    } else {
        evt.cancelBubble = true;
    }
}

// Vendor Transaction table Setup - add a text input to each footer cell
$('#paymentVoucher-table thead tr#paymentVoucherfilterrow th').each( function () {
    var title = $('#paymentVoucher-table thead th').eq( $(this).index() ).text();
    $(this).html( '<input type="text" onclick="stopPropagation(event);" placeholder="Search '+title+'" />' );
} );
 
    // DataTable
var table = $('#paymentVoucher-table').DataTable( {
    "orderCellsTop": true,
    "scrollX": true
} );
     
// Apply the filter
$("#paymentVoucher-table thead input").on( 'keyup change', function () {
    table
        .column( $(this).parent().index()+':visible' )
        .search( this.value )
        .draw();
} );

function stopPropagation(evt) {
    if (evt.stopPropagation !== undefined) {
        evt.stopPropagation();
    } else {
        evt.cancelBubble = true;
    }
}

// Payment Summary table Setup - add a text input to each footer cell
$('#paymentSummary-table thead tr#paymentSummaryfilterrow th').each( function () {
    var title = $('#paymentSummary-table thead th').eq( $(this).index() ).text();
    $(this).html( '<input type="text" onclick="stopPropagation(event);" placeholder="Search '+title+'" />' );
} );
 
    // DataTable
var table = $('#paymentSummary-table').DataTable( {
    "orderCellsTop": true,
    "scrollX": true
} );
     
// Apply the filter
$("#paymentSummary-table thead input").on( 'keyup change', function () {
    table
        .column( $(this).parent().index()+':visible' )
        .search( this.value )
        .draw();
} );

function stopPropagation(evt) {
    if (evt.stopPropagation !== undefined) {
        evt.stopPropagation();
    } else {
        evt.cancelBubble = true;
    }
}


// $('.item-select').select2({
//     "placeholder": "Select an item"
// });
// $('.location-select').select2();
$('.vendor-select').select2({
    "placeholder": "Select a vendor"
});



// Date Time Picker 
$.datetimepicker.setLocale('en-USA');
$('#datetimepicker').datetimepicker();
$('#requisitiondate').datetimepicker();
$('#vendordate').datetimepicker();
$('#shippingdate').datetimepicker();

// Date Range
$('input[name="vendorLedger-range"]').daterangepicker();
$('input[name="vegRequisition-range"]').daterangepicker();
$('input[name="dcRequisition-range"]').daterangepicker();
$('input[name="dsdRequisition-range"]').daterangepicker();
$('input[name="requisitionSummary-range"]').daterangepicker();
$('input[name="transfer-range"]').daterangepicker();
$('input[name="lpo-range"]').daterangepicker();
$('input[name="trn-range"]').daterangepicker();
$('input[name="purchase-range"]').daterangepicker();
$('input[name="purchaseReturn-range"]').daterangepicker();
$('input[name="trnReturn-range"]').daterangepicker();

//Profile image
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#imagePreview').css('background-image', 'url('+e.target.result +')');
            $('#imagePreview').hide();
            $('#imagePreview').fadeIn(650);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
$("#imageUpload").change(function() {
    readURL(this);
});

// Show & Hide FOC
$(function () {
    $("#chkPassport").click(function () {
        if ($(this).is(":checked")) {
            $("#dvPassport").show();
        } else {
            $("#dvPassport").hide();
        }
    });
});