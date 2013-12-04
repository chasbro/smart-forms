rnJQuery(function () {

    rnJQuery('#cbDisplayType').change(function () {
        FormatStartDate();
        FormatEndDate();
    });

    rnJQuery(".datePicker").datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: 'MM/dd/yy',
        onClose: function (dateText, inst) {

            var id = rnJQuery(this).attr('id');

            if (id == 'dpStartDate')
                FormatStartDate();
            else
                FormatEndDate();
        }
    });


    function FormatStartDate() {
        var dp = rnJQuery('#dpStartDate');
        var date = dp.datepicker('getDate');
        if (date == null)
            return;
        switch (rnJQuery('#cbDisplayType').val()) {
            case 'd':
                return;
                break;
            case 'w':
                dp.datepicker('setDate', new Date(date.setDate(date.getDate() - date.getDay())));
                break;
            case 'm':
                dp.datepicker('setDate', new Date(date.getFullYear(), date.getMonth(), 1));
                break;
            case 'y':
                dp.datepicker('setDate', new Date(date.getFullYear(), 0, 1));
                break;
        }
    }

    function FormatEndDate() {
        var dp = rnJQuery('#dpEndDate');
        var date = dp.datepicker('getDate');
        if (date == null)
            return;
        switch (rnJQuery('#cbDisplayType').val()) {
            case 'd':
                return;
                break;
            case 'w':
                dp.datepicker('setDate', new Date(date.setDate(date.getDate() + (6 - date.getDay()))));
                break;
            case 'm':
                date = new Date(date.getFullYear(), date.getMonth() + 1, 1);
                dp.datepicker('setDate', new Date(date.setDate(0)));
                break;
            case 'y':
                dp.datepicker('setDate', new Date(date.getFullYear(), 11, 31));
                break;
        }
    }


    rnJQuery('#ui-datepicker-div').wrap('<div class="smartFormsSlider"></div>');

    var plot1 = rnJQuery.jqplot('Chart', [
        ['2013-2-1', 0]
    ], {
        title: 'Donations Summary',
        axes: {
            xaxis: {
                renderer: rnJQuery.jqplot.DateAxisRenderer,
                tickOptions: { formatString: '%b/%d/%Y' },

                min: '2013-1-1',
                max: '2013-4-1',
                tickInterval: '1 month',

                pointLabels: {show: true, edgeTolerance: -15}
            }
        },

        highlighter: {
            show: true,
            sizeAdjust: 7.5
        },
        cursor: {
            show: false
        },
        series: [
            { label: 'Donations' }
        ]
    });


    /************************************************************************************* Execute Query ***************************************************************************************************/

    rnJQuery('#btnExecute').click(ExecuteQuery);

    function ExecuteQuery() {


        var startDate = rnJQuery.datepicker.formatDate('yy-mm-dd', rnJQuery('#dpStartDate').datepicker('getDate'));
        var endDate = rnJQuery.datepicker.formatDate('yy-mm-dd', rnJQuery('#dpEndDate').datepicker('getDate'));
        var form = rnJQuery('#cbForm').val();

        if (!startDate) {
            alert('Start Date is Mandatory');
            return;
        }


        if (!endDate) {
            alert('End Date is Mandatory');
            return;
        }


        if (!form) {
            alert('Campaign is mandatory');
            return;
        }


        var data = {
            action: "rednao_smart_forms_entries_list",
            startDate: startDate,
            endDate: endDate,
            form_id: form
        };


        rnJQuery.post(ajaxurl, data, function (result) {
            var result=rnJQuery.parseJSON(result);
            ajaxCompleted(result)
        });
    }




    /************************************************************************************* Chart  ***************************************************************************************************/
    var handler = function(ev, gridpos, datapos, neighbor, plot) {
        if (neighbor) {
            var selectedDate = new Date(neighbor.data[0]);
            selectedDate = selectedDate.getFullYear()+ "/" +(selectedDate.getMonth()+ 1) + "/" +selectedDate.getDate() ;
            //selectedSerie = SerieToString(neighbor.seriesIndex);


            Grid[0].p.url = ajaxurl+'?action=rednao_smart_donations_execute_analytics_list&date=' + selectedDate +
                '&campaign_Id=' + GridCampaign_Id+'&displayType='+GridDisplayType;
            Grid[0].grid.populate();

        }
    };


    rnJQuery.jqplot.eventListenerHooks.push(['jqplotClick', handler]);

    var GridCampaign_Id='';
    var GridDisplayType="";
    var Grid;
    function ajaxCompleted(result) {
        var formOptions=result.formOptions;
        var entries=result.entries;
        LoadGrid(formOptions,entries);
        /*var values = rnJQuery.parseJSON(result);
        GridCampaign_Id=campaign_id;
        GridDisplayType=displayType;

        var xAxis={
            renderer: rnJQuery.jqplot.DateAxisRenderer,
            tickOptions: { formatString: '%d/%b/%Y' },
            tickInterval: tick,
            pointLabels: {show: true, edgeTolerance: -15}
        };

        if(values.length>1)
        {
            xAxis.min= values[0][0],
            xAxis.max=values[values.length - 1][0];
        }

        rnJQuery('#Chart').empty();
        rnJQuery('#Chart').width(values.length * 100);
        rnJQuery.jqplot('Chart', [values], {
            title: 'Donations Summary',
            axes: {
                xaxis: xAxis
            },

            highlighter: {
                show: true,
                sizeAdjust: 7.5
            },
            cursor: {
                show: false
            },
            series: [
                { label: 'Donations' }
            ]
        });

**/
    }




    /*----------------------------------------------------------------------------GRID------------------------------*/

    function LoadGrid(formOptions,entries) {
        var colmodel=[];

        for(var i=0;i<formOptions.length;i++)
        {
            var column=RedNaoCreateColumn(formOptions[i]);
            if(column!=null)
                colmodel.push(column)
        }


        Grid=rnJQuery('#grid').jqGrid({autowidth: true, "hoverrows": true,mtype:"POST",  "viewrecords": true, "jsonReader": {"repeatitems": false, "subgrid": {"repeatitems": false}}, "gridview": true,  "editurl": ajaxurl+"?action=rednao_smart_donations_execute_analytics_op", "cellurl": ajaxurl+"?action=rednao_smart_donations_execute_analytics_op",  "rowList": [10, 20, 30], "sortname": "TransactionId", "datatype": "json",
            "colModel": colmodel,
            "datatype": "local",
            "data":entries,"postData": {"oper": "grid"}, "prmNames": {"page": "page", "rows": "rows", "sort": "sidx", "order": "sord", "search": "_search", "nd": "nd", "id": "TransactionId", "filter": "filters", "searchField": "searchField", "searchOper": "searchOper", "searchString": "searchString", "oper": "oper", "query": "grid", "addoper": "add", "editoper": "edit", "deloper": "del", "excel": "excel", "subgrid": "subgrid", "totalrows": "totalrows", "autocomplete": "autocmpl"}
            ,"loadError": function (xhr, status, err) {
            try {
                if(xhr.responseText)
                    alert(xhr.responseText);
            } catch (e) {
                alert(xhr.responseText);
            }
        }, "pager": "#pager"});

        rnJQuery('#grid').jqGrid('navGrid', '#pager', {"edit":false,"del":false,"search":false,"refresh":false,"view":false,"excel":false,"pdf":false,"csv":false, addtext:"", addtitle:"Add new row" ,"errorTextFormat": function(r) {
            return r.responseText;
        }});

        rnJQuery('#grid').jqGrid('editGridRow')


    /*    Grid.on('jqGridAddEditAfterSubmit',function(a,b,c)
        {
            if(b.responseText)
                rnJQuery.jgrid.info_dialog(rnJQuery.jgrid.errors.errcap, '<div class="ui-state-error">' + b.responseText + '</div>', rnJQuery.jgrid.edit.bClose, {buttonalign: 'right'});
            else
            {
                var myInfo = '<div class="ui-state-highlight ui-corner-all">' +
                        '<span class="ui-icon ui-icon-info" ' +
                        'style="float: left; margin-right: .3em;"></span>' +
                        '<span>Information saved</span></div>';

                $infoTr = rnJQuery("#TblGrid_grid >tbody>tr.tinfo"),
                $infoTd = $infoTr.children("td.topinfo");
                $infoTd.html(myInfo);
                $infoTr.show();

                // hide the info after 3 sec timeout
                setTimeout(function () {
                    $infoTd.children("div")
                        .fadeOut("slow", function () {
                            // Animation complete.
                            $infoTr.hide();
                        });
                }, 3000);
            }

        });*/


    };










});




