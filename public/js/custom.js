
$(document).ready(function () {
    $(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    /*
    |
    | add todos
    |
    */
    $('#title').keydown(function(e) {
    var key = e.which;
    if (key == 13) {
    // e.prevendivefault();
        $.ajax({
          data: {"title": $(this).val()},
          url: ""+'/store',
          type: "POST",
          dataType: 'json',
          success: function (data) {
              $("#title").val("");
              html = '';
              html +=`
              <div class="col-12 active_task single_row" serial="${data.id}">
              <div class="row">
                    <div class="col-1">
                        <div class="form-check">
                        <input data-id="${data.id}" class="form-check-input" type="checkbox" name="completed" id="completed"  >
                        </div>
                    </div>
                        <div class="col-10" id=" edit_todo" >
                            <p id="edit_text"  data-id="${data.id}">${data.title}</p>
                            <div class="form-group">
                            <input data-id="${data.id}" class="form-control" type="text" name="title" hidden id="edit_title" value="${data.title}"  >
                            </div>
                        </div>
                        <div class="col-1">
                            <button type="button" data-id="${data.id}" class="delete_todo" aria-label="Close">
                                <span aria-hidden="divue">&times;</span>
                              </button>
                         </div>
                    </div>
                </div>
              `;
              $("#todo_item div.todo_body").prepend(html)
              let itemLeft= $("#todo_item div.todo_body div.active_task").length;
              count_div_item(itemLeft, 'left');
              
          },
          error: function (data) {
              console.log('Error:', data);
              $('#btn').html('Save Changes');
          }
      });
    }
    }); 
    /*
    |
    | edit todos
    |
    */
    
    $('#todo_item').on('keydown', '#edit_title', function (e) {
        var todo_id = $(this).data('id');
       var title=  $(this).closest("div.single_row").find("#edit_title").val();
       var p_text=  $(this).closest("div.single_row").find("#edit_text");
       var edited_title=  $(this).closest("div.single_row").find("#edit_title");
    
        var key = e.which;
        if (key == 13) {
        // e.prevendivefault();
                $.ajax({
                data: {
                    'id':{'id':todo_id,"title":title},
                    'title': $("#edit_title").val()
                },
                url: ""+'/update/'+todo_id,
                type: "POST",
                dataType: 'json',
                success: function (data) {
                        $(edited_title).val(data.title)
                    $(p_text).text(data.title);
                    $(edited_title).hide()
                    $(p_text).show();
                },
                error: function (data) {
                    console.log('Error:', data);
                }
                });
        }
    });
    /*
    |
    | delete todos
    |
    */
    $('#todo_item').on('click', '.delete_todo ', function (e) {
        var todo_id = $(this).data('id');
        var remove_div = $(this).closest('div.single_row');      
        $.ajax({
            type: "post",
            url: ""+'/deletetod/'+todo_id,
            success: function (data) {
                if(data){  
                    let itemLeft= $("#todo_item div.todo_body div.active_task").length;
                    count_div_item((itemLeft-1), "left")
                    $(remove_div).remove();
                }
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });
    /*
    |
    | clear all todos from front and database
    |
    */
    $('.clear_completed_task').on("click",function(){
        var act_taskt =$(".active_task")
        var completed_task =$('.completed_task');
            $.ajax({
                data:{"id":com_id},
            url: ""+'/deleteall',
            type: "POST",
            dataType: 'json',
            success: function (data) {
                if(data){
                    $(completed_task).remove();
                    let itemLeft= $("#todo_item div.todo_body div.active_task").length;
                    count_div_item(itemLeft, "left");
                    if(itemLeft){
                        $(".clear_completed_task").css('visibility','visible')
                    }else{
                        $(".clear_completed_task").css('visibility','hidden')
                    }
                }
            },
            error:function(data){
                alert('Error:', data)
            }
        })
    })
    
    
    /*
    |
    | show edit form after clicking on todo text 
    |
    */
    $("#todo_item").on("click", "#edit_todo", function(){
        $(this).closest("div.single_row").find("#edit_text").hide()
        $(this).closest("div.single_row").find("#edit_title").removeAttr('hidden') 
        $(this).closest("div.single_row").find("#edit_title").focus()
    });
    $("#todo_item").on("focusout","#edit_todo",function(){
        $(this).closest("div.single_row").find("#edit_text").hide()
        $(this).closest("div.single_row").find("#edit_title").show() 
    })


    /*
    |
    | view all atcive task
    |
    */
    $('.all_active_task').on("click",function(){
        $(".active_task").show()
        $(".completed_task").hide()
        let itemLeft= $("#todo_item div.todo_body div.active_task").length;
        count_div_item(itemLeft, 'active');
    })
       
    /*
    |
    | coplete task and add it to copleted task button
    |
    */
    var com_id = new Array()
    $("#todo_item").on("click", "#completed", function(){
        if(!$(this).hasClass('active')){
            $(this).addClass('active')
           $(this).closest("div.single_row").find("p").wrap('<del></del>')
           $(this).closest("div.single_row").removeClass("active_task")
           $(this).closest("div.single_row").addClass("completed_task")
            com_id.push($(this).closest("div.single_row").attr('serial'))
           let itemLeft= $("#todo_item div.todo_body div.active_task").length;
            count_div_item(itemLeft , 'left'); 
        $(".clear_completed_task").css('visibility','visible')
        }else{
            $(this).removeClass('active')
            if(!$(this).hasClass('active')){
                $(this).closest("div.single_row").find("p").unwrap('<del></del>')
                $(this).closest("div.single_row").removeClass("completed_task")
                $(this).closest("div.single_row").addClass("active_task")
                $(".active_task").hide()
                let itemLeft= $("#todo_item div.todo_body div.completed_task").length;
                count_div_item(itemLeft, 'left'); 
                if(itemLeft){
                    $(".clear_completed_task").css('visibility','visible')
                }else{
                    $(".clear_completed_task").css('visibility','hidden')
                }
            }
        }
    });
    /*
    |
    | view all atcive task
    |
    */
    
    $('.all_complete_task').on("click",function(){
        if(!$(this).closest("div.single_row").hasClass('active_task')){
            $(".active_task").hide()
            $(".completed_task").show()
        }else{
            $(".active_task").hide()
            $(".completed_task").show()
        }
        let itemLeft= $("#todo_item div.todo_body div.completed_task").length;
        count_div_item(itemLeft, 'completed');
    })
    
    /*
    |
    | view all  task
    |
    */
    $('.all_task').on("click",function(){
        $(".active_task").show()
        $(".completed_task").show()
        let itemLeft= $("#todo_item div.todo_body div.single_row").length;
        count_div_item((itemLeft),''); 
    })
    
     /*
    |
    | show bottom row after adding todos 
    |
    */
    
    $("#show_hide div.row [class*='col-']").click(function(){
        if(!$("#show_hide div.row [class*='col-']").hasClass("active_color")){
            $(this).addClass("active_color")
        }else{
            $("#show_hide div.row [class*='col-']").removeClass("active_color")
            $(this).addClass("active_color")
        }
       
    }) 
    
    
    /*
    |
    | Count active todos
    |
    */
    function count_div_item(itemLeft , sdiving){
        if(itemLeft){
        $('#show_hide').css("display", "block");
        $("#count_div").html( itemLeft  +" item "+sdiving)
        }else{
            $("#count_div").html(  0 +" item "+sdiving)
        }
    }  
    
    let itemLeft= $("#todo_item div.todo_body div.active_task").length;
    count_div_item(itemLeft, 'left'); 
    });
    })
    