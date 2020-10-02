
function viewTask(id) {
    // alert(id);
    $("#TaskModal").modal("show");
    $("#TaskModal").css("opacity", "1");
    
    $('.modal-body').empty();
    $(".taskLoader").show(500);
    setTimeout(() => {
        $.ajax({
            url: "getTaskDetails.php",
            method: "POST",
            data: "task_emp_id=" + id,
            success: function(data) {
                // alert(data);
                if (data != "false") {
                    data = JSON.parse(data);
                    var length = data.length;
                    
                    //Repetition duration
                    let rd = data[0].task_emp_repetition_duration;
                    if(rd == "Month")
                    {
                        rd = "Monthly";
                    }
                    else if(rd == "Year")
                    {
                        rd = "Yearly";
                    }
                    // else if(rd == 2)
                    // {
                    //     rd = "Monthly";
                    // }
                    // else if(rd == 3)
                    // {
                    //     rd = "Quarterly";
                    // }
                    // else if(rd == 4)
                    // {
                    //     rd = "Half Yearly";
                    // }
                    // else if(rd == 5)
                    // {
                    //     rd = "Yearly";
                    // }
                    

                    let row = "<h4>"+data[0].shipper_name+"</h4><p>"+data[0].date_assign+"</p><p>Quantity - "+data[0].task_emp_quantity+" | "+rd+"</p><h5>Description : </h5>" + data[0].task_emp_description;

                    // row += '<div class="container">';


                    row += '<h5>Files : </h5>';
                    if( data[0].task_file )
                    {
                        for(let i=0; i<data[0].task_file.length ; i++)
                        {
                            
                            
                            row += '<div class="col-md-4" style="padding:10px 0px">' +
                            '<a target="_BLANK" href="./task_files/'+data[0].task_file[i]+'"> '+data[0].task_file[i]+' </a>'+
                            "</div>";
                            
                        }
                    }
                    else {
                        row += " No files";

                    }
                    
                    // row += '</div>';
                    
                    $("#task_name").html(data[0].task_name);
                    
                    $('.modal-body').html(row);

                }
            },
        }).done(() => {
            $(".taskLoader").hide(500);
        });
    }, 700);
}
function checkUncheck(i,subTaskLength)
{
    if($('#chkQuantity_'+i).is(':checked'))
    {
        for(j=0;j<subTaskLength;j++)
        {
            $("#chkSubQuantity_"+i+"_"+j).attr('checked', true);
        }
    }
    else
    {
        for(j=0;j<subTaskLength;j++)
        {
            if(!$("#chkSubQuantity_"+i+"_"+j).is(':disabled'))
                $("#chkSubQuantity_"+i+"_"+j).attr('checked', false);
        }
    }
}
function checkUncheckMainTask(i,j,subTaskLength)
{
    if($("#chkSubQuantity_"+i+"_"+j).is(':checked'))
    {
        var flag = true;
        for(k=0;k<subTaskLength;k++)
        {
            if(!$("#chkSubQuantity_"+i+"_"+k).is(':checked'))
            {
                
                flag = false;
                break;
            }
        }
        if(flag)
        {
            $('#chkQuantity_'+i).attr('checked', true);
            if(!$('#chkQuantity_'+i).is(':checked'))
                $('#chkQuantity_'+i).next().trigger("click");
        }   
        else
        {
            $('#chkQuantity_'+i).attr('checked', false);
            if($('#chkQuantity_'+i).is(':checked'))
                $('#chkQuantity_'+i).next().trigger("click");
        }
    }
    else
    {
        $('#chkQuantity_'+i).attr('checked', false);
        if($('#chkQuantity_'+i).is(':checked'))
            $('#chkQuantity_'+i).next().trigger("click");
    }
}
function viewRunningTask(id) {
    // alert(id);
    $("#RunningTaskModal").modal("show");
    $("#RunningTaskModal").css("opacity", "1");
    
    $('.modal-body').empty();
    $('.quantityList').empty();
    $(".taskLoader").show(500);
    
    setTimeout(() => {
        $.ajax({
            url: "getTaskDetails.php",
            method: "POST",
            data: "task_emp_id=" + id,
            success: function(data) {
                // alert(data);
                if (data != "false") {
                    // console.log(data);
                    data = JSON.parse(data);
                    var length = data.length;
                    
                    //Repetition duration
                    let rd = data[0].task_emp_repetition_duration;
                    if(rd == "Month")
                    {
                        rd = "Monthly";
                    }
                    else if(rd == "Year")
                    {
                        rd = "Yearly";
                    }
                   
                    

                    let row = "<h4>"+data[0].shipper_name+"</h4><p>"+data[0].date_assign+"</p><p>Quantity - "+data[0].task_emp_quantity+" | "+rd+"</p><h5>Description : </h5>";

                    row += '<h5>Files : </h5>';
                    for(let i=0; i<data[0].task_file.length ; i++)
                    {
                        row += '<div class="col-md-4" style="padding:10px 0px">' +
                        '<a target="_BLANK" href="./task_files/'+data[0].task_file[i]+'"> '+data[0].task_file[i]+' </a>'+
                        "</div>";
                    }
                    

                    let rowQuantity = '';
                    rowQuantity += '<div class="col-md-12"><h5>Tasks : </h5></div>';
                    //alert(JSON.stringify(data));
                    for(let i=0; i<data[0].task_emp_qty_id.length ; i++)
                    {
                        let chkStatus = '';
                        var task_emp_qty_idKey = Object.keys(data[0].task_emp_qty_id[i])[0];
                        var task_emp_qty_id = data[0].task_emp_qty_id[i];
                        //alert(JSON.stringify(task_emp_qty_id));
                        var functionCall = "";
                        var subTaskLength = data[0].task_emp_qty_id[i][task_emp_qty_idKey].length;
                        //alert(data[0].task_emp_qty_id[i][task_emp_qty_idKey][0].hasOwnProperty("task_emp_qty_sub_id"));
                        if(subTaskLength > 0 && data[0].task_emp_qty_id[i][task_emp_qty_idKey][0].hasOwnProperty("task_emp_qty_sub_id"))
                        {
                            task_emp_qty_id = task_emp_qty_idKey;
                            //alert(task_emp_qty_id);
                            functionCall = 'onChange="checkUncheck('+i+','+subTaskLength+')"';
                        }
                        if(data[0].task_emp_status[i] == 1)
                        {
                            chkStatus = "checked";
                        }
                        rowQuantity += '<div class="col-md-12" style="padding:10px 0px">' +
                        '<input '+chkStatus+' type="checkbox" name="chkQuantity[]" id="chkQuantity_'+i+'" data-plugin="switchery" data-color="#1AB394" data-secondary-color="#ED5565" data-size="small" class="switchery_'+i+'" value="'+task_emp_qty_id+'" '+functionCall+'/> '+ data[0].task_name + " " + (i+1);
                        rowQuantity += "</div>";
                        if(subTaskLength > 0 && data[0].task_emp_qty_id[i][task_emp_qty_idKey][0].hasOwnProperty("task_emp_qty_sub_id"))
                        {
                            rowQuantity += '<div class="col-md-2" ><label>Sub Tasks: </label></div>';
                            for(let j=0; j < subTaskLength; j++)
                            {
                                let chkSubStatus = '';
                                if(data[0].task_emp_qty_id[i][task_emp_qty_idKey][j].task_emp_sub_status == 1 )
                                {
                                    chkSubStatus = "checked disabled";
                                }
                                var subFunctionCall = 'onChange="checkUncheckMainTask('+i+','+j+','+subTaskLength+')"';
                                rowQuantity += '<div class="col-md-2" >' +
                                '<input '+chkSubStatus+' type="checkbox" name="chkSubQuantity[]" id="chkSubQuantity_'+i+'_'+j+'" value="'+data[0].task_emp_qty_id[i][task_emp_qty_idKey][j].task_emp_qty_sub_id+'" '+subFunctionCall+'/><label for="chkSubQuantity_'+i+'_'+j+'">&nbsp;'+ data[0].task_emp_qty_id[i][task_emp_qty_idKey][j].sub_product_name +'</label>';
                                rowQuantity += "</div>";
                            }
                            rowQuantity += "<div class='col-md-12' style='border:1px solid black;'></div>";
                        }
                        
                    }
                    
                    
                   
                    $('.quantityList').html(rowQuantity);

                    $("#task_name").html(data[0].task_name);
                    $("#modal_task_emp_id").val(data[0].task_emp_id);
                    $("#modal_task_emp_quantity").val(data[0].task_emp_quantity);
                    $("#task_emp_description").val(data[0].task_emp_description);
                    CKEDITOR.replace('task_emp_description');

                    $('[data-plugin="switchery"]').each(function(e, t) {
                        new Switchery($(this)[0], $(this).data())
                    });

                    $('.modal-body').html(row);

                }
            },
        }).done(() => {
            $(".taskLoader").hide(500);            
            
        });
    }, 700);
}

