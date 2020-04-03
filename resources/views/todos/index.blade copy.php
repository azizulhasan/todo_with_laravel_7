

@extends('todos.master')
@section('content')


    
        <div class="col-md-12">
            <x-alert/>
        </div>
        <div class="col-sm-8 col-md-9 ">
            <h1 class="text-center text-primary">Todos</h1>
            <div >
                <input class="form-control"  type="text" id="title" name="title" placeholder="What you need todo today ?"> 
            </div>
            <div class="table-responsive">
              <table class="table table-bordered table-hover table-striped" id="todo_item">
                <tbody>
                @foreach ($todos as $todo)
                <tr class="active_task" serial="{{$todo->id}}">
                        <td>
                            <div class="form-check">
                                <input data-id="{{$todo->id}}" class="form-check-input" type="checkbox" name="completed" id="completed"  >
                            </div>
                        </td>
                        <td id="edit_todo" colspan="2">
                            <p id="edit_text"  data-id="{{$todo->id}}">{{$todo->title}}</p>
                            <div class="form-group">
                                <input data-id="{{$todo->id}}" class="form-control" type="text" name="title" id="edit_title" value="{{$todo->title}}" hidden="hidden"  >
                            </div>
                        </td>
                        <td>
                            <button type="button" data-id="{{$todo->id}}" class="delete_todo"  aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </td>
                    </tr>
                @endforeach
                <tr id="show_hide">
                    <td id="count_tr">
                    </td>
                    <td class="active_color">
                         <button type="button"  class="all_task" >All</button>
                    </td>
                    <td>
                        <button type="button"  class="all_active_task" >Active</button>
                    </td>
                    <td>
                        <button type="button"  class="all_complete_task" >Completed</button>
                    </td>
                    <td>
                        <button type="button"  class="clear_completed_task" >Clear Completed</button>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        </div>
    

    
@endsection

<style>
    #show_hide{display: none;}
    .completed_task{display: none;}
    .clear_completed_task{visibility: hidden;}
    .active_color button{color:#228B22; font-weight: bold}

    
    #todo_item tbody tr td:nth-child(2){
        width: 100% !important; 
    }
</style>