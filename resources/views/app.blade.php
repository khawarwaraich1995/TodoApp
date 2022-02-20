<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Todo App (MetaSchool)</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet"
        href="https://www.jqueryscript.net/demo/Date-Time-Picker-Bootstrap-4/build/css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body class="antialiased">
    <div class="container m-5 p-2 rounded mx-auto bg-light shadow">
        <!-- App title section -->
        <div class="row m-1 p-4">
            <div class="col">
                <div class="p-1 h1 text-primary text-center mx-auto display-inline-block">
                    <i class="fa fa-check bg-primary text-white rounded p-2"></i>
                    <u> Todo App Assessment</u>
                </div>

            </div>
        </div>

        <!-- Create todo section -->
        <form action="{{ route('add-task') }}" method="post">
            @csrf
            <div class="row m-1 p-3">

                <div class="col col-11 mx-auto">
                    <div
                        class="row bg-white rounded shadow-sm p-2 add-todo-wrapper align-items-center justify-content-center">
                        <div class="col">
                            <input class="form-control form-control-lg border-0 add-todo-input bg-transparent rounded"
                                type="text" name="task" placeholder="Add new task" required>
                        </div>
                        <div class="col-auto m-0 px-2 d-flex align-items-center">
                            <label class="text-secondary my-2 p-0 px-1 view-opt-label due-date-label">Due
                                Date</label>
                            <input type='text' name="due_date" class="form-control" id='datetimepicker1' required />
                        </div>
                        <div class="col-auto px-0 mx-0 mr-2">
                            <button type="submit" class="btn btn-primary">Add</button>
                        </div>
                    </div>
                    @if (session()->has('message'))
                        <div class="alert alert-success mt-3">
                            {{ session()->get('message') }}
                        </div>
                    @endif
                </div>

            </div>
        </form>
        <div class="p-2 mx-4 border-black-25 border-bottom"></div>
        <!-- Todo list section -->
        @isset($tasks)
        <div class="row mx-1 px-5 pb-3 w-80">
            <div class="col mx-auto">
                @foreach ($tasks as $task)
                <div class="row px-3 align-items-center todo-item rounded">
                    <div class="col px-1 m-1 d-flex align-items-center">
                        <h3>{{$task->task ?? ''}}</h3>
                    </div>
                    <div class="col-auto m-1 p-0 px-3">
                        <div class="row">
                            <div data-toggle="tooltip" data-original-title="{{config('app.timezone')}}" class="col-auto d-flex align-items-center rounded bg-white border border-warning">
                                <h6 class="text my-2 pr-2">{{ \Carbon\Carbon::parse($task->due_date)->format('g:i A, d M')}}</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto m-1 p-0 todo-actions">
                        <div class="row d-flex align-items-center justify-content-center">

                            <h5 class="m-0 p-0 px-2">
                                <a href="{{route('task-delete', $task->id)}}" ><i class="fa fa-trash-o text-danger btn m-0 p-0" data-toggle="tooltip"
                                    data-placement="bottom" title="Delete todo"></i></a>
                            </h5>
                        </div>
                        <div class="row todo-created-info">
                            <div class="col-auto d-flex align-items-center pr-2">
                                <i class="fa fa-info-circle my-2 px-2 text-black-50 btn" data-toggle="tooltip"
                                    data-placement="bottom" title="" data-original-title="Due date"></i>
                                <label  class="date-label my-2 text-black-50">{{ \Carbon\Carbon::parse($task->due_date)->format('g:i A, d M')}}</label>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endisset
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.21.0/moment.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootlint/1.1.0/bootlint.min.js"></script>
    <script type="text/javascript"
        src="https://www.jqueryscript.net/demo/Date-Time-Picker-Bootstrap-4/build/js/bootstrap-datetimepicker.min.js">
    </script>

    <script type="text/javascript">
        window.onload = function() {
            bootlint.showLintReportForCurrentDocument([], {
                hasProblems: false,
                problemFree: false
            });
            $(function() {
                $('#datetimepicker1').datetimepicker();
            });
            $('[data-toggle="tooltip"]').tooltip();

            function formatDate(date) {
                return (
                    date.getDate() +
                    "/" +
                    (date.getMonth() + 1) +
                    "/" +
                    date.getFullYear()
                );
            }

            var currentDate = formatDate(new Date())
        };
    </script>
</body>

</html>