$('#runningTaskForm').submit(function(e) {

    e.preventDefault();
    // alert("call");
    $(".taskLoader").show(500);
    // $(".btnRunningTask").hide();

    const formData = $(this);
    setTimeout(() => {
        $.ajax({
            type: "POST",
            url: "updateRunningTask.php",
            data: formData.serialize(),
            cache: false,
            processData: false,
            success: (result) => {
                // console.log(result);
                return result;
            }
        }).then((result) => {
            
            if ($.trim(result) =='<div class="alert alert-success"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Task Updated Successfully! </div>') {
                
                getRunningTasks();
                getCompleteTasks();
                

            } else {
                $(".btnRunningTask").show();
                
            }
            $('.taskUpdateResult').html(result);
            $('.taskLoader').hide(500);

        });
    }, 500);


});


function acceptTask(id) {
    $(".newTaksLoader_"+id).show(500);
    
    setTimeout(() => {
        $.ajax({
            url: "acceptTask.php",
            method: "POST",
            data: "task_emp_id=" + id,
            success: function(data) {
                // alert(data);
                // console.log(data);
                getNewTasks();
                getRunningTasks();
            },
        }).done(() => {
            $(".newTaksLoader_"+id).hide(500);
        });
    }, 700);
}

function startTask(id) {
    $(".runningTaksLoader_"+id).show(500);
    
    setTimeout(() => {
        $.ajax({
            url: "startTask.php",
            method: "POST",
            data: "task_emp_id=" + id,
            success: function(data) {
                // alert(data);
                // console.log(data);
                getRunningTasks();
            },
        }).done(() => {
            $(".runningTaksLoader_"+id).hide(500);
        });
    }, 700);
}

