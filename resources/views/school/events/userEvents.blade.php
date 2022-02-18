@extends('layouts.school')

@section('css')
    <link rel="stylesheet" href="/admin/assets/bundles/fullcalendar/fullcalendar.min.css">
@endsection

@section('content')
   
<div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h4>{{ $res['name'] ?? 'Natija topilmadi' }}</h4>
        </div>
        <div class="card-body">
          <div class="fc-overflow">
            <div id="myEvent"></div>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection

@section('js')

 <!-- JS Libraies -->
 <script src="/admin/assets/bundles/fullcalendar/fullcalendar.min.js"></script>

<script>
    var events=<?php echo json_encode($res['events']); ?>;

    var calendar = $('#myEvent').fullCalendar({
        height: 'auto',
        defaultView: 'month',
        editable: true,
        selectable: true,
        eventOrder: 'start',
        header: {
            left: 'prev,next today',
            center: 'title',
            //right: 'month,agendaWeek,agendaDay,listMonth'
        },

        eventRender: function (event, element, view) { 
            // event.start is already a moment.js object
            // we can apply .format()
            var dateString = event.start.format("YYYY-MM-DD");
            
            $(view.el[0]).find('.fc-day[data-date=' + dateString + ']').css('background-color', '#8fe9e5');
        },

        events: [
            ...events
        ]
    });
</script>

@endsection


