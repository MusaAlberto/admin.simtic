jqDT = $jq('#jqdatatable').dataTable(
{
	"oLanguage": {"sSearch": "\u00FCber alle Spalten filtern: " },
  "bLengthChange": false,
  "bPaginate": true,
  "bScrollCollapse": true,
  "bDeferRender": true,
  "sDom": '<"fg-toolbar ui-toolbar ui-widget-header ui-helper-clearfix ui-corner-tl ui-corner-tr"lfr>tS<"fg-toolbar ui-toolbar ui-widget-header ui-helper-clearfix ui-corner-bl ui-corner-br"ip>',
  "oScroller": {
		"autoHeight": true,
		"rowHeight": 29,
		"trace": false,
		"deferRender": true
	},
  "bAutoWidth": true,
  "columnDefs": [
    { "title": "My column title", className: "dt-body-right", "targets": [ 0,1,2,3,4,5,6,7,8 ] }
  ],
  "data": [
		[
			"Tiger Nixon</span",
			"System Architect",
			"Edinburgh",
			"5421",
			"2011/04/25",
			"$320,800",
			"sdsf",
			"sdsf",
			"s     dsf"
		],
		[
			"Garrett Winters",
			"Accountant",
			"Tokyo",
			"8422",
			"2011/07/25",
			"$170,750",
			"$170,75ff0",
			"$170,75fsd0",
			"$170,750"
		]
}
);