function pauseTask(id) {
    $(".runningTaksLoader_"+id).show(500);
    
    setTimeout(() => {
        $.ajax({
            url: "pauseTask.php",
            method: "POST",
            data: "task_emp_id=" + id,
            success: function(data) {
                // alert(data);
                // console.log(data);
                getRunningTasks();
            },
        }).done(() => {
            $(".runningTaksLoader_"+id).hide(500);
        });
    }, 700);
}

function getNewTasks() {
    $.ajax({
        url: "getNewTasks.php",
        method: "POST",
        success: function(data) {
            //alert(data);
            if (data != "false") {
                data = JSON.parse(data);
                var length = data.length;
                var row = '<div class="com-md-12"><div class="inbox-widget">';
                            
                        
                
                for (i = 0; i < length; i++) {
                    row += '<div class="inbox-item">' +
                    ' '+
                        '<h5 class="inbox-item-author mt-0 mb-1">'+data[i].task_name+'</h5>' +
                        '<p class="inbox-item-text">'+data[i].shipper_name+'</p>'+
                        '<button class="btn btn-blue" title="View" onClick="viewTask('+data[i].task_emp_id+')"><i class="mdi mdi-eye"></i> View</button> '+
                        '<button class="btn btn-success" title="Accept" onClick="acceptTask('+data[i].task_emp_id+')"><i class="mdi mdi-check"></i> Accept</button> <img src="./assets/images/loading.gif" style="display:none" class="newTaksLoader_'+data[i].task_emp_id+'"/>'+
                        '<p class="inbox-item-date">'+data[i].date_assign+'</p>'+
                    ''+
                '</div>';
                }
                row += '</div></div>';


                $('.new-tasks-result').html(row);

                //openListModal('invoice');
            }
            if (data == "false") {
                var row = "No Records..!";
                $('.new-tasks-result').html(row);
            } else {
                //registerInvoice('false');
            }
            
                

        }
    });
};

