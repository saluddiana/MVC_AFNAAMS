$(document).ready(function () {
  var table = $("#myTable").DataTable({
    dom: "Bfrtip",
    buttons: [
      "colvis",
      {
        extend: "excelHtml5",
        exportOptions: {
          columns: ":visible",
        },
        className: "buttons-collection",
      },
      {
        extend: "print",
        exportOptions: {
          columns: ":visible",
        },
        className: "buttons-collection",
      },
    ],
  });

  // Use the appendTo method to place buttons in the desired container
  table
    .buttons()
    .container()
    .appendTo($("#myTable_wrapper .dataTables_length"));
});
