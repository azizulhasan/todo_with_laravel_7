

@extends('todos.master')
@section('content')


    
        <div class="col-12 col-md-12">
            <x-alert/>
        </div>
        <div class="col-sm-12 offset-md-2 col-md-7 todo_item_box">
            <h1 class="text-center ">Todos</h1>
            <div  class=" ">
                
            </div>
            
              <div class="col-12" id="todo_item">
                <input class="form-control-lg py-4 px-5 mb-2 col-12 "  type="text" id="title" name="title" placeholder=" What you need todo today ?">
                <div class="row todo_body ">
                    @foreach ($todos as $todo)
                    <div  class="col-12 active_task single_row " serial="{{$todo->id}}">
                        <div class="row ">
                            <div class="col-1 col-md-1">
                                <div class="form-check">
                                    <input data-id="{{$todo->id}}" class="form-check-input" type="checkbox" name="completed" id="completed"  >
                                    
                                </div>
                            </div>
                            <div class="col-9 col-md-10" id="edit_todo" >
                                <p id="edit_text"  data-id="{{$todo->id}}">{{$todo->title}}</p>
                                <div class="form-group">
                                    <input data-id="{{$todo->id}}" class="form-control" type="text" name="title" id="edit_title" value="{{$todo->title}}" hidden="hidden"  >
                                </div>
                            </div>
                            <div class="col-2 col-md-1 ">
                                <button type="button" data-id="{{$todo->id}}" class="delete_todo"  aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    <div id="show_hide" class="col-12">
                        <div class="row">
                            <div class="col-3 pl-4" id="count_div">
                            </div>
                            <div class="col-1 active_color">
                                <button type="button"  class="all_task " >All</button>
                            </div>
                            <div class="col-2">
                                <button type="button"  class="all_active_task" >Active</button>
                            </div>
                            <div class="col-2" >
                                <button type="button"  class="all_complete_task" >Completed</button>
                            </div>
                            <div class="col-4">
                                <button type="button"  class="clear_completed_task" >Clear Completed</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    

    
@endsection