function getRunningTasks() {
    $.ajax({
        url: "getRunningTasks.php",
        method: "POST",
        success: function(data) {
            //alert(data);
            if (data != "false") {
                data = JSON.parse(data);
                var length = data.length;
                var row = '<div class="com-md-12"><div class="inbox-widget">';
                            
                        
                
                for (i = 0; i < length; i++) {
                    row += '<div class="inbox-item">' +
                    ' '+
                        '<h5 class="inbox-item-author mt-0 mb-1">'+data[i].task_name+'</h5>' +
                        '<p class="inbox-item-text" >'+data[i].shipper_name+'</p>' +
                        '<p class="inbox-item-date" >'+data[i].time+'</p>';
                        if(data[i].task_emp_running_status === '0')
                            row +='<button class="btn btn-blue" title="Start" onClick="startTask('+data[i].task_emp_id+')"><i class="mdi mdi-play"></i> </button> ';
                        else
                            row +='<button class="btn btn-danger" title="Pause" onClick="pauseTask('+data[i].task_emp_id+')"><i class="mdi mdi-pause"></i> </button> '

                        row +='<button class="btn btn-success" title="View" onClick="viewRunningTask('+data[i].task_emp_id+')"><i class="mdi mdi-eye"></i> View</button> '+
                        '<img src="./assets/images/loading.gif" style="display:none" class="runningTaksLoader_'+data[i].task_emp_id+'"/>'+
                        // '<p class="inbox-item-date">'+data[i].date_assign+'</p>'+
                    ''+
                '</div>';
                }
                row += '</div></div>';

                $('.running-tasks-result').html(row);

                //openListModal('invoice');
            }
            if (data == "false") {
                var row = "No Records..!";
                $('.running-tasks-result').html(row);
            } else {
                //registerInvoice('false');
            }
            
                

        }
    });
};


function getCompleteTasks() {
    $.ajax({
        url: "getCompleteTasks.php",
        method: "POST",
        success: function(data) {
            //alert(data);
            if (data != "false") {
                data = JSON.parse(data);
                var length = data.length;
                var row = '<div class="com-md-12"><div class="inbox-widget">';
                            
                        
                
                for (i = 0; i < length; i++) {
                    row += '<div class="inbox-item">' +
                    ' '+
                        '<h5 class="inbox-item-author mt-0 mb-1">'+data[i].task_name+'</h5>' +
                        '<p class="inbox-item-text">'+data[i].shipper_name+'</p>'+
                        '<button class="btn btn-blue" title="View" onClick="viewTask('+data[i].task_emp_id+')"><i class="mdi mdi-eye"></i> View</button> '+
                        
                        '<p class="inbox-item-date">'+data[i].date_assign+'</p>'+
                    ''+
                '</div>';
                }
                row += '</div></div>';


                $('.completed-tasks-result').html(row);

                //openListModal('invoice');
            }
            if (data == "false") {
                var row = "No Records..!";
                $('.completed-tasks-result').html(row);
            } else {
                //registerInvoice('false');
            }
            
                

        }
    });
};


$(document).ready(function(){ 
   
    getNewTasks();
    getRunningTasks();
    getCompleteTasks();
    // To get records
});